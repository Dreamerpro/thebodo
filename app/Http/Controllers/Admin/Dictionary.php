<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Dictionary\Dictionary as DC;

class Dictionary extends Controller
{
	// public function _construct()
	// {
	// 	$this->middleware('web');
	// }
    public function index(Request $req)
    {   
    	 // return \Response::json($words,200);

    	// dd($words);
    	return view('admin.dictionary-translate');
    }
    public function getdictionary(Request $req)
    {
        $page=$req->get('page');
        $type=$req->get('type');
        $query=$req->get('query');
        $words=DC::with('user');
        // if($query){
        //     $words=$words->where('word',$query);
        // }
        if($type && $type=='edited'){
            $words=$words->where('status',2)->paginate(15);
        } 
        else if($type && $type=='unedited'){
            $words=$words->where('status',0)->paginate(15);
        } 
        else{
            $words=$words->paginate(15);
        }
        foreach ($words as $key => $word) {
            $word->canEdit=\Auth::user()->canEditWord($word);
        }
        return ['words'=>$words,'filters'=>[$page,$type],'query'=>$query];
    }
    public function search(Request $req)
    {
        $page=$req->get('page');
        $type=$req->get('type');
        $query=$req->get('query');
        $words=DC::with('user');
        if($query){
            $words=$words->where('word',$query);
        }
        if($type && $type=='edited'){
            $words=$words->where('status',2)->paginate(15);
        } 
        else if($type && $type=='unedited'){
            $words=$words->where('status',0)->paginate(15);
        } 
        else{
            $words=$words->paginate(15);
        }
        foreach ($words as $key => $word) {
            $word->canEdit=\Auth::user()->canEditWord($word);
        }
        return ['words'=>$words,'filters'=>[$page,$type],'query'=>$query];
    }

    public function save(Request $req)
    {
    	 $wid=$req->get('id');
    	 $def=$req->get('def');
    	   	// return dd(\Auth::user());
    	 if($def){
    	 	$word=DC::findOrFail($wid);
    	 	if($word->user_id){//if already has value
    	 		if(!\Auth::user()->canEditWord($word)){
    	 			abort(401);
    	 		}
    	 	}
    	 	$word->bodo_definition=$def;
    	 	$word->status=2;//added
    	 	$word->user_id=\Auth::user()->id;//added
    	 	$word->save();
    	 	return \Response::json('Succesfully saved the word.',200);
    	 }
    	 else{
    	 	return \Response::json('No input found!',500);
    	 }
    	 return \Response::json('Error finding the word!',500);
    }
}
