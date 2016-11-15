@extends('layouts.admin')

@section('content')
 <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Admin Menu</div>

                <div class="panel-body">
                    @if(Session::has('error'))
                    <br>
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    <br>
                    @endif
                    
                    <a class="col-md-3" href="/admin/dictionary-translate">
                        <i class="fa fa-language" aria-hidden="true"></i>
                        Dictionary translate
                    </a>       

                </div>
            </div>
        </div>
@endsection
