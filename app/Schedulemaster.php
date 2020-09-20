<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Schedulemaster extends Model {
	
	protected $table = 'schedulemaster';
	protected $primaryKey = 'id';
	protected $fillable = ['id','name','order_by','timestamp'];
	
	
	public static function SchedulemasterList(){
		$data = DB::table('schedulemaster as c1')
			->select('c1.name', 'c1.id','c1.filesname','c1.orders_by','c1.IsDelete','c2.name as classschedule')
			->join('categories as c2', 'c1.classschedule_id', '=', 'c2.id')
			->where('c1.IsDelete', 0)
			->orderBy('c1.id', 'DESC')->get();	
		return $data;
	}
	
	public static function SchedulemasterByIdList($id){
		$data = DB::table('schedulemaster as c1')
			->select('c1.name', 'c1.id','c1.filesname','c1.orders_by','c1.IsDelete','c2.name as classschedule')
			->join('categories as c2', 'c1.classschedule_id', '=', 'c2.id')
			->where('c1.classschedule_id', $id)
			->where('c1.IsDelete', 0)
			->orderBy('c1.orders_by', 'ASC')->get();	
		return $data;
	}
	
	public static function ScheduleClassList(){
		$data = DB::table('categories as c1')
			->select('c1.name', 'c1.id','c1.IsDelete')
			->where('c1.entity_type', 'classsyllabus')
			->where('c1.IsDelete', 0)
			->orderBy('c1.id', 'ASC')->get();
			$array = array();
			if($data){
				foreach($data as $k=>$val){
					$array[$k]['SC'] = $val;
					$array[$k]['SM'] = self::SchedulemasterByIdList($val->id);
				}
			}
		return $array;
	}
  
}
?>