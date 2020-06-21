<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Staticcontent extends Model {
	
	protected $table = 'static_content';
	protected $primaryKey = 'id';
	protected $fillable = ['id','contents','timestamp'];
  
}
?>