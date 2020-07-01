<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentmaster extends Model {
	
	protected $table = 'student_master';
	protected $primaryKey = 'id';
	protected $fillable = ['id','student_name'];
  
}
?>