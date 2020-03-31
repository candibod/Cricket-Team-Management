<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

	<link type="image/png" rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicon.png">
	<link type="image/png" rel="icon" href="/assets/images/favicon.png">

	<title>CPL | Cricket League</title>
	<meta name="description" content="Cricket management system covering all the major concepts of laravel">
	<meta name="keywords" content="cricket, management, laravel">

	<meta property="og:title" content="CPL | Cricket League">
	<meta property="og:description" content="Cricket management system covering all the major concepts of laravel">

	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Organization",
			"name": "CPL",
			"legalName": "Cricket Premier League",
			"url": "https://cricket.org",
			"email": "jeevan@cricket.com",
			"foundingDate": "2020-03-31",
			"contactPoint": [{
				"@type": "ContactPoint",
				"telephone": "+91-1231231231",
				"contactType": "customer service",
				"areaServed": "IN",
				"availableLanguage": ["English", "Telugu", "Hindi"]
			}]
		}
	</script>

	@yield('css')
</head>
<body class="body-parent" style="margin: 0">
<div>
	@yield('header')

	@yield('content')

	@yield('footer')

	<script src="{{ asset('js/all.js') }}"></script>
	@yield('javascript')
</div>
</body>
</html>
