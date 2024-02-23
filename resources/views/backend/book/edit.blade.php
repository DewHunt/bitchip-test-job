@extends('backend.layouts.master_add_edit')

@section('page_content')
	<input class="form-control" type="hidden" name="bookId" value="{{ $bookInfo->id }}">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">                 
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $bookInfo->name }}" required>
            </div>                                       
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
            <div class="form-group">
                <label for="author-name">Author Name</label>
                <input type="text" class="form-control" name="authorName" value="{{ $bookInfo->author }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col"> 
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="5">{{ $bookInfo->description }}</textarea>
            </div>                                       
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col"> 
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="bookImage">
                <input type="hidden" class="form-control" name="previousBookImage" value="{{ $bookInfo->image }}">
            </div>                                       
        </div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col text-center">
			<div class="form-group">
				<img src="{{ asset($bookInfo->image) }}" alt="book image" width="150px" height="150px">
			</div>
		</div>
    </div>
@endsection