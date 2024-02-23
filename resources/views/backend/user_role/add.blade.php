@extends('backend.layouts.master_add_edit')

@section('page_content')
	<div class="row">
		<div class="col-lg-6">
			<label for="name">Name</label>
			<div class="form-group">
				<input type="text" class="form-control" name="name" placeholder="name" required>
			</div>
		</div>

		<div class="col-lg-6">
			<label for="oreder-by">Order By</label>
			<div class="form-group">
				<input type="number" class="form-control" name="order_by" min="1" placeholder="Order by" value="1" required>
			</div>
		</div>
	</div>
@endsection