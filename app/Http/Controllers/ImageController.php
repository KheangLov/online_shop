<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function upload(Request $request)
    {
        request()->validate([
            'images' => 'required',
        ]);

        foreach ($request->images as $key => $value) {
            $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('images/photo'), $imageName);
            $img = 'images/photo/' . $imageName;

            $images = Image::create([
                'name' => $value->getClientOriginalName(),
                'path' => $img,
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->route('product_add')->with('message', 'Images uploaded!');
    }
}
