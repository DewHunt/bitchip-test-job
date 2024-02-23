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
                                
							    <div class="row">
							        <div class="col-lg-12">
							            <div class="card">
						                    <div class="card-header">
						                        <div class="row align-items-center">
						                            <div class="col-sm-6">
						                                <h5>{{ $title }}</h5>
						                            </div>
						                            <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                                                        @if (addAction())
    								                        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="{{ route($addNewLink) }}">
    								                            <i class="fa fa-plus-circle"></i> Add New
    								                        </a> 
                                                        @endif
						                            </div>
						                        </div>
						                    </div>
							                <div class="card-body">
												<!-- [ Main Content ] start -->
												@yield('page_content')
												<!-- [ Main Content ] end -->
							                </div>
							            </div>
							        </div>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end -->

		@include('backend.includes.footer_assets')

        <script>
            $(document).on('click', '#complex-dt tbody i.fa-trash', function () {
                id = $(this).parent().data('id');
                var tableRow = this;
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this information!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                },
                function(isConfirm) {   
                    if (isConfirm) {
                        $.ajax({
                            type: "post",
                            url : "{{ route($deleteLink) }}",
                            data : {_token:'{{ csrf_token() }}',id:id},                               
                            success: function(response) {
                                if (response.isDelete == true) {
                                    swal({
                                        title: "<small class='text-success'>Success!</small>", 
                                        type: "success",
                                        text: "Deleted Successfully!",
                                        timer: 1000,
                                        html: true,
                                    });
                                    $('.row_'+id).remove();

                                    setTimeout (function() {location.reload();}, 1000);
                                } else {
                                    swal({
                                        title: "<small class='text-success'>Please, Read The Message!</small>", 
                                        type: "error",
                                        text: response.message,
                                        // timer: 1000,
                                        html: true,
                                    });
                                }
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });    
                    } else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "This Data Is Safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
                    
            //ajax status change code
            function statusChange(id) {
                $.ajax({
                    type: "post",
                    url: "{{ route($statusLink) }}",
                    data: {_token:'{{ csrf_token() }}',id:id},
                    success: function(response) {
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status Successfully Updated!",
                            timer: 1000,
                            html: true,
                        });
                    },
                    error: function(response) {
                        error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });
                    }
                });
            }
        </script>

		@yield('custom_js')
	</body>
</html>
