<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Question extends Model {
	
	protected $table = 'question';
	protected $primaryKey = 'id';
	protected $fillable = ['id','question_title','timestamp'];
	
	public static function getquizquestions($quizid){
        $data = DB::table('question as c1')
                        ->select('c1.id','c1.question_title','c1.option1', 'c1.option2', 'c1.option3', 'c1.option4', 'c1.correct_answer',  'c2.quiz_title as quiz_title')
                        ->join('quiz as c2', 'c2.id', '=', 'c1.quizid','LEFT')                        
                        ->where('c1.IsDelete', 0)     
                        ->where('c2.id', $quizid) 
                        ->orderBy('c1.id', 'ASC')->get()->toArray();
                        
		
        return $data;
    }
  
}
?>