@extends('backend.layouts.master_add_edit')

@section('page_content')
	<input class="form-control" type="hidden" name="readerId" value="{{ $readerInfo->id }}">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">                 
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" class="form-control" name="firstName" value="{{ $readerInfo->first_name }}" required>
            </div>                                       
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">                 
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control" name="lastName" value="{{ $readerInfo->last_name }}" required>
            </div>                                       
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $readerInfo->email }}">
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col"> 
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $readerInfo->phone }}">
            </div>                                       
        </div>
    </div>
@endsection