<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;use DB;

class Studentmaster extends Model {
	
	protected $table = 'student_master';
	protected $primaryKey = 'id';
	protected $fillable = ['id','student_name'];		public static function getAllClass(){        $data = DB::table('student_master as c1')                        ->select('c1.present_class')                                                ->where('c1.IsDelete', 0)                        ->groupBy('c1.present_class')                        ->orderBy('c1.present_class', 'ASC')->get()->toArray();                       		        return $data;    }		public static function getfilteredstudents($class_name='',$branch=''){        $data = DB::table('student_master as c1')                        ->select('c1.id','c1.student_name','c1.present_class','c1.admission_no','c1.branch',DB::raw('CONVERT(c1.Roll_No, SIGNED INTEGER) as Roll_No'))                                                ->where('c1.IsDelete', 0)						->when($class_name, function ($query) use ($class_name) {							return $query->where('c1.present_class', $class_name);						})						->when($branch, function ($query) use ($branch) {							return $query->where('c1.branch', $branch);						})                                                                       ->orderBy('Roll_No', 'ASC')->get();                       		        return $data;    } 		public static function getStudentInfoByAdmissionNo($adm_no){        		$data = DB::table('student_master as c1')				->select('c1.id','c1.student_name','c1.present_class','c1.admission_no','c1.branch',DB::raw('CONVERT(c1.Roll_No, SIGNED INTEGER) as Roll_No'))                        				->where('c1.IsDelete', 0)				->where('c1.admission_no', $adm_no)				                                                             ->orderBy('Roll_No', 'ASC')->first();                       		        return $data;    }  
}
?>