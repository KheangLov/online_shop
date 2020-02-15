<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $images = Image::where('user_id', Auth::user()->id)
            ->where('post_id', '!=', null)
            ->get();
        return view('admin.photo.index', ['images' => $images]);
    }

    public function upload(Request $request)
    {
        request()->validate([
            'images' => 'required',
        ]);
        $images = [];
        foreach ($request->images as $key => $value) {
            $imageName = time() . $key . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('images/photo'), $imageName);
            $img = 'images/photo/' . $imageName;

            $images[$key] = Image::create([
                'name' => $imageName,
                'path' => $img,
                'user_id' => Auth::user()->id
            ]);
        }

        return response()->json(['success' => 'Images uploaded!', 'images' => $images]);
    }

    public function delete(Request $request)
    {
        request()->validate([
            'files_id' => 'required',
        ]);
        $deletedRows = [];
        foreach ($request->files_id as $key => $value) {
            $deletedRows[$key] = Image::find($value);
            File::delete($deletedRows[$key]->path);
            Image::destroy($value);
        }

        return response()->json(['success' => 'Images deleted!', 'deletedRows' => $deletedRows]);
    }
}
