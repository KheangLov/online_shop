<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Post;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $getNextId = DB::table('information_schema.TABLES')
            ->where('TABLE_NAME', '=', 'posts')
            ->get();
        $nextId = $getNextId[0]->AUTO_INCREMENT;

        $categories = Category::all();
        $subCategories = SubCategory::all();
        $provinces = [
            'Phnom Penh',
            'Banteay Meanchey',
            'Battambang',
            'Kampong Cham',
            'Kampong Chhnang',
            'Kampong Speu',
            'Kampot',
            'Kandal',
            'Kep',
            'Koh Kong',
            'Kratie',
            'Mondulkiri',
            'Oddor Meanchey',
            'Pailin',
            'Prey Veng',
            'Pursat',
            'Rattanakiri',
            'Siem Reap',
            'Sihanouk ville',
            'Stung Treng',
            'Svay Rieng',
            'Takeo',
            'Kampong Thom',
            'Preah Vihear',
            'Tbong Khmum'
        ];
        $conditions = ['medium', 'old', 'new'];
        $images = Image::all()->sortByDesc('created_at');
        return view('admin.product.add', [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'provinces' => $provinces,
            'conditions' => $conditions,
            'images' => $images,
            'nextId' => $nextId
        ]);
    }

    public function create(Request $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'location' => $request->location,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'status' => $request->status
        ];
        if (isset($request->thumbnail)) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
            $data['thumbnail'] = $img;
        }
        $post = Post::create($data);
        return redirect()->route('product')->with('message', 'Product created!');
    }

    public function add_category(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ];
        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $img = 'images/' . $imageName;
            $data['image'] = $img;
        } else {
            $data['image'] = 'images/no-image.png';
        }
        $cate = Category::create($data);
        return response()->json(['message' => 'Got Simple Ajax Request.', 'cate' => $cate]);
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
