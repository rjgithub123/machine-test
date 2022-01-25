<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\CategoriesModel;
use Validator;

class ProductController extends Controller
{
	public function index(Request $request)
	{
		$product = ProductModel::with('category')->with('sub_category')->paginate(config('constants.PAGINATION_COUNT'));
		return view('product/product_list', compact('product'));
	}

	public function create(Request $request)
	{
		$category = CategoriesModel::where('parent_id', '0')->get();
		return view('product/product_add', compact('category'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'category_id' => 'required',
				'title'		=> 'required',
			]
		);

		if ($validator->fails()) {
			return \Redirect::back()->withErrors($validator)->withInput();
		} else {
			$product = new ProductModel();
			$product->category_id = $request->get('category_id');
			if ($request->get('sub_category_id')) {
				$product->subcategory_id = $request->get('sub_category_id');
			}
			$product->title = $request->get('title');
			$product->slug = $request->get('title');
			$product->content = $request->get('content');
			$is_saved = $product->save();
			if ($is_saved) {
				\Session::flash('success', 'Product added Successfully.');
				return redirect('/product');
			} else {
				\Session::flash('error', 'Error adding Product.');
				return \Redirect::back();
			}
		}
	}
	public function destroy(Request $request)
	{
		$product_id = $request->product_id;
		if ($product_id) {
			$product = ProductModel::where('product_id', $product_id)->first();
			if ($product->product_id) {
				ProductModel::destroy($product_id);
				$msg = "Success";
			} else {
				$msg = "Error";
			}
		} else {
			$msg = "Error";
		}
		return $msg;
	}
}
