@extends('layouts.app')
@section('main_container')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading col-md-12">
                    <div class="col-md-4">
                    {{Html::link(env("APP_URL") . "/users/create", __('messages.CreateNewUser'), ['class' => "btn btn-success"])}}
                    </div>
                    <div class="col-md-3">
                        {{ Form::input('search', 'search', $search, ['id'=>'inputSearch', 'class' => "form-control", "placeholder" => "Search"]) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::button('Filter', ['class' => 'btn btn-success', 'id'=>'search']) }}
                    </div>
                    
                    <div class="col-md-3">
                       {{ Form::select('filter', ["activated" => "Activated", "deactivated" => "Deactivated", "all" => "All"], null, ['id' => 'filter', 'class' => "form-control "]) }}
                    </div> 
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>{{__("messages.Name")}}</th>
                            <th>{{__("messages.Email")}}</th>
                            <th>{{__("messages.Actions")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user)
                        <tr @if($user->status) @else bgcolor="FFB6C1" @endif >
                            <td class="col-sm-3">{{$user->name}}</td>
                            <td class="col-sm-3">{{$user->email}}</td>
                            <td class="col-sm-4">
                                <div class="col-sm-2">
                                    <a href="{{env("APP_URL")}}/users/{{$user->id}}" title="View" class="btn btn-link">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="{{env("APP_URL")}}/users/{{$user->id}}/edit" title="Edit" class="btn btn-link">
                                        <i class="glyphicon glyphicon glyphicon-edit"></i>
                                    </a>
                                </div>
                                @if($user->status)
                                <div class="col-sm-2">
                                    {{ Form::open(['url' => env("APP_URL") . "/users/$user->id" , "method" => "DELETE"]) }}
                                    <button type="submit" title="Deactivate" class="btn btn-link">
                                            <i class="glyphicon glyphicon glyphicon-remove"></i>
                                    </button>
                                    {{ Form::close() }}
                                </div>
                                @else
                                    <div class="col-sm-2">
                                        {{ Form::open(['url' => env("APP_URL") . "/users/$user->id/activate" , "method" => "POST"]) }}
                                            <button type="submit" title="Activate" class="btn btn-link">
                                                <i class="glyphicon glyphicon glyphicon-ok"></i>
                                            </button>
                                        {{ Form::close() }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                       @endforeach
                        </tbody>
                    </table>

                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter').on('change', function () {
                selected = this.value;
                window.location.replace('?filter=' + selected);
            })
             $('#search').click(function () {
                val = $('#inputSearch').val();
                window.location.replace('?q=' + val);
            })
        })
    </script>
@endsection
