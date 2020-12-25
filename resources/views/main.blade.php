<html>
<head>
    <link rel="stylesheet" href="/css/global.css" type="text/css">

    <title>Перерезка картинок</title>

</head>

	<body>
		<div class="container">

			<header>
				<h2>Перерезка картинок</h2>
			</header>

			<div class="main">
				@yield('content')
			</div>

			<div class="footer clearfix">
				@yield('footer')
			</div>


			@yield('script')

		</div>
	</body>
</html>
