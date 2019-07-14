<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <title>@yield('title')</title>
    </head>
    <body>
		<div id="app">
			<router-view></router-view>
		</div>
	</body>
</html>