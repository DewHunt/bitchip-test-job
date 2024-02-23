@extends('backend.layouts.master_view')

@section('page_content')
    @php
        $sl = 1;
    @endphp

    <div class="dt-responsive table-responsive">
        <table class="table table-borderless table-striped">
            <tbody>
            	<tr>
            		<td width="120px">Parent Menu</td>
            		<td> : {{ $menuInfo->parentName }}</td>
            	</tr>
            	<tr>
            		<td width="120px">Name</td>
            		<td> : {{ $menuInfo->menu_name }}</td>
            	</tr>
            	<tr>
            		<td width="120px">Link</td>
            		<td> : {{ $menuInfo->menu_link }}</td>
            	</tr>
            	<tr>
            		<td width="120px">Icon</td>
            		<td> : {{ $menuInfo->menu_icon }}</td>
            	</tr>
            	<tr>
            		<td width="120px">Order BY</td>
            		<td> : {{ $menuInfo->order_by }}</td>
            	</tr>

            	<tr>
            		<td width="120px">Status</td>
            		<td> : {{ $menuInfo->status == 1 ? 'Active' : 'Deactive' }}</td>
            	</tr>
            </tbody>
        </table>
    </div>
@endsection