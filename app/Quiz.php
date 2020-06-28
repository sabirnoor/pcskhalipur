<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quiz extends Model {
	
	protected $table = 'quiz';
	protected $primaryKey = 'id';
	protected $fillable = ['id','quiz_title','timestamp'];
	
	
  
}
?>