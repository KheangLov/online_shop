<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with(['subCategories', 'posts'])->get();
        $products = Post::all();
        return view('home', ['categories' => $categories, 'products' => $products]);
    }

    public function get_product_by_cate(Request $request)
    {
        if ($request->id === '*') {
            $products = Post::all();
            return response()->json(['products' => $products]);
        }
        $products = Post::where('category_id', (int)$request->id)->get();
        return response()->json(['products' => $products]);
    }

    public function details($id)
    {
        $categories = Category::with(['subCategories', 'posts'])->get();
        $product = Post::with('productVariants')->find($id);
        $images = Image::where('post_id', $id)->get();
        return view('details', ['categories' => $categories, 'product' => $product, 'images' => $images]);
    }
}
