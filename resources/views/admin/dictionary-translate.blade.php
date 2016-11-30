@extends('layouts.admin')

@section('content')
<?php
// $query_array=[];
// if($filters[0]){$query_array['page']=$filters[0];}
// if($filters[1]){$query_array['type']=$filters[1];}
?>
<!-- <div class="modal fade in" id="searchmodal" > 
    <div class="modal-dialog">  
        <div class="modal-content"> 
            <div class="modal-header bg-primary"><button class="close" data-dismiss="modal">x</button> Search Words</div>
            <div class="modal-body"> 
            <form class="" >
                <div class="form-group"> 
                    <input class="form-control" type="search" name="query" placeholder="Type query here">
                </div>
                <div class="form-group"> 
                    <button class="form-control btn btn-warning" type="submit" data-toggle="modal" data-target="#searchmodal">
                    <i class="fa fa-search"></i>
                    <span> &nbsp;Search</span>
                    </button>
                </div>  
            </form>
            </div>
        </div>
    </div>  
</div> -->

 <div class="col-md-12" id="dictionaryadmin">
  
                {{--<div class="pull-right">{{$words->appends($query_array)->links()}}</div>
                <div class="">
                    <a class="btn {{$filters[1]==''?'btn-primary':'btn-default'}}" href="/admin/dictionary-translate">All</a>
                    <a class="btn {{$filters[1]=='edited'?'btn-primary':'btn-default'}}" href="/admin/dictionary-translate?type=edited">Edited</a>
                    <a class="btn {{$filters[1]=='unedited'?'btn-primary':'btn-default'}}" href="/admin/dictionary-translate?type=unedited">Untouched</a>
                </div>
                
                    @if(Session::has('error'))
                    <br>
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    <br>
                    @endif
                    <div class="alert ">
                        Total Results : {{$words->total()}}
                    </div>
                    --}}
                       <wordlist></wordlist>
                 
                   {{--<div class="text-center"> {{$words->appends($query_array)->links()}}</div>--}}
                  

                </div>
            </div>
</div>
<template id="paginator" type="script/x-template">

<form class="form-inline" v-on:submit.prevent="gotoPage()"> 
    <ul class="pagination" v-if="data.current_page!=data.last_page" style="width: 100%">

            <li class="page-item disabled" v-if="data.current_page==1"><span class="page-link">&laquo;</span></li>
            <li class="page-item" v-if="data.current_page!=1" @click="prevPage()"><a class="page-link" data-href="javascript()" rel="prev">&laquo;</a></li>

            <li class="page-item" >
                <span class="page-link">
                     <input @keyup.enter.prevent="gotoPage()" style="max-width: 100px; width: 50px; text-align: center;" class="form-control" type="text" name="" v-model="data.current_page">
                of <b>@{{data.last_page}}</b> &nbsp;
                </span>
               
            </li>

            <li class="page-item" v-if="data.current_page!=data.last_page" @click="nextPage()"><a class="page-link" rel="next">&raquo;</a></li>
            <li class="page-item disabled" v-if="data.current_page==data.last_page"><span class="page-link">&raquo;</span></li>

    </ul>
</form>


</template>
<template id="wordlist" type="script/template">

    <div class="panel panel-success">
    <div class="panel-heading" style="height: 42px; line-height: 42px;">
        <div style="margin-top: -8px;">
            <button class="btn pull-right btn-success"  @click="search">  <i class="fa fa-search"></i> &nbsp; Search</button>
            <button class="btn pull-right btn-danger"  @click="showinputhelper">  <i class="fa fa-info"></i></button>
        </div>
        Dictionary Translate 
    </div>

<div class="panel-body" >
<paginator :data='words' :extra="query"></paginator>
<div class="row clearfix animated fadeInUp">
    

    <div class="clearfix bg-info" style="height: 40px;line-height: 40px;font-weight: bold">
        <div>
            <span class="col-xs-2 col-sm-2 col-md-1">#</span>
            <span class="col-xs-3 col-sm-2 col-md-1">Word</span>
            <span class="hidden-sm hidden-xs col-md-2">Type</span>
            <span class="col-xs-5 col-sm-4 col-md-4"><span class="hidden-xs">English</span> Definition</span>
            <span class="hidden-xs col-sm-3 col-md-3 ">Bodo Definition</span>
            <span class="hidden-xs hidden-sm col-xs-1">Editor</span>
        </div>
    </div>
     <div class="clearfix">
                        
                        <div v-for="(word,key) in words.data" class="clearfix" v-bind:class="{ 'bg-success': key%2==0}" style="    border-top: 1px solid #eee; padding:10px 0;">
                            <span class="col-xs-2 col-sm-2 col-md-1">@{{word.id}}</span>
                            <span class="col-xs-3 col-sm-2 col-md-1">

                                @{{word.word}}
                                <br>
                                <div class="visible-xs-block">
                                    <span v-if="word.wordtype">(@{{word.wordtype}})</span>
                                </div>
                            </span>
                            <span class="hidden-sm hidden-xs col-md-2">@{{word.wordtype}}</span>
                            <span class="col-xs-7 col-sm-4 col-md-4">
                                <div >
                                    <h5 class="visible-xs-block"><u>English</u></h5>
                                    @{{word.definition}}
                                </div>
                                
                                <div class="visible-xs-block"> 
                                    <h5><u>Bodo</u></h5>
                                    <div v-if="word.bodo_definition">
                                        <span >@{{word.bodo_definition}}</span>
                                    </div>
                                    <button v-if="word.canEdit" class="btn btn-primary" @click="editModal(key)">Edit</button>
                                </div>
                            </span>
                    <span class="col-sm-4 col-md-3 hidden-xs">
                            
                            <div v-if="word.bodo_definition">
                                <span >@{{word.bodo_definition}}</span>
                            </div>
                            <button v-if="word.canEdit" class="btn btn-primary" @click="editModal(key)">Edit</button>

                    </span>
                    <span class="hidden-xs hidden-sm col-md-1">@{{word.user?word.user.name:''}}</span>
                </div>
    </div>
</div>
<paginator :data='words' :extra="query"></paginator>
</div>
</div>
</template>

@endsection

@section('extrascripts')
<!-- <script type="text/javascript" src="/external/jquery.ime/libs/rangy/rangy-core.js"></script>

<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.preferences.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.selector.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.inputmethods.js"></script>
<link type="text/css" rel="stylesheet" href="/external/jquery.ime/css/jquery.ime.css"></link> -->
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script type="text/javascript">
    
    // $( document ).ready( function () {
    //     $( '.swal2-textarea' ).ime();
    // } );

</script>
@endsection
