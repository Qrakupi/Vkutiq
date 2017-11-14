@extends('home')

@section('content')
@include('layout/errors')
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 col-xs-offset-5 loginContainer">	
     <form method="post" action="/login">
     	{{csrf_field()}}
         <h1 class="loginTitle">Влезни в акаунт</h1>
         <input name="name" type="text" placeholder="Въведи име"  class="input pass" minlength="3" maxlength="12" required>
         <input name="password" type="password" placeholder="Въведи парола" class="input pass" minlength="3" maxlength="12" required>
         <input type="submit" value="Логни ме!" class="inputButton">
     </form>
</div>
@endsection