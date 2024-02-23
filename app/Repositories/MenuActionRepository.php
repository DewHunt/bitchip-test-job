<?php

namespace App\Repositories;

use App\Interfaces\MenuActionInterface;

use App\Models\MenuAction;
use DB;

class MenuActionRepository implements MenuActionInterface
{
	public function getAllMenuActionLists() {
		$results = MenuAction::select('menu_actions.*','menus.menu_name as menuName','menu_action_types.name as menuTypeName')
            ->leftJoin('menus','menus.id','menu_actions.parent_menu_id')
            ->leftJoin('menu_action_types','menu_action_types.id','menu_actions.menu_type_id')
            ->orderBy('menus.menu_name','asc')
            ->orderBy('menu_actions.order_by','asc')
            ->get();

        return $results;
	}

	public function getMenuActionListsByParentMenuId($parentMenuId) {
		$results = MenuAction::where('parent_menu_id',$parentMenuId)->get();
		return $results;
	}

	public function getMenuActionInfoById($id) {
		$result = MenuAction::select('menu_actions.*','menus.parent_menu as parentMenuId')
            ->leftJoin('menus','menus.id','=','menu_actions.parent_menu_id')
            ->where('menu_actions.id',$id)
            ->first();
        return $result;
	}

	public function getMenuActionListForView($menuId) {
        $results = MenuAction::select('menu_actions.*','menu_action_types.name as menuTypeName')
            ->leftJoin('menu_action_types','menu_action_types.id','menu_actions.menu_type_id')
            ->where('menu_actions.parent_menu_id',$menuId)
            ->orderBy('menu_actions.order_by','asc')
            ->get();
        return $results;
	}

	public function getMenuActionListsByParentMenuIdOrMenuId($parentMenuId,$menuId) {
		$results = MenuAction::select('menu_actions.*','menus.menu_name as menuName','menu_action_types.name as menuTypeName')
            ->leftJoin('menus','menus.id','menu_actions.parent_menu_id')
            ->leftJoin('menu_action_types','menu_action_types.id','menu_actions.menu_type_id')
            ->where('menu_actions.parent_menu_id',$parentMenuId)
            ->orWhere('menu_actions.parent_menu_id',$menuId)
            ->orderBy('menu_actions.order_by','asc')
            ->get();
        return $results;
	}

	public function isMenuActionLinkExists($actionLink = "",$id = 0) {
		$result = MenuAction::where('action_link',$actionLink)
			->where(function($query) use($id) {
				if ($id) {
					$query->where('id','<>',$id);
				}
			})
			->first();
		return $result;
	}

	public function getMenuActionMaxOrderBy($menuId) {
		$result = MenuAction::where('parent_menu_id',$menuId)->max('order_by');
		return $result;
	}

    public function saveMenuAction(array $dataArray) {
        $result = MenuAction::create($dataArray);
        return $result;
    }

	public function updateMenuAction($id,array $dataArray) {
		// dd($dataArray);
		$result = MenuAction::whereId($id)->update($dataArray);
		return $result;
	}

    public function status($id) {
        $menuAction = MenuAction::find($id);

        if ($menuAction->status == 1) {
            $menuAction->status = 0;
        } else {
            $menuAction->status = 1;
        }

        $menuAction->update();
    }

	public function deleteMenuActionByParentMenuId($parentMenuId) {
		$result = MenuAction::where('parent_menu_id',$request->id)->delete();
		return $result;
	}

	public function deleteMenuActionById($id) {
		$result = MenuAction::where('id',$id)->delete();
		return $result;
	}
}