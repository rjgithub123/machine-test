<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductModel extends Model
{
	protected $table = 'product';
public $timestamps = false;
protected $primaryKey = 'product_id';
	protected $fillable = [
		'product_id',
		'category_id',
		'subcategory_id',
		'title',
		'slug',
		'content',
	];

	public function category()
	{
		return $this->belongsTo('App\Models\CategoriesModel', 'category_id', 'category_id');
	}

	public function sub_category()
	{
		return $this->belongsTo('App\Models\CategoriesModel', 'subcategory_id', 'category_id');
	}
}