@extends('backend.layouts.master_add_edit')

@section('page_content')
	<input class="form-control" type="hidden" name="adminSettingsId" value="{{ $adminSettingsInfo->id }}">

	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
			<label for="title">Title</label>
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Name" value="{{ $adminSettingsInfo->title }}">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<label for="developed-by">Developed By</label>
			<div class="form-group">
				<input type="text" class="form-control" name="developedBy" placeholder="Developed By" value="{{ $adminSettingsInfo->developed_by }}">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<label for="developer-site">Developer Site</label>
			<div class="form-group">
				<input type="text" class="form-control" name="developerSite" placeholder="Developer Site" value="{{ $adminSettingsInfo->developer_site }}">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="logo-image">Logo Image</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="logoImage">
            	<input type="hidden" class="form-control" name="previousLogoImage" value="{{ $adminSettingsInfo->logo }}">
            </div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <label for="thumb-logo-image">Thumb Logo Image</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="thumbLogoImage">
            	<input type="hidden" class="form-control" name="previoustThumbLogoImage" value="{{ $adminSettingsInfo->thumb_logo }}">
            </div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="fav-icon">Fav Icon</label>
            <div class="form-group">
            	<input type="file" class="form-control" name="favIcon">
            	<input type="hidden" class="form-control" name="previousFavIcon" value="{{ $adminSettingsInfo->fav_icon }}">
            </div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="logo-image"></label>
			<div class="form-group">
				<img src="{{ asset($adminSettingsInfo->logo) }}" alt="Logo Image" width="250px" height="100px">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="thumb-logo-image"></label>
			<div class="form-group">
				<img src="{{ asset($adminSettingsInfo->thumb_logo) }}" alt="Logo Image" width="250px" height="100px">
			</div>
		</div>

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <label for="fav-icon"></label>
			<div class="form-group">
				<img src="{{ asset($adminSettingsInfo->fav_icon) }}" alt="Fav Icon" width="150px" height="100px">
			</div>
		</div>
	</div>
@endsection