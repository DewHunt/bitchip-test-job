@extends('backend.layouts.master_add_edit')

@section('page_content')
	<input class="form-control" type="hidden" name="userId" value="{{ $userId }}">
	<div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-danger" id="password" name="password" placeholder="*****" required>
            </div>                                       
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control form-control-danger" id="confirmPassword" name="confirmPassword" placeholder="*****" oninput="checkPassword()" required>
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

		$("#add_edit_form").submit(function( event ) {
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