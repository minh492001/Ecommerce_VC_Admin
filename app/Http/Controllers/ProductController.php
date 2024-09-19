<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Product";
        $data['getRecord'] = Product::getRecord();
        return view('product.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "New Product";
        return view('product.add', $data);
    }

    public function insert(Request $request)
    {
        $pattern = '/^\d+(\.\d{2})?$/';
        $price = trim($request->price);
        if (preg_match($pattern, $price) == 1) {
            $title = trim($request->title);
            $product = new Product;
            $product->title = $title;
            $product->price = $request->price;
            $product->created_by = Auth::user()->id;
            $product->save();

            $slug = Str::slug($title, '-');

            $checkSlug = Product::checkSlug($slug);
            if (empty($checkSlug)) {
                $product->slug = $slug;
                $product->save();
            }
            else {
                $newSlug = $slug.'-'.$product->id;
                $product->slug = $newSlug;
                $product->save();
            }

            return redirect('product/list')->with('success', 'Product added successfully !');
        }
        else {
            return redirect()->back()->with('error', 'Please enter a valid amount !');
        }
    }

    public function edit($id)
    {
        $data['getRecord'] = Product::getSingle($id);
        $data['header_title'] = "Edit Product";
        return view('product.edit', $data);

    }

    public function update(Request $request, $id)
    {
        $title = trim($request->title);
        $convert = preg_replace('/\s+/', '', $request->price);
        $price = str_replace(['.', ','], ['', ''], $convert);

        $product = Product::getSingle($id);
        $product->title = $title;
        $product->price = $price;
        $product->status = trim($request->status);
        $product->save();

        $slug = Str::slug($title, '-');

        $checkSlug = Product::checkSlug($slug);
        if (empty($checkSlug)) {
            $product->slug = $slug;
            $product->save();
        }
        else {
            $newSlug = $slug.'-'.$product->id;
            $product->slug = $newSlug;
            $product->save();
        }

        return redirect('product/list')->with('success', 'Product updated successfully !');

    }

    public function delete($id)
    {
        $company = Product::getSingle($id);
        $company->delete();

        return redirect()->back()->with('success', 'Product deleted successfully !');
    }
}
