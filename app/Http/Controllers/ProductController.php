<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    protected function validator(array $data)
    {
        return tap(Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['required', 'string', 'max:255']
        ]), function($data) {
            if ($data['profile']) {
                Validator::make($data, [
                    'thumbnail' => ['file', 'image', 'max:5120']
                ]);
            }
        });
    }

    public function index()
    {
        $posts = Post::with(['user', 'category', 'subCategory'])->get();
        return view('admin.product.index', ['posts' => $posts]);
    }

    public function add()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.product.add', ['categories' => $categories, 'subCategories' => $subCategories]);
    }

    public function create(Request $request)
    {
        if (isset($request->thumbnail)) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
        }
        $post = Post::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'location' => $request->location,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'status' => $request->status,
            'thumbnail' => $img
        ]);
        return redirect()->route('product')->with('message', 'Product created!');
    }

    public function edit($id)
    {

    }

    public function update(Request $req, $id)
    {

    }

    public function delete($id)
    {

    }
}
