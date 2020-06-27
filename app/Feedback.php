<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Feedback extends Model {
	
	protected $table = 'feedback';
	protected $primaryKey = 'id';
	protected $fillable = ['id'];
  
}
?>