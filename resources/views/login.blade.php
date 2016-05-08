<h4>Login Form</h4>

<div>
    @if(Session::has('error'))
        {{Session::get('error')}}
    @endif

     {!! Form::open(array('url' =>'loginme')) !!}
     {!! Form::text('email','', array('id' => 'email', 'placeholder' => 'Enter Email Address')) !!}
     {!! Form::password('password','', array('id' => 'pass', 'placeholder' => 'Password')) !!}
     {!! Form::submit('login') !!}
     {!! Form::close() !!}
    @if(Auth::check())
        User Log in ...
    @endif
</div>