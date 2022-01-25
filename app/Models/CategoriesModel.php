<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CategoriesModel extends Model
{
	protected $table = 'categories';
public $timestamps = false;
protected $primaryKey = 'category_id';
	protected $fillable = [
		'category_id',
		'parent_id',
		'slug',
		'title',
		'content',
	];
}