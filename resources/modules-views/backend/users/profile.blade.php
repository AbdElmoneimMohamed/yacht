@extends('layouts.app')
@section('main_container')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                {{__("messages.Name")}} :
                            </div>
                            <div class="col-md-6">
                                {{$user->name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                {{__("messages.Email")}} :
                            </div>
                            <div class="col-md-6">
                                {{$user->email}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                Mobile :
                            </div>
                            <div class="col-md-6">
                                {{$user->mobile}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
