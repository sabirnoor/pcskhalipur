<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quizinvitation extends Model {
	
	protected $table = 'quiz_invitation';
	protected $primaryKey = 'id';
	protected $fillable = ['id','quiz_id'];
	
	
  
}
?>