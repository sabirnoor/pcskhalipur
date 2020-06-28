<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Question extends Model {
	
	protected $table = 'question';
	protected $primaryKey = 'id';
	protected $fillable = ['id','question_title','timestamp'];
	
  
}
?>