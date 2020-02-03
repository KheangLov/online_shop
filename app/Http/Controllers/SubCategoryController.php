<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $id = 0;
        if (isset($_GET['id'])) $id = $_GET['id'];
        $subCategories = SubCategory::with(['user', 'category'])
            ->whereNull('user_id')
            ->orWhere('user_id', Auth::user()->id)
            ->get();
        $categories = Category::whereNull('user_id')
            ->orWhere('user_id', Auth::user()->id)
            ->orderBy("name")
            ->get();
        if ($id !== 0) {
            $subCategory = SubCategory::find($id)->where('user_id', Auth::user()->id);
            return view('admin.subCategory.index', ['subCategory' => $subCategory, 'subCategories' => $subCategories, 'categories' => $categories, 'edit' => true]);
        }
        return view('admin.subCategory.index', ['subCategories' => $subCategories, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $subCategory = SubCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);
        return redirect()->route('sub_cate')->with('message', 'Sub-Category created!');
    }

    public function update(Request $request, $id)
    {
        $subCate = SubCategory::find($id);
		$subCate->name = $request->name;
        $subCate->description = $request->description;
        $subCate->category_id = $request->category;
        $subCate->user_id = Auth::user()->id;
        $subCate->save();
		$subCate->update();
		return redirect()
			->route('sub_cate')
			->with('message', 'Sub-Category updated successfully!');
    }

    public function destroy($id)
    {
        $subCate = SubCategory::find($id);
		$subCate->delete();
		return redirect()
			->route('sub_cate')
			->with('delete_success', 'Sub-Category deleted successfully');
    }
}
