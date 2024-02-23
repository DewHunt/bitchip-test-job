<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\AdminSettingsInterface;

use Auth;
use View;
use DB;

use App\Models\Menu;
use App\Models\MenuAction;

class AppServiceProvider extends ServiceProvider
{
    public function register() {
        View::composer('*',function($menus) {
            $activeMenu = Menu::where('status',1)->get();
            $menus->with('activeMenu',$activeMenu);
        });

        //Link for Add New Button
        View::composer('*',function($addLink){
            $actionLink = 'admin.index';
            $routeName = \Request::route()->getName();

            if ($routeName) {
                $userMenus = Menu::where('menu_link',$routeName)->first();
                if ($userMenus) {
                    $userMenuAction = MenuAction::where('parent_menu_id',@$userMenus->id)->where('menu_type_id',1)->first();
                    // dd($userMenuAction);

                    if(@$userMenuAction->action_link) {
                        $actionLink = @$userMenuAction->action_link;
                    }
                }
                
            }
            $addLink->with('addNewLink',$actionLink);
        });

        //Link for Go Back
        View::composer('*',function($backLink) {
            $link = 'admin.index';
            $routeName = \Request::route()->getName();

            if ($routeName) {
                $userMenuAction = MenuAction::where('action_link',@$routeName)->first();
                if ($userMenuAction) {
                    $userMenu = Menu::where('id',@$userMenuAction->parent_menu_id)->first();
                    if ($userMenu) {
                        $link = $userMenu->menu_link;
                    }
                }
            }

            $backLink->with('goBackLink',@$link); 
        });
    }

    public function boot(AdminSettingsInterface $adminSettingsRepo,) {
        View::share('adminSettingsInfo',$adminSettingsRepo->getAdminSettings());
    }
}
