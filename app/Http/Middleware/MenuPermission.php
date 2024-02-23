<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Menu;
use App\Models\MenuAction;
use Auth;

class MenuPermission
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = \Request::route()->getName();
        $userMenu = Menu::where('menu_link',$routeName)->first();
        $userMenuAction = MenuAction::where('action_link',$routeName)->first();

        $userRoleId =  Auth::user()->user_role_id;

        if ($userRoleId != 2) {
            if (empty(Auth::user()->permission) && empty(Auth::user()->action_permission)) {
                $userRoles = UserRole::where('id',$userRoleId)->first();
            } else {
                $userRoles = Auth::user();
            }
            $rolePermission = explode(',', $userRoles->permission);
            $actionLinkPermission = explode(',', $userRoles->action_permission);
        }
        // dd($rolePermission);

        if (!empty($userMenu)) {
            if ($userRoleId == 2) {
                return $next($request);
            } elseif (in_array($userMenu->id, @$rolePermission)) {
                return $next($request); 
            } else {
                return redirect(route('admin.index'));
            }            
        } elseif (!empty($userMenuAction)) {
            if ($userRoleId == 2) {
                return $next($request);
            } elseif (in_array($userMenuAction->id, @$actionLinkPermission)) {
                return $next($request);
            } else {
                return redirect(route('admin.index'));
            }            
        } else {
            return $next($request);
        }
    }
}
