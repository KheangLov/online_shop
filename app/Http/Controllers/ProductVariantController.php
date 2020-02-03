<?php

namespace App\Http\Controllers;

use App\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
        $pv = ProductVariant::create($data);
        return response()->json(['message' => 'Added product variant.', 'pv' => $pv]);
    }
}
