<?php

namespace App\Interfaces;

interface MenuActionInterface {
	public function getAllMenuActionLists();
	public function getMenuActionListsByParentMenuId($parentMenuId);
	public function getMenuActionInfoById($id);
	public function getMenuActionListForView($menuId);
	public function getMenuActionListsByParentMenuIdOrMenuId($parentMenuId,$menuId);	
	public function isMenuActionLinkExists($actionLink,$id);
	public function getMenuActionMaxOrderBy($menuId);
	public function saveMenuAction(array $dataArray);
	public function updateMenuAction($id,array $dataArray);
	public function deleteMenuActionByParentMenuId($parentMenuId);
	public function deleteMenuActionById($id);
}