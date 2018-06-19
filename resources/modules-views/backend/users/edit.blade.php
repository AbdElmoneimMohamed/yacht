@extends('layouts.app')
@section('main_container')
<div class="right_col" role="main"> 
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{__("messages.UpdateUser")}}</div>
                <div class="panel-body">
                    {{ Form::open(['url' => env("APP_URL") . "/users/$user->id" , "method" => "Put", "enctype" => "multipart/form-data"]) }}
                        @include('users.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
