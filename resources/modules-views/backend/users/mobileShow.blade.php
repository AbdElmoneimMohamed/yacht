@extends('backend.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{__("messages.Name")}} : {{$user->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{__("messages.Email")}} : {{$user->email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Phone : {{$user->phone}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Address : {{$user->address}}
                        </div>
                    </div>
                </div>
                <div class="panel-heading">Pets</div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Profile Image</th>
                            <th>Name</th>
                            <th>BirthDate</th>
                            <th>Mating Status</th>
                            <th>Sale Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $user->pets as $pet)
                        <tr>
                            <td>{{ Form::image(env("APP_URL") . "/pets/$pet->id/image", 'placeImages', ['class' => 'img-rounded', "style = display:block;width:80px;height:80px;margin-top:5px"]) }}</td>
                            <td>{{$pet->name}}</td>
                            <td>{{$pet->birthDate}}</td>
                            <td>{{isset($pet->petMating) && ($pet->petMating->status == 1)? "On" : "Off"}}</td>
                            <td>{{isset($pet->petSale) && ($pet->petSale->status == 1) ? "On" : "Off"}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="panel-heading">Notifications</div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Body</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $notifications as $notification)
                            <tr>
                                <td>{{$notification->title}}</td>
                                <td>{{$notification->body}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="panel-heading">Send Notification</div>
                <div class="panel-body">
                    {{ Form::open(['url' =>  env("APP_URL") . "/notification/$user->id" , "method" => "post", "enctype" => "multipart/form-data"]) }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::label('title', "Title", []) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::input('text', 'title',  null, ['class' => "form-control", "required", "placeholder" => "Title"]) }}
                            </div>
                            @if ($errors->has('title'))
                                <span class="error text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::label('body', "Body", []) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::textarea('body', null, ['class' => " form-control", "required", "style" => "resize:none;", "cols" => "50", "rows" => "5","placeholder" => "Body"]) }}
                            </div>
                            @if ($errors->has('body'))
                                <span class="error text-danger">{{ $errors->first('body') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::submit("Send", ["class" => "btn btn-success"]) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
