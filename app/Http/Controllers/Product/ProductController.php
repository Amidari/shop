<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producr\StoreRequest;
use App\Http\Requests\Producr\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Teg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Teg::all();
        $colors = Color::all();
        $categories = Category::all();
        //dd($tags,$colors,$categories);
        return view('product.create', compact('tags', 'colors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $productImages = $data['product_images'];
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        $tagsIds = $data['tags'];
        $colorsIds = $data['colors'];

        unset($data['tags'], $data['colors'], $data['product_images']);

        $product = Product::firstOrCreate([
           'title' => $data['title'],
        ], $data);

        foreach ($tagsIds as $tagsId){
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagsId,
            ]);
        }
        foreach ($colorsIds as $colorsId){
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId,
            ]);
        }

        foreach ($productImages as $productImage){
            $filePath = Storage::disk('public')->put('/images', $productImage);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);

        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product){
        $tags = Teg::all();
        $colors = Color::all();
        $categories = Category::all();
        $groups = Group::all();

        return view('product.edit', compact('product','tags', 'colors', 'categories', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        return view('product.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
