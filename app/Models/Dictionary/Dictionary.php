<?php

namespace App\Models\Dictionary;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table="dictionary";
    
    // public function hasBodoDef()
    // {
    // 	return $this->bodo_definition;
    // }
    public function edit_required()
    {
    	return $this->bodo_definition;
    }
    public function scopeVerified($query)
    {
    	return $query->where('status',1);
    }
    public function scopeUntouched()
    {
    	return $query->where('status',0);
    }
    public function user()
    {
        // dd("ehllo");
        return $this->belongsTo('\App\User','user_id','id');
    }
}
