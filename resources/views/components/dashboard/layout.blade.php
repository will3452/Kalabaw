<!doctype html>
<html lang="en">

<head>
	<title>AgriAssistance</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
    @stack('head-script')
    <script src="https://kit.fontawesome.com/a4002f772f.js" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<x-dashboard.navbar />
		<x-dashboard.sidebar />
		<!-- MAIN -->
		<div class="main">
            <div class="main-content">
				<div class="container-fluid">
                    <x-breadcrumb></x-breadcrumb>
                    {{-- {{pathinfo("".url()->current())}} --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $e)
                            <div class="alert alert-danger mb-2">{{$e}}</div>
                        @endforeach
                    @endif
			        {{$slot}}
                </div>
            </div>
		</div>
		<x-dashboard.footer />
	</div>
    <!-- END WRAPPER -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <!-- Javascript -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    @stack('body-script')
    <script src="/assets/scripts/klorofil-common.js"></script>
</body>
</html>
