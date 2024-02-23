<?php

namespace App\Repositories;

use App\Interfaces\MenuInterface;

use App\Models\Menu;
use DB;

class MenuRepository implements MenuInterface
{
	public function getAllMenusList() {
        $nullResults = Menu::select('menus.*','parent_menu as parentName')
            ->whereNull('parent_menu');

        $results = DB::table('menus as tab1')
            ->select('tab1.*','tab2.menu_name as parentName')
            ->join('menus as tab2','tab2.id','=','tab1.parent_menu')
            ->union($nullResults)
            ->orderBy('parentName','asc')
            ->orderBy('order_by','asc')
            ->get();
        return $results;
	}

	public function getAllMenuListsByStatus($status) {
		$results = Menu::where('status',$status)->orderBy('order_by','ASC')->get();
		return $results;
	}

	public function getMenuListsByParentMenuId($parentMenuId) {
		$results = Menu::where('parent_menu',$parentMenuId)->get();
		return $results;
	}

	public function getMenuListsByNotNullMenuId($parentMenuId) {
		$results = Menu::where('parent_menu',$parentMenuId)->whereNotNull('parent_menu')->orderBy('menu_name','asc')->get();
		return $results;
	}

	public function getMenuList() {
		$results = Menu::orderBy('menu_name','asc')->get();
		return $results;
	}

	public function getMenuById($id) {
		$result = Menu::find($id);
		return $result;
	}

	public function getMenuInfoForView($id) {
        $result = DB::table('menus as tab1')
            ->select('tab1.*','tab2.menu_name as parentName')
            // ->join('menus as tab2','tab2.id','=','tab1.parent_menu')
            ->join('menus as tab2',function($join) {
            	$join->on('tab2.id','=','tab1.parent_menu');
            	$join->orWhereNull('tab2.parent_menu');
            })
            ->where('tab1.id','=',$id)
            ->first();
        return $result;
	}

	public function getMenuListByParentMenuId($parentMenuId) {
		$results = Menu::where('parent_menu',$parentMenuId)->whereNotNull('menu_link')->orderBy('menu_name','asc')->get();
		return $results;
	}

	public function getMenuMaxOrderBy() {
		$result = Menu::whereNull('parent_menu')->max('order_by');
		return $result;
	}

	public function isMenuLinkExists($menuLink = "",$id = 0) {
		$result = Menu::where('menu_link',$menuLink)
			->where(function($query) use($id) {
				if ($id) {
					$query->where('id','<>',$id);
				}
			})
			->first();
		return $result;
	}

    public function saveMenu(array $dataArray) {
        $result = Menu::create($dataArray);
        return $result;
    }

	public function updateMenu($id,array $dataArray) {
		// dd($dataArray);
		$result = Menu::whereId($id)->update($dataArray);
		return $result;
	}

	public function getAllParentMenuList() {
		$results = Menu::whereNull('parent_menu')->orWhereNull('menu_link')->orderBy('menu_name','asc')->get();
		return $results;
	}

    public function getMaxOrderBy() {
    	$result = Menu::whereNull('parent_menu')->max('order_by');
    	return $result;
    }

    public function getMaxOrderByForParentMenu($parentMenuId) {
    	$result = Menu::where('parent_menu',$parentMenuId)->max('order_by');
    	return $result;
    }

    public function deleteMenuById($id) {
    	$result = Menu::where('id',$id)->delete();
    	return $result;
    }
}