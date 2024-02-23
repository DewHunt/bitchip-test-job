@extends('backend.layouts.master_add_edit')

@section('page_content')
	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			<label for="title">Title</label>
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Name">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<label for="developed-by">Developed By</label>
			<div class="form-group">
				<input type="text" class="form-control" name="developedBy" placeholder="Developed By">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<label for="developer-site">Developer Site</label>
			<div class="form-group">
				<input type="text" class="form-control" name="developerSite" placeholder="Developer Site">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <label for="logo-image">Logo Image</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="logoImage">
            </div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <label for="thumb-logo-image">Thumb Logo Image</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="thumbLogoImage">
            </div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
            <label for="fav-icon">Fav Icon</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="favIcon">
            </div>
		</div>
	</div>
@endsection