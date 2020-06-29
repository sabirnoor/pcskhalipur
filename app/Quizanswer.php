<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quizanswer extends Model {
	
	protected $table = 'quiz_answer';
	protected $primaryKey = 'answer_id';
	protected $fillable = ['answer_id'];
	
	
  
}
?>