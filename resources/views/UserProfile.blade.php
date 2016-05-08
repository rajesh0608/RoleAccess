<h4>User Profile</h4>
{!! Html::link('logOut', 'Click here to log out') !!}

@if(Auth::check())
    User Log in ...
@endif