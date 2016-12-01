<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content\HistoryEvents;

class HistoryController extends Controller
{
     public function index()
    {
    	return view('history.index');
    }
    public function getall()
    {
    	return HistoryEvents::orderBy('year')->orderBy('month')->orderBy('date','DESC')->get();
    }
    public function saveEvent(Request $req)
    {
    	if(!e($req->get('details'))){
    		return \Response::json("Details can't be emty",500);
    	}
    	return HistoryEvents::create([
    		'date'=>$req->get('date')?$req->get('date'):null,
    		'month'=>$req->get('month')?$req->get('month'):null,
    		'year'=>$req->get('year')?$req->get('year'):null,
    		'details'=>$req->get('details')?$req->get('details'):null,
    		]);
    }
    public function updateEvent(Request $req)
    {
    	return HistoryEvents::findOrFail($req->id)->update([
    		'date'=>$req->get('date'),
    		'month'=>$req->get('month'),
    		'year'=>$req->get('year'),
    		'details'=>$req->get('details'),
    		]);
    }
    public function deleteEvent(Request $req)
    {
    	return HistoryEvents::findOrFail($req->id)->delete();
    }
}
