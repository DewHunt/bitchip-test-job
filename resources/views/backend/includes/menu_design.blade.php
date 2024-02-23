		<nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
			<div class="navbar-wrapper ">
				<div class="navbar-brand header-logo">
					<a href="index.html" class="b-brand">
						{{-- <div class="b-bg"><i class="fas fa-bolt"></i></div> --}}
						{{-- <span class="b-title">Dasho</span> --}}
						<img src="{{ asset('public/admin/assets/images/logo.svg') }}" alt="" class="logo images">
						<img src="{{ asset('public/admin/assets/images/logo-icon.svg') }}" alt="" class="logo-thumb images">
					</a>
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
				</div>
				<div class="navbar-content scroll-div">					
					<ul class="nav pcoded-inner-navbar ">
						<li data-username="dashboard" class="nav-item">
							<a href="{{ route('admin.index') }}" class="nav-link">
								<span class="pcoded-micon"><i class="feather icon-home"></i></span>
								<span class="pcoded-mtext">Dashboard</span>
							</a>
						</li>

						<li data-username="user-management" class="nav-item pcoded-hasmenu">
							<a href="#" class="nav-link">
								<span class="pcoded-micon"><i class="feather icon-menu"></i></span>
								<span class="pcoded-mtext">User Management</span>
							</a>
							<ul class="pcoded-submenu">
								<li class=""><a href="{{ route('user_role.index') }}" class="">User Role</a></li>
								<li class=""><a href="#" class="">User</a></li>
								<li class=""><a href="{{ route('menu_action_type.index') }}" class="">Menu Action Type</a></li>
								<li class=""><a href="{{ route('menu.index') }}" class="">Menu</a></li>
								<li class=""><a href="{{ route('menu_action.index') }}" class="">Menu Action</a></li>
								<li class=""><a href="#" class="">Admin Information</a></li>
							</ul>
						</li>

						<li data-username="menu levels menu level 2.1 menu level 2.2" class="nav-item pcoded-hasmenu">
							<a href="#" class="nav-link">
								<span class="pcoded-micon"><i class="feather icon-menu"></i></span>
								<span class="pcoded-mtext">Menu levels</span>
							</a>
							<ul class="pcoded-submenu">
								<li class=""><a href="#" class="">Menu Level 2.1</a></li>
								<li class="pcoded-hasmenu">
									<a href="#" class="">Menu level 2.2</a>
									<ul class="pcoded-submenu">
										<li class=""><a href="#" class="">Menu level 3.1</a></li>
										<li class=""><a href="#" class="">Menu level 3.2</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>				
				</div>
			</div>
		</nav>