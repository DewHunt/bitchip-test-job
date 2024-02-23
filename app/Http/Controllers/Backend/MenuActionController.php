<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MenuActionTypeInterface;
use App\Interfaces\MenuActionInterface;
use App\Interfaces\MenuInterface;

use App\Models\Menu;
use App\Models\MenuAction;
use App\Models\MenuActionType;
use DB;

class MenuActionController extends Controller
{
    protected $menuActionTypeRepo;
    protected $menuActionRepo;
    protected $menuRepo;
    function __construct(MenuInterface $menuRepo, MenuActionInterface $menuActionRepo, MenuActionTypeInterface $menuActionTypeRepo) {
        $this->menu = $menuRepo;
        $this->menuAction = $menuActionRepo;
        $this->menuActionType = $menuActionTypeRepo;
    }

    public function index() {
    	$title = "Menu Action";
    	$statusLink = "menu_action.status";
    	$deleteLink = "menu_action.delete";

        $parentMenuList = $this->menu->getAllParentMenuList();
        $menuActionList = $this->menuAction->getAllMenuActionLists();

        return view('backend.menu_action.index')->with(compact('title','statusLink','deleteLink','menuActionList','parentMenuList'));
    }

    public function add(Request $request) {
        $title = "Add New Menu Action";
        $formLink = "menu_action.save";
        $buttonName = "Save";

        $parentMenuList = $this->menu->getAllParentMenuList();
        $menuActionTypeList = $this->menuActionType->getAllMenuActionType();

        return view('backend.menu_action.add')->with(compact('title','formLink','buttonName','parentMenuList','menuActionTypeList'));
    }

    public function save(request $request) {
        $actionLink = $request->actionLink;
        $checkMenuAcionLink = $this->menuAction->isMenuActionLinkExists($actionLink);

        if ($checkMenuAcionLink) {
            return redirect(route('menu_action.add'))->with('error',"This Menu Action Already Exists With This '".$request->actionLink."' Menu Action Link");
        } else {
            $parentMenuId = $request->parentMenuId;
            if ($request->menuId) {
                $parentMenuId = $request->menuId;
            }
            $data_array = array(
                'parent_menu_id' => $parentMenuId,
                'menu_type_id' => $request->menuActionTypeId,
                'action_name' => $request->actionName,
                'action_link' => $actionLink,
                'order_by' => $request->orderBy,
                'created_at' => date('Y-m-d'),
            );
            $result = $this->menuAction->saveMenuAction($data_array);

            $msg = 'Something Wrong! Save Unsuccessful';
            if ($result) {
                $msg = 'Menu Action Saved Successfully';
            }

            return redirect(route('menu_action.add'))->with('msg',$msg);
        }
    }

    public function edit($menuActionId) {
        $title = "Edit Menu Action";
        $formLink = "menu_action.update";
        $buttonName = "Update";

        $parentMenuList = $this->menu->getAllParentMenuList();
        $menuActionTypeList = $this->menuActionType->getAllMenuActionType();
        $menuInfo = $this->menuAction->getMenuActionInfoById($menuActionId);
        $menuList = $this->menu->getMenuListsByNotNullMenuId($menuInfo->parentMenuId);
        // dd($menuInfo);

        return view('backend.menu_action.edit')->with(compact('title','formLink','buttonName','parentMenuList','menuList','menuActionTypeList','menuInfo'));
    }

    public function update(request $request) {
        // dd($request->all());
        $menuActionId = $request->menuActionId;
        $actionLink = $request->actionLink;
        $checkMenuAcionLink = $this->menuAction->isMenuActionLinkExists($actionLink,$menuActionId);

        if ($checkMenuAcionLink) {
            return redirect(route('menu_action.edit',$menuActionId))->with('error',"This Menu Action Already Exists With This '".$actionLink."' Menu Action Link");
        } else {
            $menuActionId = $request->menuActionId;
            $parentMenuId = $request->parentMenuId;
            if ($request->menuId) {
                $parentMenuId = $request->menuId;
            }

            $data_array = array(
                'parent_menu_id' => $parentMenuId,
                'menu_type_id' => $request->menuActionTypeId,
                'action_name' => $request->actionName,
                'action_link' => $actionLink,
                'order_by' => $request->orderBy,
                'updated_at' => date('Y-m-d'),
            );
            $result = $this->menuAction->updateMenuAction($menuActionId,$data_array);

            $msg = 'Something Wrong! Update Unsuccessful';
            if ($result) {
                $msg = 'Menu Action Updated Successfully';
            }

            return redirect(route('menu_action.index'))->with('msg',$msg);
        }
    }

    public function status(Request $request) {
        $result = $this->menuAction->status($request->id);
        
        if ($request->ajax()) {
            return response()->json(['result'=>$result]);
        }
    }

    public function delete(Request $request) {
        $isDelete = true;
        $message = "";

        $this->menuAction->deleteMenuActionById($request->id);
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }

    public function getMenuListByParentMenuId(Request $request) {
        // dd($request->all());
        $parentMenuId = $request->post('parentMenuId');

        $menuList = $this->menu->getMenuListByParentMenuId($parentMenuId);
        $output = view('backend.menu_action.get_dropdown_menu')->with(compact('menuList'))->render();
        
        if($request->ajax()) {
            return response()->json(['output'=>$output]);
        }
    }

    public function getMaxOrderBy(Request $request) {
        // dd($request->all());
        $menuId = $request->post('menuId');
        $menuActionOrderBy = $this->menuAction->getMenuActionMaxOrderBy($menuId);

        if (@$menuActionOrderBy) {
            $orderBy = $menuActionOrderBy+1;
        } else {
            $orderBy = 1;
        } 
        
        if($request->ajax()) {
            return response()->json(['orderBy'=>$orderBy]);
        }       
    }

    public function getMenuActionInfo(Request $request) {
        $parentMenuId = $request->post('parentMenuId');
        $menuId = $request->post('menuId');

        $menuActionList = $this->menuAction->getMenuActionListsByParentMenuIdOrMenuId($parentMenuId,$menuId);

        $output = view('backend.menu_action.menu_action_info_table')->with(compact('menuActionList'))->render();
        
        if($request->ajax()) {
            return response()->json(['output'=>$output]);
        } 
    }
}
