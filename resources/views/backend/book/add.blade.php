@extends('backend.layouts.master_add_edit')

@section('page_content')
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">                 
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="" required>
            </div>                                       
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
            <div class="form-group">
                <label for="author-name">Author Name</label>
                <input type="text" class="form-control" name="authorName" value="">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col"> 
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="5"></textarea>
            </div>                                       
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col"> 
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="bookImage">
            </div>                                       
        </div>
    </div>
@endsection