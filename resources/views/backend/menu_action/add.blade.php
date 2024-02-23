@extends('backend.layouts.master_add_edit')

@section('page_content')
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<label for="parent-menu">Parent Menu</label>
			<div class="form-group">
				<select class="form-control select2" id="parentMenuId" name="parentMenuId">
					<option value="">Select Parent Menu</option>
					@foreach ($parentMenuList as $parentMenu)
						<option value="{{ $parentMenu->id }}">{{ $parentMenu->menu_name }}</option>
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
						<option value="{{ $menuActionType->id }}">{{ $menuActionType->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-5 col-md-5">
			<label for="action-name">Action Name</label>
			<div class="form-group">
				<input type="text" class="form-control" id="actionName" name="actionName" placeholder="Action Name" value="" required>
			</div>
		</div>

		<div class="col-lg-5 col-md-5">
			<label for="action-link">Action Link</label>
			<div class="form-group">
				<input type="text" class="form-control" id="actionLink" name="actionLink" placeholder="action_name.add" value="">
			</div>
		</div>

		<div class="col-lg-2 col-md-2">
			<label for="oreder-by">Order By</label>
			<div class="form-group">
				<input type="number" class="form-control" id="orderBy" name="orderBy" min="1" placeholder="Order By" value="" required>
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