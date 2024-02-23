@extends('backend.layouts.master_add_edit')

@section('page_content')
	<input class="form-control" type="hidden" name="menuActionId" value="{{ $menuInfo->id }}">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<label for="parent-menu">Parent Menu</label>
			<div class="form-group">
				<select class="form-control select2" id="parentMenuId" name="parentMenuId">
					<option value="">Select Parent Menu</option>
					@foreach ($parentMenuList as $parentMenu)
						@php
							if ($parentMenu->id == $menuInfo->parent_menu_id) {
								$select = "selected";
							} else {
								$select = "";
							}							
						@endphp
						<option value="{{ $parentMenu->id }}" {{ $select }}>{{ $parentMenu->menu_name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-4 col-md-4">
			<label for="menu">Menu</label>
			<div class="form-group">
				<div id="menu_list">
					<select class="form-control select2" id="menuId" name="menuId">
						<option value="">Select Menu</option>
						@foreach ($menuList as $menu)
							@php
								if ($menu->id == $menuInfo->parent_menu_id) {
									$select = "selected";
								} else {
									$select = "";
								}								
							@endphp
							<option value="{{ $menu->id }}" {{ $select }}>{{ $menu->menu_name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4">
			<label for="menu-action-type">Menu Action Type</label>
			<div class="form-group">
				<select class="form-control select2" id="menuActionTypeId" name="menuActionTypeId">
					<option value="">Select Menu Action Type</option>
					@foreach ($menuActionTypeList as $menuActionType)
						@php
							if ($menuActionType->id == $menuInfo->menu_type_id) {
								$select = "selected";
							} else {
								$select = "";
							}
							
						@endphp
						<option value="{{ $menuActionType->id }}" {{ $select }}>{{ $menuActionType->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-5 col-md-5">
			<label for="action-name">Action Name</label>
			<div class="form-group">
				<input type="text" class="form-control" id="actionName" name="actionName" placeholder="Action Name" value="{{ $menuInfo->action_name }}" required>
			</div>
		</div>

		<div class="col-lg-5 col-md-5">
			<label for="action-link">Action Link</label>
			<div class="form-group">
				<input type="text" class="form-control" id="actionLink" name="actionLink" placeholder="action_name.add" value="{{ $menuInfo->action_link }}">
			</div>
		</div>

		<div class="col-lg-2 col-md-2">
			<label for="oreder-by">Order By</label>
			<div class="form-group">
				<input type="number" class="form-control" id="orderBy" name="orderBy" min="1" placeholder="Order By" value="{{ $menuInfo->order_by }}" required>
			</div>
		</div>
	</div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).on('change','#parentMenuId',function(){
            var parentMenuId = $('#parentMenuId').val();

            $.ajax({
                type: "POST",
                url: "{{ route('menu_action.getMenuListByParentMenuId') }}",
                data:{_token:'{{ csrf_token() }}',parentMenuId:parentMenuId},
                success: function(data) {
                    $('#menu_list').html(data.output);
                	$(".select2").select2();
                },
            });
        });

        $(document).on('change','#menuId, #parentMenuId',function(){
            var menuId = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('menu_action.getMaxOrderBy') }}",
                data:{_token:'{{ csrf_token() }}',menuId:menuId},
                success: function(data) {
                    $('#orderBy').val(data.orderBy);
                },
            });
        });
    </script>
@endsection