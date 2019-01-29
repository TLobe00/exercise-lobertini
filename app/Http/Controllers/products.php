<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\inventory;
use App\comments;

class products extends Controller
{
    //
    public function showProducts() {

      $products = product::limit(20000)->orderBy('created_at', 'DESC')->with('inventory')->with('comments')->get();

			return view('products', [
				'products' => $products
			])->render();

    }

    public function commentProducts() {

      $products = product::limit(20000)->orderBy('created_at', 'DESC')->with('inventory')->with('comments')->get();

			return view('comments', [
				'products' => $products
			])->render();

    }

    public function addComments( Request $request ) {

  		$input = $request->all();

      //$product = product::findOrFail($input['pid']);

      //dd($product);

      if ( $input['comments'] == "" ) {
        $errorflag = "Error: You must provide comments";
        return redirect()->action( 'products@commentProducts' )->with('errorflag', $errorflag);
      }

      $comments = new comments;
      $comments->comments = $input['comments'];
      $comments->product_id = $input['pid'];
      $comments->save();

      $successflag = "Success: You have successfully added comments for the product";

  		return redirect()->action( 'products@commentProducts' )->with('successflag', $successflag);;
    }

    public function addProduct( Request $request ) {

  		$input = $request->all();

      if ( $input['title'] == "" || $input['desc'] == "" || $input['price'] == "" ) {
        $errorflag = "Error: You must provide a Product Name, Description, and Price";
        return redirect()->action( 'products@showProducts' )->with('errorflag', $errorflag);
      }

      $product = new product;
      $product->title = $input['title'];
      $product->desc = $input['desc'];
      $product->price = $input['price'];
      $product->save();

      //dd($product->id);

      //$product = product::findOrFail();
      if ( $input['qty'] == "" ) { $qty = 0; } else { $qty = $input['qty']; }
      $inventory = $product->inventory ?: new inventory;
      $inventory->quantity = $qty;
      $product->inventory()->save($inventory);

      $successflag = "Success: You have successfully added " . $input['title'];

  		return redirect()->action( 'products@showProducts' )->with('successflag', $successflag);
  	}
}
