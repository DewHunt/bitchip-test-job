<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\Models\Users;
use App\Models\UserRole;
use App\Models\Menu;
use App\Models\MenuAction;
use Auth;

class Link
{
    public static function action($id = null) {
    	$menu_link = '';
        $routeName = \Request::route()->getName();
        $menus = Menu::where('menu_link',$routeName)->first();
        if ($menus) {
            $menuAction = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menus->id)->where('status',1)->get();
        } else {
            $menuActionByRouteName = MenuAction::where('action_link',$routeName)->first();
            $menuAction = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menuActionByRouteName->parent_menu_id)->where('status',1)->get();
        }
        $userRoleId =  Auth::user()->user_role_id;

        if ($userRoleId != 2) {
            if (empty(Auth::user()->action_permission)) {
                $userRoles = UserRole::where('id',$userRoleId)->first();
            } else {
                $userRoles = Auth::user();
            }
            $rolePermission = explode(',', $userRoles->action_permission);
        }

        // dd($userRoles);

        if (!empty(@$menuAction)) {
            foreach ($menuAction as $action) {
                $menuTypeId = "";
                if ($userRoleId == 2) {
                    $menuTypeId = $action->menu_type_id;
                } else {
                    if (in_array($action->id, @$rolePermission)) {
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

    public static function status($id = null,$status = null) {
        $menu_link = "";
        $routeName = \Request::route()->getName();
        $menus = Menu::where('menu_link',$routeName)->first();
        if ($menus) {
            $menuAction = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menus->id)->where('status',1)->get();
        } else {
            $menuActionByRouteName = MenuAction::where('action_link',$routeName)->first();
            $menuAction = MenuAction::orderBy('order_by','ASC')->where('parent_menu_id',@$menuActionByRouteName->parent_menu_id)->where('status',1)->get();
        }
        $userRoleId =  Auth::user()->user_role_id;

        if ($userRoleId != 2) {
            if (empty(Auth::user()->action_permission)) {
                $userRoles = UserRole::where('id',$userRoleId)->first();
            }
            else {
                $userRoles = Auth::user();
            }
            $rolePermission = explode(',', $userRoles->action_permission);
        }

        if (!empty(@$menuAction)) {
            foreach ($menuAction as $action) {
                $menuTypeId = "";
                if ($userRoleId == 2) {
                    $menuTypeId = $action->menu_type_id;
                } else {
                    if (in_array($action->id, @$rolePermission)) {
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
