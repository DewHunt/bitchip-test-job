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
                    <th>Name</th>
                    <th width="100px">Action ID</th>
                    <th width="50px">Status</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuActionTypeList as $menuActionType)
                    <tr class="row_{{ $menuActionType->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $menuActionType->name }}</td>
                        <td>{{ $menuActionType->action_id }}</td>
                        <td>
                            @php
                                echo status($menuActionType->id,$menuActionType->status);
                            @endphp
                        </td>
                        <td>
                            @php
                                echo actions($menuActionType->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection