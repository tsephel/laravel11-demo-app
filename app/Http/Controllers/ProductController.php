<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //This method will show product page
    public function index(){

      $products = Product::orderBy('created_at', 'DESC')->get();

      return view('product.list',[
        'products' => $products
      ]);
    }

     //This method will show create product page
     public function create(){

        return view('product.create');
        
     }

      //This method will add product
    public function store(Request $req){
        $rules = [
          'name'  => 'required|min:5',
          'sku'   => 'required|min:3',
          'price' => 'required|numeric'
        ];

        if ($req->image != ""){
          $rules['image'] = 'image';
        }

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
          return redirect()->route('product.create')->withInput()->withErrors($validator);
        }

        //store data in database
        $products = new Product();
        $products->name = $req->name;
        $products->sku = $req->sku;
        $products->price = $req->price;
        $products->description = $req->description;
        $products->save();

        if ($req->image != ""){
          //store image
          $image = $req->image;
          $ext = $image->getClientOriginalExtension();
          $imageName = time().'.'.$ext; //get unique image name
          
          //save image to porducts directory
          $image->move(public_path('uploads/products'), $imageName);

          //Save image in database
          $products->image = $imageName;
          $products->save();

        }

        return redirect()->route('product.list')->with('success', 'Product added sucessfully');
       
    }

     //This method will show edit product page
     public function edit($id){

        $product = Product::findOrFail($id);

        return view('product.edit', [
          'product' => $product
        ]);
        
     }

      //This method will update product
    public function update($id, Request $req){

      $products = Product::findOrFail($id);

      $rules = [
        'name'  => 'required|min:5',
        'sku'   => 'required|min:3',
        'price' => 'required|numeric'
      ];

      if ($req->image != ""){
        $rules['image'] = 'image';
      }

      $validator = Validator::make($req->all(), $rules);

      if($validator->fails()){
        return redirect()->route('product.edit', $products->id)->withInput()->withErrors($validator);
      }

      //update data in database
      $products->name = $req->name;
      $products->sku = $req->sku;
      $products->price = $req->price;
      $products->description = $req->description;
      $products->save();

      if ($req->image != ""){
        //delete old image on update
        // Check if the product has an existing image
        if ($products->image) {
          // Construct the full path to the old image
          $oldImagePath = public_path('uploads/products/' . $products->image);
          
          // Check if the file exists before attempting to delete it
          if (File::exists($oldImagePath)) {
              File::delete($oldImagePath);
          }
      }

        //update image
        $image = $req->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //get unique image name
        
        //save image to porducts directory
        $image->move(public_path('uploads/products'), $imageName);

        //Save image in database
        $products->image = $imageName;
        $products->save();

      }

      return redirect()->route('product.list')->with('success', 'Product updated sucessfully');

        
    }

     //This method will delete product 
     public function destroy($id){
        $products = Product::findOrFail($id);

        //delete image
        // Check if the product has an existing image
        if ($products->image) {
          // Construct the full path to the old image
          $oldImagePath = public_path('uploads/products/' . $products->image);
          
          // Check if the file exists before attempting to delete it
          if (File::exists($oldImagePath)) {
              File::delete($oldImagePath);
          }
        }

        //delete product from database
        $products->delete();

        return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
        
        
     }
}
