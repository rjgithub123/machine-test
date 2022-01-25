<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use Validator;

class SubCategoriesController extends Controller
{
	public function index(Request $request)
	{
		$subcategories = CategoriesModel::where('parent_id','!=','0')->paginate(config('constants.PAGINATION_COUNT'));
		return view('sub_categories/sub_categories_list', compact('subcategories'));
	}

	public function create(Request $request)
	{
		$category=CategoriesModel::where('parent_id','0')->get();
		return view('sub_categories/sub_categories_add',compact('category'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'category_id'=>'required',
		'title'		=> 'required',
		]);

	if($validator->fails()) {
		return \Redirect::back()->withErrors($validator)->withInput();
	} else {
	 $categories = new CategoriesModel();
	 $categories->parent_id = $request->get('category_id');
	 $categories->slug = $request->get('title');
	 $categories->title = $request->get('title');
	 $categories->content = $request->get('content');
	 $is_saved = $categories->save();
	if($is_saved) {
		\Session::flash('success', 'Sub Categories added successfully.');
		return redirect('/sub_categories');
	} else {
		\Session::flash('error', 'Error adding Sub Categories.');
		return \Redirect::back();
	}
	}

}

public function get_subcategory(Request $request)
	{
		$category_id=$request->get('category_id');
		$subcategory=CategoriesModel::where('parent_id',$category_id)->get();
		
		return $subcategory;
		 
	}
}

