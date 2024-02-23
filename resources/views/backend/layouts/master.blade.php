<!DOCTYPE html>
<html lang="en">
	<head>
		@include('backend.includes.head')

		@include('backend.includes.head_assets')

		@yield('custom_css')
	</head>

	<body class="">
		<!-- [ Pre-loader ] start -->
		@include('backend.includes.preloader')
		<!-- [ Pre-loader ] End -->

		<!-- [ navigation menu ] start -->
		@include('backend.includes.menu')
		<!-- [ navigation menu ] end -->		

		<!-- [ Header ] start -->
		@include('backend.includes.top_navbar')
		<!-- [ Header ] end -->

		<!-- [ Main Content ] start -->
		<div class="pcoded-main-container">
			<div class="pcoded-wrapper">
				<div class="pcoded-content">
					<div class="pcoded-inner-content">
						<div class="main-body">
							<div class="page-wrapper">
							    @php
							        $message = Session::get('msg');
							    @endphp

							    @if (isset($message))
									<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> {{ $message }}
									</div>
							    @endif

							    @php
							        Session::forget('msg');
							    @endphp
							    
								<!-- [ Main Content ] start -->
								@yield('page_content')
								<!-- [ Main Content ] end -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->

		@include('backend.includes.footer_assets')

		@yield('custom_js')
	</body>
</html>
