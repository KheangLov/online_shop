<?php

namespace App\Http\Controllers;

use App\Post;
use App\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $products = Post::with('productVariants')->where('user_id', Auth::user()->id)->get();
        return view('admin.productVariant.index', ['products' => $products]);
    }

    public function add()
    {
        $id = 0;
        if (isset($_GET['id'])) $id = $_GET['id'];
        $products = Post::where('user_id', Auth::user()->id)->get();
        if ($id !== 0) {
            return view('admin.productVariant.add', ['id' => $id, 'products' => $products]);
        }
        return view('admin.productVariant.add', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $data = [
            'color' => $request->color,
            'size' => $request->size,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'post_id' => $request->product_id
        ];
        $products = ProductVariant::create($data);
        return redirect()->route('pv_add')->with(['success' => 'Product variant created!', 'products' => $products]);
    }

    public function edit($id)
    {
        $productVar = ProductVariant::find($id);
        return view('admin.productVariant.edit', ['productVar' => $productVar]);
    }

    public function update(Request $request, $id)
    {
        $productVar = ProductVariant::find($id);

        $productVar->color = $request->color;
        $productVar->size = $request->size;
        $productVar->discount = $request->discount;
        $productVar->quantity = $request->quantity;
        $productVar->post_id = $request->product_id;

        $productVar->save();
        $productVar->update();

        $products = Post::with('productVariants')
            ->where('user_id', Auth::user()->id)
            ->get();
        return redirect()->route('product_variant')->with(['success' => 'Product variant created!', 'products' => $products]);
    }

    public function delete($id)
    {
        $productVar = ProductVariant::find($id);
        $deleted = $productVar->delete();

        if ($deleted === 0)
            return redirect()
                ->route('product_variant')
                ->with('warning', 'Can not delete product variant!');

		return redirect()
			->route('product_variant')
			->with('success', 'Product variant deleted');
    }
}
