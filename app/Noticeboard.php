<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticeboard extends Model {
	
	protected $table = 'noticeboard';
	protected $primaryKey = 'id';
	protected $fillable = ['id','name','order_by','timestamp'];
  
}
?>