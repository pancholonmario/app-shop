<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductImage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //listado
    }

    public function create()
    {
        return view('admin.products.create'); //formualrio de registro
    }

    public function store(Request $request)
    {

      //validar
      $messages = [
        'name.required' => 'el nombre es obligatorio',
        'name.min' => 'el nombre debe tener 3 caracteres',
        'description.required' => 'la descripcion es obligatoria',
        'description.max' => 'la descripcion admite hasta 200 caracteres',
        'price.required' => 'el precio es obligatorio',
        'price.numeric' => 'el precio es numérico',
        'price.min' => 'no se admiten valores negativos',


      ];

      $rules = [
        'name' => 'required|min:3',
        'description' => 'required|max:200',
        'price' => 'required|numeric|min:0',

      ];

      $this->validate($request, $rules, $messages);

      $product = new Product();
      $product->name = $request->input('name');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->long_description = $request->input('long_description');

      $product->save();

      return redirect('/admin/products');

    }

    public function edit($id)
    {

        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product')); //formualrio de registro
    }

    public function update(Request $request, $id)
    {

      //validar
      $messages = [
        'name.required' => 'el nombre es obligatorio',
        'name.min' => 'el nombre debe tener 3 caracteres',
        'description.required' => 'la descripcion es obligatoria',
        'description.max' => 'la descripcion admite hasta 200 caracteres',
        'price.required' => 'el precio es obligatorio',
        'price.numeric' => 'el precio es numérico',
        'price.min' => 'no se admiten valores negativos',


      ];

      $rules = [
        'name' => 'required|min:3',
        'description' => 'required|max:200',
        'price' => 'required|numeric|min:0',

      ];

      $this->validate($request, $rules, $messages);

      $product = Product::find($id);
      $product->name = $request->input('name');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->long_description = $request->input('long_description');

      $product->save();

      return redirect('/admin/products');

    }

    public function destroy($id)
    {

    //  CartDetail::where('product_id', $id)->delete();
      ProductImage::where('product_id', $id)->delete();

      $product = Product::find($id);

      $product->delete();

      return back();

    }
}
