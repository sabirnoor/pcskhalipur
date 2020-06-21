<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsevents extends Model {
	
	protected $table = 'newsevents';
	protected $primaryKey = 'id';
	protected $fillable = ['id','timestamp'];
  
}
?>