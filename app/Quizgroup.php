<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quizgroup extends Model {
	
	protected $table = 'quizgroup';
	protected $primaryKey = 'id';
	protected $fillable = ['id','quiz_group_title','timestamp'];
	
	
  
}
?>