<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quizanswer extends Model {
	
	protected $table = 'quiz_answer';
	protected $primaryKey = 'id';
	protected $fillable = ['id','timestamp'];
	
	
  
}
?>