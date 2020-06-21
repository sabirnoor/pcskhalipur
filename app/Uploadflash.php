<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadflash extends Model {
	
	protected $table = 'uploadflash';
	protected $primaryKey = 'id';
	protected $fillable = ['id','name','order_by','timestamp'];
  
}
?>