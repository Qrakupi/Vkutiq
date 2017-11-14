@extends('home')

@section('content')
@include('layout/errors')

<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 col-sm-offset-5 col-xs-offset-4 registerContainer">
     <form id="signup" method="post" action="/register">
        {{ csrf_field() }}
         <h1 class="registerTitle">Създаи акаунт</h1>
         <input name="name" type="text" placeholder="Въведи име"  class="input pass" minlength="1" maxlength="12" required>
         <input name="email" type="email" placeholder="Въведи е-майл" class="input pass" required>
         <input name="password" type="password" placeholder="Избери парола" class="input pass" minlength="3" maxlength="12" required>
         <input name="password_confirmation" type="password" placeholder="Потвърди парола" class="input pass" minlength="3" maxlength="12" required>
         <input type="submit" value="Регистрираи ме!" class="inputButton">
     </form>
</div>
@endsection