<!DOCTYPE html>
<html lang="en">
	<head>
		@include('frontend.includes.meta')
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		

        <title>@yield('title')</title>

		@include('frontend.includes.style')

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		@include('notify::components.notify')
		<!-- HEADER -->
		@include('frontend.includes.header')
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		@include('frontend.includes.nav')
		<!-- /NAVIGATION -->

		<!-- SECTION -->
		@yield('content')
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		@include('frontend.includes.footer')
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		@include('frontend.includes.script')
	</body>
</html>
