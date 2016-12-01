<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class HistoryEvents extends Model
{
    protected $table="history_events";
    public $fillable=['date','month','year','details','time'];
}
