<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class Categories extends Model
{
	
	
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['id','parent_id','name','name_code','coords'];
	
    public static function cityname(){

        $data = array();
            $data=DB::table('categories')->get()->pluck('name','id');
            return $data;
    }
	
	public static function StateList(){
		$data = DB::table('categories as c1')
			->select('c1.name as continent', 'c2.name as country','c3.name as state','c3.id as state_id')
			->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
			->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
			->where('c1.parent_id', '0')
			->orderBy('c3.name', 'asc')->get();	
		return $data;
	}
	
	public static function CityList(){
		$data = DB::table('categories as c1')
			->select('c1.name as continent', 'c2.name as country','c3.name as state','c3.id as state_id','c4.name as city','c4.id as city_id')
			->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
			->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
			->join('categories as c4', 'c3.id', '=', 'c4.parent_id')
			->where('c1.parent_id', '0')
			->orderBy('c4.name', 'asc')->get();	
		return $data;
	}
	
	public static function EntityList(){
		$data = DB::table('teksaentity')
			->select('id','entity_type', 'name')
			->where('IsDelete',0)->get();	
		return $data;
	}
	
	public static function EntityEntityList($entity_type){
		$data = DB::table('teksaentity')
			->select('id','entity_type', 'name','city_name')
			->where('entity_type', $entity_type)
			->where('IsDelete',0)->get();	
		return $data;
	}
	
	public static function EntityTypeList($entity_type){
		$data = DB::table('teksaentity')
			->select('id','entity_type', 'name')
			->where('entity_type', $entity_type)
			->where('IsDelete',0)->get()->toArray();
			
			$array = [];
			foreach($data as $key=>$val){
				$array[$val->id] = $val->name;
			}
		return $array;
	}
	
	public static function Details($id){
		$data = array();
		$data = DB::table('categories as c1')
			->select('c1.name as continent','c1.id as continent_id', 'c2.name as CountryName','c2.id as ContId','c3.name as name','c3.name_code as name_code','c3.coords as coords')
			->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
			->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
			->where('c1.parent_id', '0')
			->where('c3.id', $id)->first();	
		return $data;
		/* $data = DB::table('categories')
			->select('id','parent_id','name', 'name_code')
			->where('id', $id)->first();			
		return $data; */
	}
	public static function CityDetails($id){
		$data = array();
		$data = DB::table('categories as c1')
			
			->select('c1.name as continent', 'c2.name as country','c3.name as StateName','c3.id as stateId','c4.name as name','c4.id as city_id','c4.name_code as name_code','c4.coords as coords')
			->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
			->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
			->join('categories as c4', 'c3.id', '=', 'c4.parent_id')
			->where('c1.parent_id', '0')->where('c4.id', $id)->first();
		return $data;
	}
	
	public static function EntityDetails($id){
		$data = array();
		$data = DB::table('teksaentity')
			->select('*')
			->where('IsDelete',0)->where('id', $id)->first();
		return $data;
	}
	
	
	
	
	
	
}
