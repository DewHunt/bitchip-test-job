@extends('backend.layouts.master_view')

@section('page_content')
	<div class="row">
		<div class="col-lg-2 text-center">
        	<div class="card bg-light text-dark">
        		<img class="card-img-top" src="{{ asset($userInfo->image) }}" alt="User image" height="250px">
        	</div>
		</div>

		<div class="col-lg-10">
		    <div class="row">
		    	<div class="col-md-6">
		        	<div class="card bg-light text-dark">
		        		<div class="card-body"><h4>Name : {{ $userInfo->name }}</h4></div>
		        	</div>
		        </div>

		        <div class="col-md-6">
		        	<div class="card bg-light text-dark">
		        		<div class="card-body"><h4>User Name : {{ $userInfo->user_name }}</h4></div>
		        	</div>
		        </div>
		    </div>

		    <div class="row">
		        <div class="col-md-6">
		        	<div class="card bg-light text-dark">
		        		<div class="card-body"><h4>Email : {{ $userInfo->email }}</h4></div>
		        	</div>
		        </div>

		        <div class="col-md-6">
		        	<div class="card bg-light text-dark">
		        		<div class="card-body"><h4>Status : {{ $userInfo->status == 1 ? 'Active' : 'Deactive' }}</h4></div>
		        	</div>
		        </div>
		    </div>

		    <div class="row">
		        <div class="col-md-6">
		        	@if (isset($editLink))
		        		<a class="btn btn-outline-info btn-block" href="{{ route($editLink,$userInfo->id) }}">{{ $editButtonName }}</a>
		        	@else
		        		<span class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#editProfileModal">{{ $editButtonName }}</span>

						<!-- Edit Profile Modal -->
						<div class="modal fade" id="editProfileModal">
							<div class="modal-dialog modal-xl modal-dialog-centered">
								<div class="modal-content">

									<div class="modal-header">
										<h1 class="modal-title">Edit Profile Information</h1>
										<button type="button" class="close" data-dismiss="modal">×</button>
									</div>

									<form class="form-horizontal" action="{{ route($editFormLink) }}" id="formAddEdit" method="POST" enctype="multipart/form-data" name="form">
								        {{ csrf_field() }}

										<div class="modal-body">
											<input class="form-control" type="hidden" name="profileId" value="{{ Auth::user()->id }}">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="name">Name</label>
														<input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Enter Your Name" required>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="name">User Name</label>
														<input class="form-control" type="text" name="username" value="{{ Auth::user()->user_name }}" placeholder="Enter Your User Name" required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="email">Email</label>
														<input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}" placeholder="Enter Your Email" required>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
										                <label for="user-image">User Image</label>
										                <input type="file" class="form-control" name="userImage">
										                <input type="hidden" class="form-control" name="previousUserImage" value="{{ $userInfo->image }}">
													</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<button class="btn btn-outline-success btn-md">Save</button>
											<span type="button" class="btn btn-outline-danger btn-md" data-dismiss="modal">Close</span>
										</div>
									</form>
								</div>
							</div>
						</div>
		        	@endif
		        </div>

		        <div class="col-md-6">
		        	@if (isset($changePasswordLink))
		        		<a class="btn btn-outline-danger btn-block" href="{{ route($changePasswordLink,$userInfo->id) }}">{{ $changePasswordButtonName }}</a>
		        	@else
		        		<span class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#changePasswordModal">{{ $changePasswordButtonName }}</span>

						<!-- Change Password Modal -->
						<div class="modal fade" id="changePasswordModal">
							<div class="modal-dialog modal-lg modal-dialog-centered">
								<div class="modal-content">

									<div class="modal-header">
										<h1 class="modal-title">Change Password</h1>
										<button type="button" class="close" data-dismiss="modal">×</button>
									</div>

									<form class="form-horizontal" action="{{ route($changePasswordFormLink) }}" id="change_password_form" method="POST" enctype="multipart/form-data" name="form">
								        {{ csrf_field() }}
										<div class="modal-body">
											<input class="form-control" type="hidden" name="profileId" value="{{ Auth::user()->id }}">
							        		<div class="row">
							        			<div class="col-lg-6">
							        				<div class="form-group">
							        					<label>Password</label>
							        					<input type="password" class="form-control form-control-danger" id="password" name="password" placeholder="*****" required>
							        				</div>
							        			</div>

							        			<div class="col-lg-6">
							        				<div class="form-group">
							        					<label>Confirm Password</label>
							        					<input type="password" class="form-control form-control-danger" id="confirmPassword" name="confirmPassword" placeholder="*****" oninput="checkPassword()" required>
							        				</div>
							        			</div>
							        		</div>
										</div>

										<div class="modal-footer">
											<button class="btn btn-outline-success btn-md">Save</button>
											<span type="button" class="btn btn-outline-danger btn-md" data-dismiss="modal">Close</span>
										</div>
							        </form>
								</div>
							</div>
						</div>
		        	@endif
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section('custom_js')
	<script type="text/javascript">
		function checkPassword() {
			var password = $('#password').val();
			var confirmPassword = $('#confirmPassword').val();

			if (password == confirmPassword) {
				$('#confirmPassword').css('border','1px solid #ced4da');
			} else {
				$('#confirmPassword').css('border','1px solid red');
			}
		}

		$("#change_password_form").submit(function( event ) {
			var password = $('#password').val();
			var confirmPassword = $('#confirmPassword').val();

			if (password == confirmPassword) {
				return true;
			} else {
                swal({
                    title: "<small class='text-danger'>Oops!</small>", 
                    type: "error",
                    text: 'Your Confirm Password Does Not Matched',
                    timer: 2000,
                    html: true,
                });
				event.preventDefault();
			}
		});
	</script>
@endsection