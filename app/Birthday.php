<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model {
	
	protected $table = 'birthday';
	protected $primaryKey = 'id';
	protected $fillable = ['id','title','order_by','timestamp'];
  
}
?>