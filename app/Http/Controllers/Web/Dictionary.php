<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Dictionary\Dictionary as DC;


class Dictionary extends Controller
{
    public function index(Request $req)
    {

    	$words=null;
    	$query=$req->get('query');
    	
    	if($query){
    		$words=DC::where('word',$query)->paginate(15);
    		if(!$words->count()){
    			$words=DC::where('word','like','%'.$query.'%')->paginate(15);
    		}
    		
    	} 
    	else{
    		$words=DC::paginate(15);
    	}
    	return view('web.dictionary',['words'=>$words,'query'=>$query]);
    }
}
