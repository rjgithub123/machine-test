<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use Validator;
class CategoriesController extends Controller
{
	public function index(Request $request)
	{
		$categories = CategoriesModel::where('parent_id','0')->paginate(config('constants.PAGINATION_COUNT'));
		return view('categories/categories_list', compact('categories'));
	}

	public function create(Request $request)
	{
		return view('categories/categories_add');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
		'title'		=> 'required',
		]);

	if($validator->fails()) {
		return \Redirect::back()->withErrors($validator)->withInput();
	} else {
	 $categories = new CategoriesModel();
	 $categories->slug = $request->get('title');
	 $categories->title = $request->get('title');
	 $categories->content = $request->get('content');
	 $is_saved = $categories->save();
	if($is_saved) {
		\Session::flash('success', 'Categories added successfully.');
		return redirect('/categories');
	} else {
		\Session::flash('error', 'Error adding Categories.');
		return \Redirect::back();
	}
	}

}


public function edit(Request $request, $id)
{
	$categories  = CategoriesModel::where('category_id',decrypt($id))->first();
	if($categories) {
		return view('categories/categories_edit' , compact('id','categories'));
} else {
		\Session::flash('error', 'Error');
		return redirect('/categories');
}
}

public function update(Request $request, $id)
{
	
$validator = Validator::make($request->all(),
[
		'title'		=> 'required',
		'content'		=> 'required',
	]);

if($validator->fails()) {
	return \Redirect::back()->withErrors($validator)->withInput();
} else {
	$categories  = CategoriesModel::where('category_id',decrypt($id))->first();
if($categories) {
$categories->slug = $request->get('title');
$categories->title = $request->get('title');
$categories->content = $request->get('content');
$categories->save();
\Session::flash('success', 'Categories details updated successfully.');
return redirect('/categories');
} else {
\Session::flash('error', 'Nothing to update');
return \Redirect::back();
}
}
}
public function destroy(Request $request)
{
$category_id = $request->category_id;
if($category_id) {
$categories = CategoriesModel::where('category_id',$category_id)->first();
if($categories->category_id) {
CategoriesModel::destroy($category_id);
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
