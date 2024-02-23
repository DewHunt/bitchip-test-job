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
			                        $error = Session::get('error');
			    			    @endphp

			    			    @if (isset($message))
			    					<div class="alert alert-success alert-dismissible">
			    						<button type="button" class="close" data-dismiss="alert">&times;</button>
			    						<strong>Success!</strong> {{ $message }}
			    					</div>
			    			    @endif

			                    @if (isset($error))
			                        <div class="alert alert-danger alert-dismissible">
			                            <button type="button" class="close" data-dismiss="alert">&times;</button>
			                            <strong>Oops!</strong> {{ $error }}
			                        </div>
			                    @endif

			    			    @php
			    			        Session::forget('msg');
			                        Session::forget('error');
			    			    @endphp

					        	<form class="form-horizontal" id="add_edit_form" action="{{ route($formLink) }}" method="POST" enctype="multipart/form-data" name="form">
					        		{{ csrf_field() }}
						            <div class="card">
						                {{-- <div id="sticky-action" class="sticky-action"> --}}
						                    <div class="card-header">
						                        <div class="row align-items-center">
						                            <div class="col-sm-6">
						                                <h5>{{ $title }}</h5>
						                            </div>
						                            <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
								                        <a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
								                        	<i class="fa fa-arrow-circle-left"></i>Go Back
								                        </a>
						                            	<button type="submit" class="btn btn-outline-success btn-lg"><i class="fa fa-save"></i>{{ $buttonName }}</button>
						                            </div>
						                        </div>
						                    </div>
						                {{-- </div> --}}
						                <div class="card-body">							    
											<!-- [ Main Content ] start -->
											@yield('page_content')
											<!-- [ Main Content ] end -->
						                </div>
						            </div>
					        	</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->

		@include('backend.includes.footer_assets')

		<script>
			$(window).on('scroll', function() {
				var ws = $(this).scrollTop();
				var port = $('#sticky-action');
				var elm = $(port, this);
				var off = elm.offset();
				var l = off.left;
				var r = off.right;
				var t = off.top;
				ws = ws + 70;
				if (ws >= t) {
					port.addClass('sticky');
					port.children('.card-header').css({
						"left":l,
						"right":"25px"
					});
				} else {
					port.children('.card-header').removeAttr("style");
					port.removeClass('sticky');
				}
			});
		</script>

		@yield('custom_js')
	</body>
</html>
