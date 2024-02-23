<?php
	use App\Models\Users;
	use App\Models\UserRole;
	use App\Models\Menu;
	use App\Models\MenuAction;

	if (!function_exists('getMenuActions')) {
		function getMenuActions() {
	        $routeName = \Request::route()->getName();
	        $menus = Menu::where('menu_link',$routeName)->first();
	        if ($menus) {
	            $menuActions = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menus->id)->where('status',1)->get();
	        } else {
	            $menuActionByRouteName = MenuAction::where('action_link',$routeName)->first();
	            $menuActions = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menuActionByRouteName->parent_menu_id)->where('status',1)->get();
	        }

	        return $menuActions;
		}
	}

	if (!function_exists('getRolePermissions')) {
		function getRolePermissions($userRoleId) {
			$rolePermission = "";

	        if ($userRoleId != 2) {
	            if (empty(Auth::user()->action_permission)) {
	                $userRoles = UserRole::where('id',$userRoleId)->first();
	            } else {
	                $userRoles = Auth::user();
	            }
	            $rolePermission = explode(',', $userRoles->action_permission);
	        }

	        return $rolePermission;
		}
	}

	if (!function_exists('actions')) {
	    function actions($id = null) {
	    	$menu_link = '';
	        $userRoleId =  Auth::user()->user_role_id;
	        // dd($userRoles);

	        if (getMenuActions()) {
	            foreach (getMenuActions() as $action) {
	                $menuTypeId = "";
	                if ($userRoleId == 2) {
	                    $menuTypeId = $action->menu_type_id;
	                } else {
	                    if (in_array($action->id, getRolePermissions($userRoleId))) {
	                        $menuTypeId = $action->menu_type_id;
	                    }
	                }

	                if ($menuTypeId != "") {
	                    // Edit Option
	                    if ($menuTypeId == 2) {
	                        $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fas fa-edit text-inverse m-r-10"></i> </a>';
	                    }

	                    // Delete Option
	                    if ($menuTypeId == 4) {
	                    $menu_link .= '<a id="cancel_'.$id.'" href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'" data-token="{{ csrf_token() }}"> <i class="fa fa-trash text-danger"></i> </a>';
	                    }

	                    if ($menuTypeId == 5) {
	                    $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" onclick="if (confirm(&quot;Are you sure you want to Permission ?&quot;)) { return true; } return false;"> <i class="fa fa-lock text-inverse m-r-10"></i> </a>';
	                    }

	                    if ($menuTypeId == 6) {
	                    $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-key text-inverse m-r-10"></i> </a>';
	                    }

	                    if ($menuTypeId == 7) {
	                    $menu_link .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
	                    }

	                    if ($menuTypeId == 8) {
	                    $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
	                    }

	                    if ($menuTypeId == 9) {
	                    $menu_link .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-shopping-bag text-danger m-r-10"></i> 
	                        </a>';
	                    }

	                    if ($menuTypeId == 10) {
	                    $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-list text-success m-r-10"></i> </a>';
	                    }
	                    
	                    if ($menuTypeId == 11) {
	                    $menu_link .= '<a href="'.route($action->action_link,$id).'" data-toggle="tooltip" target="_blank" data-original-title="'.$action->action_name.'"> <i class="fa fa-print text-success m-r-10"></i> </a>';
	                    }
	                }
	            }
	        }
	        
	        return $menu_link;
	    }
	}

	if (!function_exists('status')) {
	    function status($id = null,$status = null) {
	        $menu_link = "";
	        $userRoleId =  Auth::user()->user_role_id;

	        if (getMenuActions()) {
	            foreach (getMenuActions() as $action) {
	                $menuTypeId = "";
	                if ($userRoleId == 2) {
	                    $menuTypeId = $action->menu_type_id;
	                } else {
	                    if (in_array($action->id, getRolePermissions($userRoleId))) {
	                        $menuTypeId = $action->menu_type_id;
	                    }
	                }

	                if($menuTypeId != "" && $menuTypeId == 3) {
	                    if($status == 1) {
	                        $checked = 'checked';
	                    } else {
	                        $checked = ''; 
	                    }
	                    $menu_link .= '
	                        <span class="switchery-demo m-b-30" onclick="statusChange('.$id.')">
	                            <input type="checkbox"'.$checked.' class="js-switch" data-color="#00c292" data-switchery="true" style="display: none;" >
	                        </span>
	                    ';
	                }
	            }
	        }
	        
	        return $menu_link;
	    }
	}

	if (!function_exists('addAction')) {
	    function addAction() {
	        $menu_link = "";
	        $userRoleId =  Auth::user()->user_role_id;

	        if (getMenuActions()) {
	            foreach (getMenuActions() as $action) {
	                $menuTypeId = "";
	                if ($userRoleId == 2) {
	                    $menuTypeId = $action->menu_type_id;
	                } else {
	                    if (in_array($action->id, getRolePermissions($userRoleId))) {
	                        $menuTypeId = $action->menu_type_id;
	                    }
	                }

	                if($menuTypeId != "" && $menuTypeId == 1) {
	                	return true;
	                }
	            }
	        }
	        
	        return false;
	    }
	}

	if (!function_exists('othersAction')) {
	    function othersAction($id = null) {
	        $menu_link = "";
	        $userRoleId =  Auth::user()->user_role_id;

	        if (getMenuActions()) {
	            foreach (getMenuActions() as $action) {
	                $menuTypeId = "";
	                if ($userRoleId == 2) {
	                    $menuTypeId = $action->menu_type_id;
	                } else {
	                    if (in_array($action->id, getRolePermissions($userRoleId))) {
	                        $menuTypeId = $action->menu_type_id;
	                    }
	                }

	                if($menuTypeId != "" && $menuTypeId == 14) {
	                	if ($id == null) {
		                    $menu_link .= '
		                    	<a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="'. route($action->action_link) .'"> '. $action->action_name .'</a>
		                    ';
	                	} else {
		                    $menu_link .= '
		                    	<a style="font-size: 16px;" class="btn btn-outline-info btn-sm" href="'.  route($action->action_link,$id) .'"> '. $action->action_name .'</a>
		                    ';
	                	}
	                	
	                }
	            }
	        }
	        return $menu_link;
	    }
	}
?>