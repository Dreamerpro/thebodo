@extends('layouts.admin')

@section('content')
<?php
$query_array=[];
if($filters[0]){$query_array['page']=$filters[0];}
if($filters[1]){$query_array['type']=$filters[1];}
?>
 <div class="col-md-12" id="dictionaryadmin">
            <div class="panel panel-primary">
                <div class="panel-heading"> Dictionary Translate </div>

                <div class="panel-body">
                <div class="pull-right">{{$words->appends($query_array)->links()}}</div>
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
                   <div class="row clearfix animated fadeInUp">
                       <div class="clearfix">
                           <div>
                                <span class="col-xs-1 col-md-1">#</span>
                                <span class="col-xs-3 col-md-1">Word</span>
                                <span class="hidden-xs col-md-2">Type</span>
                                <span class="col-xs-4 col-md-4">English Definition</span>
                                <span class="col-xs-4 col-md-3">Bodo Definition</span>
                                <span class="hidden-xs col-xs-1">Editor</span>
                            </div>
                       </div>
                        <div class="clearfix">
                        @foreach($words as $key=>$word)
                        <div class="text-warning clearfix" style="    border-top: 1px solid #eee; padding:10px 0;">
                            <span class="col-xs-1 col-md-1">{{$word->id}}</span>
                            <span class="col-xs-3 col-md-1">{{$word->word}}</span>
                            <span class="hidden-xs col-md-2">{{$word->wordtype}}</span>
                            <span class="col-xs-4 col-md-4">{{$word->definition}}</span>
                            <span class="col-xs-4 col-md-3">
                            @if($word->bodo_definition)
                                {{$word->bodo_definition}}
                                
                            @else
                                <form v-if="!status[{{$key}}]" >
                                    <div class="form-group bodo-textarea">
                                        <textarea v-model="words[{{$key}}]" class="form-control"></textarea>
                                    </div>
                                    <button type="button" @click.prevent.stop="save({{$key}},{{$word->id}})" class="btn btn-warning" :disabled=disableSB>
                                            Save
                                    </button>
                                </form>
                                <!-- v-if="status[{{$key}}]" -->
                                <span  v-html="words[{{$key}}]"></span>
                            @endif

                            </span>
                            <span class="hidden-xs col-md-1">{{$word->user?$word->user->name:''}}</span>
                        </div>
                        @endforeach
                        </div>
                       
                    </div>
                   <!-- <table class="table table-stripped animated fadeInUp">
                       <thead>
                           <tr>
                                <th>#</th>
                                <th>Word</th>
                                <th>Type</th>
                                <th>English Definition</th>
                                <th>Bodo Definition</th>
                                <th>Editor</th>
                            </tr>
                       </thead>
                        <tbody>
                        @foreach($words as $key=>$word)
                        <tr class="text-warning">
                            <td>{{$word->id}}</td>
                            <td>{{$word->word}}</td>
                            <td>{{$word->wordtype}}</td>
                            <td>{{$word->definition}}</td>
                            <td>
                            @if($word->bodo_definition)
                                {{$word->bodo_definition}}
                                
                            @else
                                <form method="POST" @submit.prevent="save({{$key}},{{$word->id}})" v-if="!status[{{$key}}]" >
                                    <div class="form-group" style="min-width: 280px;max-width: 500px">
                                        <textarea v-model="words[{{$key}}]" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-warning" :disabled=disableSB>
                                            Save
                                    </button>
                                </form>
                                <span  v-html="words[{{$key}}]"></span>
                            @endif

                            </td>
                            <td>{{$word->user?$word->user->name:''}}</td>
                        </tr>
                       @endforeach
                        </tbody> -->
                       
                   </table>
                   <div class="text-center"> {{$words->appends($query_array)->links()}}</div>
                  

                </div>
            </div>
</div>
    
@endsection

@section('extrascripts')
<script type="text/javascript" src="/external/jquery.ime/libs/rangy/rangy-core.js"></script>

<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.preferences.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.selector.js"></script>
<script type="text/javascript" src="/external/jquery.ime/src/jquery.ime.inputmethods.js"></script>
<link type="text/css" rel="stylesheet" href="/external/jquery.ime/css/jquery.ime.css"></link>
<script type="text/javascript">
    
    $( document ).ready( function () {
        $( 'textarea' ).ime();
    } );

</script>
@endsection
