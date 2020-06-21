<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Uploadgallery extends Model {
	
	protected $table = 'uploadgallery';
	protected $primaryKey = 'id';
	protected $fillable = ['id','name','order_by','timestamp'];
	
	public static function galleryList(){
		$data = DB::table('uploadgallery as c1')
			->select('c1.description', 'c1.id','c1.event_date','c1.images','c2.name as categoriesname')
			->join('categories as c2', 'c1.category_id', '=', 'c2.id')
			->where('c1.IsDelete', 0)
			->orderBy('c1.id', 'DESC')->get();	
		return $data;
	}
	
	public static function galleryList2(){
		//$results = DB::select( DB::raw("select `c1`.`description`, `c1`.`id`, `c1`.`event_date`, `c1`.`images`, `c2`.`name` as `categoriesname`, count(c1.id) as countTotal from `uploadgallery` as `c1` left join `categories` as `c2` on `c1`.`category_id` = `c2`.`id` where `c1`.`IsDelete` = 0 group by `c2`.`id` order by `c1`.`id` DESC") );
		$data = DB::table('uploadgallery as c1')
			->select('c1.description', 'c1.id','c1.category_id as categoryid','c1.event_date','c1.images','c2.name as categoriesname',DB::raw("count(c1.id) as countTotal"))
			->leftjoin('categories as c2', 'c1.category_id', '=', 'c2.id')
			->where('c1.IsDelete', 0)
			->orderBy('c1.id', 'DESC')->groupBy('c2.id')->get();
			//echo $data->toSql();die;
			//;	
		return $data;
	}
	public static function GetgalleryList($id){
		$data = DB::table('uploadgallery as c1')
			->select('c1.description', 'c1.id','c1.event_date','c1.images','c2.name as categoriesname')
			->join('categories as c2', 'c1.category_id', '=', 'c2.id')
			->where('c1.category_id', $id)
			->where('c1.IsDelete', 0)
			->orderBy('c1.id', 'DESC')->get();	
		return $data;
	}
  
}
?>