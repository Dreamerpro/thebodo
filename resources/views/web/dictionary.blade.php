@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div v-if="!showSearchBar">
                    <a href="/dictionary" >Dictionary</a>
                    <div class="pull-right" style="margin-top: -8px;" @click="toggleSearchBar()">
                        <button class="btn btn-default glyphicon glyphicon-search"></button>
                    </div>
                </div>
                <div v-if="showSearchBar" >
                 <form type="POST" action="/dictionary">
                    <input class="form-control" type="search" name="query" style="padding: 0 45px;">
                    <button type="button" @click="toggleSearchBar()" class="pull-left btn btn-success" style="margin-top: -36px;"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="submit" class="pull-right btn btn-default" style="margin-top: -36px;"><i class="glyphicon glyphicon-search"></i></button>
                 </form>
                    
                </div>
                </div>
<?php
    $query_array=['query'=>$query];
?>
                <div class="panel-body">
                @if($words->count())
                   <table class="table table-stripped animated fadeInUp">
                       <thead>
                           <tr>
                                <th>#</th>
                                <th>Word</th>
                                <th>Type</th>
                                <th>English Definition</th>
                                <th>Bodo Definition</th>
                            </tr>
                       </thead>
                        <tbody>
                        @foreach($words as $key=>$word)
                        <tr class="text-warning">
                            <td>{{($word->current_page+1)*($key+1)}}</td>
                            <td>{{$word->word}}</td>
                            <td>{{$word->wordtype}}</td>
                            <td>{{$word->definition}}</td>
                            <td>
                            @if($word->bodo_definition)
                                {{$word->bodo_definition}}
                                
                            @else
                               
                            @endif

                            </td>
                        </tr>
                       @endforeach
                        </tbody>
                       
                   </table>
                  
                   @else
                   <div class="alert alert-warning text-center">
                       Sorry! No result found for query <i><u>{{$query}}</u></i>
                   </div>
                   @endif
                </div>
        </div>
        <div class="text-center"> {{$words->appends($query_array)->links()}}</div>
            
        </div>
    </div>
</div>
@endsection
