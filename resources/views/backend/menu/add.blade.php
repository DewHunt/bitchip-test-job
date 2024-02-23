@extends('backend.layouts.master_add_edit')

@section('page_content')
	<div class="row">
		<div class="col-lg-6">
			<label for="parent-menu">Parent Menu</label>
			<div class="form-group">
				<select class="form-control select2" id="parentMenuId" name="parentMenuId">
					<option value="">Select Parent Menu</option>
					@foreach ($menuList as $menu)
						<option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-6">
			<label for="menu-name">Menu Name</label>
			<div class="form-group">
				<input type="text" class="form-control" id="menuName" name="menuName" placeholder="Menu Name" value="" required>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3">
			<label for="menu-link">Menu Link</label>
			<div class="form-group">
				<input type="text" class="form-control" id="menuLink" name="menuLink" placeholder="Menu Link" value="">
			</div>
		</div>

		<div class="col-lg-3">
			<label for="menu-icon">Menu Icon</label>
			<div class="form-group">
				<input type="text" class="form-control" id="menuIcon" name="menuIcon" placeholder="Menu Icon" value="">
			</div>
		</div>

		<div class="col-lg-6">
			<label for="oreder-by">Order By</label>
			<div class="form-group">
				<input type="number" class="form-control" id="orderBy" name="orderBy" min="1" placeholder="Order By" value="{{ $orderBy }}" required>
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
                url: "{{ route('menu.getMaxOrderBy') }}",
                data:{_token:'{{ csrf_token() }}',parentMenuId:parentMenuId},
                success: function(response) {
                    var orderBy = response.orderBy;

                    $('#orderBy').val(orderBy);
                },
            });
        });
    </script>
@endsection