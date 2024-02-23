@extends('backend.layouts.master_view')

@section('page_content')
    @php
        $sl = 1;
    @endphp

    <div class="dt-responsive table-responsive">
        <table class="table table-borderless table-striped" style="border: 1px solid #e2e5e8;">
            <tbody>
            	<tr>
            		<th width="60px">Parent Menu : </th>
            		<td>{{ @$menuInfo->parentName }}</td>
            		<th width="60px">Name : </th>
            		<td>{{ @$menuInfo->menu_name }}</td>
            		<th width="60px">Link : </th>
            		<td>{{ @$menuInfo->menu_link }}</td>
            	</tr>
            	<tr>
            		<th width="60px">Icon : </th>
            		<td>{{ @$menuInfo->menu_icon }}</td>
            		<th width="60px">Order BY : </th>
            		<td>{{ @$menuInfo->order_by }}</td>
            		<th width="60px">Status : </th>
            		<td>{{ @$menuInfo->status == 1 ? 'Active' : 'Deactive' }}</td>
            	</tr>
            </tbody>
        </table>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Menu Action Information</th>
                </tr>
                <tr>
                    <th width="20px">Sl</th>
                    <th>Menu Type</th>
                    <th>Action Name</th>
                    <th>Link</th>
                    <th width="20px">Order</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sl = 1;
                @endphp

                @foreach ($menuActionList as $menuAction)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $menuAction->menuTypeName }}</td>
                        <td>{{ $menuAction->action_name }}</td>
                        <td>{{ $menuAction->action_link }}</td>
                        <td>{{ $menuAction->order_by }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection