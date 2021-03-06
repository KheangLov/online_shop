<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 0;
        if (isset($_GET['id'])) $id = $_GET['id'];
        // $categories = Category::with('user')
        //     ->whereNull('user_id')
        //     ->orWhere('user_id', Auth::user()->id)
        //     ->get();
        $categories = Category::with('user')->paginate(10);
        if ($id !== 0) {
            $category = Category::where('id', (int)$id)->where('user_id', Auth::user()->id)->get();
            return view('admin.category.index', ['category' => $category[0], 'categories' => $categories, 'edit' => true]);
        }
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
        } else {
            $img = 'images/no-image.png';
        }
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'image' => $img
        ]);
        return redirect()->route('category.index')->with('message', 'Category created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $cate = Category::find($category);
		$cate->name = $request->name;
		$cate->description = $request->description;
        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $cate->image =  'images/' . $imageName;
        }
        $cate->user_id = Auth::user()->id;
        $cate->save();
		$cate->update();
		return redirect()
			->route('category.index')
			->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $cate = Category::where('id', $category)
            ->where('user_id', Auth::user()->id);
        $deleted = $cate->delete();
        if ($deleted === 0)
            return redirect()
                ->route('category.index')
                ->with('warning', 'Can\'t delete category!');

		return redirect()
			->route('category.index')
			->with('delete_success', 'Category deleted successfully');
    }
}
