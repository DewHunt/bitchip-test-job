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
                    <th>Menu Name</th>
                    <th width="50px">Order By</th>
                    <th width="50px">Status</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userRoleList as $userRole)
                    @php
                        if (empty($userRole->permission)) {
                            $menus = [];
                        } else {
                            $menus = getMenusByMultipleId($userRole->permission);
                        }

                        $menuNameArray = array();
                        foreach ($menus as $menu) {
                            array_push($menuNameArray, $menu->menu_name);
                        }

                        $menuName = implode(', ',$menuNameArray)
                    @endphp
                    <tr class="row_{{ $userRole->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $userRole->name }}</td>
                        <td>{{ $menuName }}</td>
                        <td class="text-center">{{ $userRole->order_by }}</td>
                        <td>
                            @php
                                echo status($userRole->id,$userRole->status);
                            @endphp
                        </td>
                        <td>
                            @php
                                echo actions($userRole->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection