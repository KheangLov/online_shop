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

    public function index()
    {
        $posts = Post::with(['user', 'category', 'subCategory'])->where('user_id', Auth::user()->id)->get();
        return view('admin.product.index', ['posts' => $posts]);
    }

    public function add()
    {
        $getNextId = DB::table('information_schema.TABLES')
            ->where('TABLE_NAME', '=', 'posts')
            ->get();
        $nextId = $getNextId[0]->AUTO_INCREMENT;

        // $subCategories = SubCategory::whereNull('user_id')
        //     ->orWhere('user_id', Auth::user()->id)
        //     ->get();
        // $categories = Category::whereNull('user_id')
        //     ->orWhere('user_id', Auth::user()->id)
        //     ->get();
        // $subCategories = SubCategory::all();
        $categories = Category::all();
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
        $images = Image::whereNull('post_id')->where('user_id', Auth::user()->id)->orderByRaw('created_at DESC')->get();
        return view('admin.product.add', [
            'categories' => $categories,
            // 'subCategories' => $subCategories,
            'provinces' => $provinces,
            'conditions' => $conditions,
            'images' => $images,
            'nextId' => $nextId
        ]);
    }

    public function get_sub_cate(Request $request)
    {
        $subCate = SubCategory::where('category_id', (int)$request->category_id)->get();
        return response()->json(['success' => 'Category added!', 'subCate' => $subCate]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'description' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('product_add')
                ->withErrors($validator);
        }

        $images_str_id = json_decode($request->images);
        $images_id = [];
        foreach ($images_str_id as $isi) {
            array_push($images_id, (int)$isi);
        }
        if ($request->category == 0 || $request->subCategory == 0) {
            return redirect()->route('product')->with('error', 'Wrong data!');
        }
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
        } else {
            $data['thumbnail'] = 'images/no-image.png';
        }
        $post = Post::create($data);
        Image::whereIn('id', $images_id)->update(['post_id' => $post->id]);
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
        return response()->json(['success' => 'Category added!', 'cate' => $cate]);
    }

    public function add_sub_category(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id
        ];
        $subCate = SubCategory::create($data);
        return response()->json(['success' => 'Sub-Category added!', 'subCate' => $subCate]);
    }

    public function edit($id)
    {
        $product = Post::where('id', $id)->where('user_id', Auth::user()->id)->get();
        // $subCategories = SubCategory::whereNull('user_id')
        //     ->orWhere('user_id', Auth::user()->id)
        //     ->get();
        // $categories = Category::whereNull('user_id')
        //     ->orWhere('user_id', Auth::user()->id)
        //     ->orderBy("name")
        //     ->get();
        $subCategories = SubCategory::all();
        $categories = Category::all();
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
        $images = Image::whereNull('post_id')
            ->orWhere('post_id', $id)
            ->orderByRaw('created_at DESC')
            ->get();
        return view('admin.product.edit', [
            'product' => $product[0],
            'categories' => $categories,
            'subCategories' => $subCategories,
            'provinces' => $provinces,
            'conditions' => $conditions,
            'images' => $images
        ]);
    }

    public function update(Request $req, $id)
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
        return view('admin.product.edit', [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'provinces' => $provinces,
            'conditions' => $conditions,
            'images' => $images,
            'nextId' => $nextId
        ]);
    }

    public function delete($id)
    {

    }
}
