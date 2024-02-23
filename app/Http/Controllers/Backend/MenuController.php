<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MenuInterface;
use App\Interfaces\MenuActionInterface;

use App\Models\Menu;
use App\Models\MenuAction;
use DB;
use Auth;

class MenuController extends Controller
{
    protected $menuRepo;
    protected $menuActionRepo;

    function __construct(
        MenuInterface $menuRepo,
        MenuActionInterface $menuActionRepo
    ) {
        $this->menu = $menuRepo;
        $this->menuAction = $menuActionRepo;
    }

    public function index() {
        $title = "Menus";
        $statusLink = "menu.status";
        $deleteLink = "menu.delete";
        $menuList = $this->menu->getAllMenusList();

        return view('backend.menu.index')->with(compact('title','statusLink','deleteLink','menuList'));
    }

    public function add() {
        $title = "Add New Menu";
        $formLink = "menu.save";
        $buttonName = "Save";

        $menuList = $this->menu->getMenuList();
        $menuOrderBy = $this->menu->getMenuMaxOrderBy();

        if ($menuOrderBy) {
            $orderBy = $menuOrderBy + 1;
        } else {
            $orderBy = 1;
        }       

        return view('backend.menu.add')->with(compact('title','formLink','buttonName','menuList','orderBy'));
    }

    public function save(Request $request) {
        // dd($request->all());        
        $checkMenuLink = $this->menu->isMenuLinkExists($request->menuLink);

        if ($checkMenuLink && $request->menuLink != "") {
            return redirect(route('menu.add'))->with('error','This Menu Already Exists With This "'.$request->menuLink.'" Menu Link');
        } else {
            $data_array = array(
                'parent_menu' => $request->parentMenuId,
                'menu_name' => $request->menuName,
                'menu_link' => $request->menuLink,
                'menu_icon' => $request->menuIcon,
                'order_by' => $request->orderBy,
                'created_at' => date('Y-m-d'),
            );
            $result = $this->menu->saveMenu($data_array);

            $msg = 'Something Wrong! Save Unsuccessful';
            if ($result) {
                $msg = 'Menu Saved Successfully';
            }
            return redirect(route('menu.index'))->with('msg',$msg);
        }        
    }

    public function edit($menuId) {
        $title = "Add New Menu";
        $formLink = "menu.update";
        $buttonName = "Update";

        $menuList = $this->menu->getMenuList();
        $menuInfo = $this->menu->getMenuById($menuId);      

        return view('backend.menu.edit')->with(compact('title','formLink','buttonName','menuList','menuInfo'));
    }

    public function update(Request $request) {
        // dd($request->all());
        $menuId = $request->menuId;
        $menuLink = $request->menuLink;
        $checkMenuLink = $this->menu->isMenuLinkExists($menuLink,$menuId);

        if ($checkMenuLink && $request->menuLink != "") {
            return redirect(route('menu.edit',$menuId))->with('error','This Menu Already Exists With This '.$menuLink.'Menu Link');
        } else {
            $data_array = array(
                'parent_menu' => $request->parentMenuId,
                'menu_name' => $request->menuName,
                'menu_link' => $request->menuLink,
                'menu_icon' => $request->menuIcon,
                'order_by' => $request->orderBy,
                'updated_at' => date('Y-m-d'),
            );
            $result = $this->menu->updateMenu($menuId,$data_array);

            $msg = 'Something Wrong! Update Unsuccessful';
            if ($result) {
                $msg = 'Menu Updated Successfully';
            }
        }

        return redirect(route('menu.index'))->with('msg',$msg);        
    }

    public function view($menuId) {
        $title = "Menu Information";

        $menuInfo = $this->menu->getMenuInfoForView($menuId);
        $menuActionList = $this->menuAction->getMenuActionListForView($menuId);
        // dd($menuInfo);

        return view('backend.menu.view')->with(compact('title','menuInfo','menuActionList'));
    }

    public function delete(Request $request) {
        $isDelete = false;
        $message = "";
        $parentMenuList = $this->menu->getMenuListsByParentMenuId($request->id);
        $menuActionList = $this->menuAction->getMenuActionListsByParentMenuId($request->id);

        if (count($parentMenuList) == 0 && count($menuActionList) == 0) {
            $this->menu->deleteMenuById($request->id);
            $this->menuAction->deleteMenuActionByParentMenuId($request->id);
            $isDelete = true;
        } else {
            $message = "This is the parent menu, please delete all the child menus at first!.";
            if (count($menuActionList) > 0) {
                $message = "Might be this menu has some actions, please delete all the actions at first!";
            }
        }
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }

    public function status(Request $request) {
        $result = $this->menu->getMenuById($request->id);

        if ($result->status == 1) {
            $result->status = 0;
        } else {
            $result->status = 1;
        }
        $result->update();
        
        if ($request->ajax()) {
            return response()->json(['result'=>$result]);
        }
    }

    public function getMaxOrderBy(Request $request) {
        if ($request->parentMenuId) {
            $menuOrderBy = $this->menu->getMaxOrderByForParentMenu($request->parentMenuId);
        } else {
            $menuOrderBy = $this->menu->getMaxOrderBy();
        }

        if (@$menuOrderBy) {
            $orderBy = $menuOrderBy+1;
        } else {
            $orderBy = 1;
        }
        
        if($request->ajax()) {
            return response()->json(['orderBy'=>$orderBy]);
        }
    }
}
