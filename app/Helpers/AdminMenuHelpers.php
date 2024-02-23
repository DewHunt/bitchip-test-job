<?php
	if (!function_exists('getTotalMenuAction')) {
	    function getTotalMenuAction($parentMenuId) {
	        $totalMenuAction = DB::table('menu_actions')->where('status',1)->where('parent_menu_id',$parentMenuId)->count();
	        return $totalMenuAction;
	    }
	}

	if (!function_exists('getMenuActionsById')) {
	    function getMenuActionsById($id) {
	        $menuActions = DB::table('menu_actions')->where('status',1)->where('parent_menu_id',$id)->orderBy('order_by','ASC')->get();
	        return $menuActions;
	    }
	}

	if (!function_exists('getMenusbyId')) {
	    function getMenusbyId($id) {
	        $menus = DB::table('menus')->where('parent_menu',$id)->get();
	        return $menus;
	    }
	}

	if (!function_exists('getMenusByMultipleId')) {
	    function getMenusByMultipleId($ids) {
	        $menus = DB::table('menus')->whereRaw('FIND_IN_SET(id,?)',[$ids])->get();
	        return $menus;
	    }
	}

	if (!function_exists('getUserRoleInfoById')) {
	    function getUserRoleInfoById($roleId) {
	        $userRole = DB::table('user_roles')->where('id',$roleId)->first();
	        return $userRole;
	    }
	}

	if (!function_exists('getRootMenus')) {
	    function getRootMenus($permission) {
	        $rootMenus = DB::table('menus')
	            ->orWhere(function($query) use($permission){
	                if ($permission)
	                {
	                    $query->whereIn('id',$permission);
	                }
	            })
	            ->whereNull('parent_menu')
	            ->where('status',1)
	            ->orderBy('order_by','asc')
	            ->get();

	        return $rootMenus;
	    }
	}

	if (!function_exists('getMenusByPermissionAndParentMenuId')) {
	    function getMenusByPermissionAndParentMenuId($permission,$parentMenuId) {
	        $parentMenus = DB::table('menus')
	            ->orWhere(function($query) use($permission){
	                if ($permission)
	                {
	                    $query->whereIn('id',$permission);
	                }
	            })
	            ->where('parent_menu',$parentMenuId)
	            ->where('status',1)
	            ->orderBy('order_by','asc')
	            ->get();

	        return $parentMenus;
	    }
	}
?>