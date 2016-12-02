@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
                <history></history>
            
        </div>
    </div>
</div>
<!-- <template id="history" type="script/template">
  <div class="panel panel-default">
    <div class="panel-heading">History<button class="btn btn-default pull-right" @click="showCreateForm()"><i class="fa fa-plus"></i></button></div>

    <div class="panel-body">   
        
        <div class="list-group">
            <div class="list-group-item" v-for="event in history">
                <p>@{{event.year}}@{{event.month?'-'+event.month:''}}@{{event.date?'-'+event.date:''}}</p>
                <p >@{{event.details}}</p>
            </div>
        </div>                   
    </div>
</div>     
</template> -->
@endsection
