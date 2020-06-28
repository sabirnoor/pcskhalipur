<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quizresult extends Model {
	
	protected $table = 'quiz_result';
	protected $primaryKey = 'id';
	protected $fillable = ['id','timestamp'];
	
	
  
}
?>