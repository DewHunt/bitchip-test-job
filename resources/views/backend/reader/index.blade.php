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
                    <th width="250px">First Name</th>
                    <th width="250px">Last Name</th>
                    <th width="250px">Email</th>
                    <th width="100px">Phone</th>
                    <th width="50px">Status</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($readerList as $reader)
                    <tr class="row_{{ $reader->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $reader->first_name }}</td>
                        <td>{{ $reader->last_name }}</td>
                        <td>{{ $reader->email }}</td>
                        <td>{{ $reader->phone }}</td>
                        <td>
                            @php
                                echo status($reader->id,$reader->status);
                            @endphp
                        </td>
                        <td>
                            @php
                                echo actions($reader->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection