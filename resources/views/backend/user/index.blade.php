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
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Rejected Menu Name</th>
                    <th width="50px">Status</th>
                    <th width="50px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userList as $user)
                    @php
                        if (empty($user->permission)) {
                            $menus = [];
                        } else {
                            $menus = getMenusByMultipleId($user->permission);
                        }

                        $menuNameArray = array();
                        foreach ($menus as $menu) {
                            array_push($menuNameArray, $menu->menu_name);
                        }

                        $menuName = implode(', ',$menuNameArray)
                    @endphp
                    <tr class="row_{{ $user->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->userRoleName }}</td>
                        <td>{{ $menuName }}</td>
                        <td>
                            @php
                                echo status($user->id,$user->status);
                            @endphp
                        </td>
                        <td>
                            @php
                                echo actions($user->id);
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection