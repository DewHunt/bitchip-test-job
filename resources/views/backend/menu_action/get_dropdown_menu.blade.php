
<select class="form-control select2" id="menuId" name="menuId">
	<option value="">Select Menu</option>
	@foreach ($menuList as $menu)
		<option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
	@endforeach
</select>