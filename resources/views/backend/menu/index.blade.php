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
                    <th>Parent</th>
                    <th>Link</th>
                    <th width="100px">Icon</th>
                    <th width="50px">Order</th>
                    <th width="50px">Status</th>
                    <th width="80px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuList as $menu)
                    <tr class="row_{{ $menu->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $menu->menu_name }}</td>
                        <td>{{ $menu->parentName }}</td>
                        <td>{{ $menu->menu_link }}</td>
                        <td>{{ $menu->menu_icon }}</td>
                        <td>{{ $menu->order_by }}</td>
                        <td class="text-center">
                            @php
                                echo status($menu->id,$menu->status);
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                echo actions($menu->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection