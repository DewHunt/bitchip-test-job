@php
	$routeName = \Request::route()->getName();
    $roleId =  Auth::user()->user_role_id;
    $routeName = \Request::route()->getName();

    if ($roleId == 2) {
    	$permission = "";
    } else {
    	if (Auth::user()->permission) {
    		$menuPermission = Auth::user()->permission;
    	} else {
    		$userRole = getUserRoleInfoById($roleId);
    		$menuPermission = $userRole->permission;
    	}
    	$permission = explode(',',$menuPermission);
    }

    $rootMenus = getRootMenus($permission);
@endphp

<nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
	<div class="navbar-wrapper ">
		<div class="navbar-brand header-logo">
			<a href="{{ route('admin.index') }}" class="b-brand">
				{{-- <div class="b-bg"><i class="fas fa-bolt"></i></div> --}}
				{{-- <span class="b-title">Dasho</span> --}}
				<img src="{{ asset(@$adminSettingsInfo->logo) }}" alt="" class="logo images">
				<img src="{{ asset(@$adminSettingsInfo->thumb_logo) }}" alt="" class="logo-thumb images">
			</a>
			<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
		</div>
		<div class="navbar-content scroll-div">					
			<ul class="nav pcoded-inner-navbar ">
				@foreach ($rootMenus as $rootMenu)
					@php
						$parentMenus = getMenusByPermissionAndParentMenuId($permission,$rootMenu->id);
					@endphp

					@if (count($parentMenus) > 0)
						<li class="nav-item pcoded-hasmenu">
							<a href="javascript:void(0)" class="nav-link">
								@php
									$menuIcon = "feather icon-home";
									if (@$rootMenu->menu_icon) {
										$menuIcon = $rootMenu->menu_icon;
									}
								@endphp
								<span class="pcoded-micon"><i class="{{ $menuIcon }}"></i></span>
								<span class="pcoded-mtext">{{ $rootMenu->menu_name }}</span>
							</a>
							<ul class="pcoded-submenu">
								@foreach ($parentMenus as $parentMenu)
									@php
										$childMenus = getMenusByPermissionAndParentMenuId($permission,$parentMenu->id);
									@endphp

									@if (count($childMenus) > 0)
										<li class="pcoded-hasmenu">
											<a href="javascript:void(0)" class="">{{ $parentMenu->menu_name }}</a>
											<ul class="pcoded-submenu">
												@foreach ($childMenus as $childMenu)
													<li class=""><a href="{{ route($childMenu->menu_link) }}" class="">{{ $childMenu->menu_name }}</a></li>					
												@endforeach
											</ul>
										</li>
									@else
										<li class="">
											@if ($parentMenu->menu_link)
												<a href="{{ route($parentMenu->menu_link) }}" class="">{{ $parentMenu->menu_name }}</a>
											@else
												<a href="javascript:void(0)" class="">{{ $parentMenu->menu_name }}</a>
											@endif
										</li>
									@endif
								@endforeach
							</ul>
						</li>
					@else
						<li class="nav-item">
							<a href="{{ $rootMenu->menu_link ? route($rootMenu->menu_link) : 'javascript:void(0)' }}" class="nav-link">
								@php
									$menuIcon = "feather icon-home";
									if (@$rootMenu->menu_icon) {
										$menuIcon = $rootMenu->menu_icon;
									}
								@endphp
								<span class="pcoded-micon"><i class="{{ $menuIcon }}"></i></span>
								<span class="pcoded-mtext">{{ $rootMenu->menu_name }}</span>
							</a>
						</li>
					@endif
				@endforeach
			</ul>				
		</div>
	</div>
</nav>