
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 navMenu">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="text-align:center">
			<a href="/" class="logo">VKUTIQ<span>7</span></a>
		</div>
		<div class="col-lg-4 col-md-5 col-sm-9 col-xs-8">
			<form method="get" action="/search">
				<input type="text" name="search_input" class="searchBox">
				<input type="submit" value="Търси!">
			</form>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-0 col-xs-offset-0 userNavContainer">
			@if(auth()->check())
			<a href="/profile/1" class="authNav">Профил</a>|<a href="/logout" class="authNav">Изход</a>
			@else
			<a href="/login" class="authNav">Вход</a>|<a href="/register" class="authNav">Регистрация</a>
			@endif
		</div>
	</div>
</div>