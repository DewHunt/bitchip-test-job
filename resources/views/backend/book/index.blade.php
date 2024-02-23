@extends('backend.layouts.master_index')

@section('page_content')
    @php
        $sl = 1;
    @endphp

    <div class="dt-responsive table-responsive">
        <table id="complex-dt" class="table table-bordered table-striped">
            <thead>
                <tr>                                    
                    <th width="20px">Sl</th>
                    <th width="250px">Name</th>
                    <th width="250px">Author</th>
                    <th>Description</th>
                    <th width="100px">Image</th>
                    <th width="50px">Status</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookList as $book)
                    <tr class="row_{{ $book->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->description }}</td>
                        <td><img src="{{ asset($book->image) }}" alt="book image" height="100px"></td>
                        <td>
                            @php
                                echo status($book->id,$book->status);
                            @endphp
                        </td>
                        <td>
                            @php
                                echo actions($book->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection