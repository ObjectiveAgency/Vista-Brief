<!DOCTYPE html>
<html lang="en" class="">
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ URL::asset('libs/assets/animate.css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('libs/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('libs/assets/simple-line-icons/css/simple-line-icons.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ URL::asset('css/app2.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('css/font.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('css/font2.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" type="text/css" />

	<script src="{{ URL::asset('libs/jquery/jquery/dist/jquery.js') }}"></script>
	<script src="{{ URL::asset('libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
</head>
<body>


@yield('content')

@yield('footer')


<script src="{{ URL::asset('libs/jquery/jquery/dist/jquery.js') }}"></script>
<script src="{{ URL::asset('libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ URL::asset('js/ui-load.js') }}"></script>
<script src="{{ URL::asset('js/ui-jp.config.js') }}"></script>
<script src="{{ URL::asset('js/ui-jp.js') }}"</script>
<script src="{{ URL::asset('js/ui-nav.js') }}"></script>
<script src="{{ URL::asset('js/ui-toggle.js') }}"></script>
<script src="{{ URL::asset('js/ui-client.js') }}"></script>

</body>
</html>