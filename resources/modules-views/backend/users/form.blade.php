<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('name', __('messages.Name') , []) }}
        </div>
        <div class="col-md-6">
            {{ Form::input('text', 'name', isset($user) ? $user->name : null, ['class' => "form-control", "required"]) }}
        @if ($errors->has('name'))
            <span class="error text-danger">{{ $errors->first('name') }}</span>
        @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('email', __('messages.Email'), []) }}
        </div>
        <div class="col-md-6">
            {{ Form::input('email', 'email', isset($user) ? $user->email : null, ['class' => "form-control", "required"]) }}
            @if ($errors->has('email'))
                <span class="error text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('phone', __("messages.PhoneNumber"), []) }}
        </div>
        <div class="col-md-6">
            {{ Form::input('text', 'phone', isset($user) ? $user->phone : null, ['class' => "form-control", "required"]) }}
            @if ($errors->has('phone'))
                <span class="error text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>

    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('password', __('messages.Password'), []) }}
        </div>
        <div class="col-md-6">
            {{ Form::input('password', 'password', null, ['class' => "form-control",isset($user) ? "" : "required"]) }}
            @if ($errors->has('password'))
                <span class="error text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>

</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('password_confirmation', __('messages.ConfirmPassword'), []) }}
        </div>
        <div class="col-md-6">
            {{ Form::input('password', 'password_confirmation', null, ['class' => "form-control", isset($user) ? "" : "required"]) }}
        </div>
    </div>
</div>

 <div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('avatar', "Avatar", []) }}
        </div>
        <div class="col-md-8">
            {{ Form::file('avatar', ["id" => "avatar", 'class' => "form-control"]) }}
            @if ($errors->has('avatar'))
                <span class="error text-danger">{{ $errors->first('avatar') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            {{ Form::submit(__('messages.Save'), ["class" => "btn btn-success"]) }}
        </div>
    </div>
</div>

@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
        @if(isset($user))
                avatar = ["<img src='avatar' class='file-preview-image kv-preview-data rotate-1'>"];
            @else
                avatar = [];
            @endif

            $("#avatar").fileinput({
                initialPreview: avatar,
                initialPreviewConfig: [
                    {
                        width: '120px',
                }],
                theme: "gly",
                showPreview: true,
                showUpload: false,
                showRemove: false,
                allowedFileExtensions: ["jpg", "png", "gif"]
            });
            
        })
    </script>
@endsection
