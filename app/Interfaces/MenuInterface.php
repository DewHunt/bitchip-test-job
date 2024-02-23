<?php

namespace App\Interfaces;

interface MenuInterface {
	public function getAllMenusList();
	public function getAllMenuListsByStatus($status);
	public function getMenuListsByParentMenuId($parentMenuId);
	public function getMenuListsByNotNullMenuId($parentMenuId);
	public function getMenuList();
	public function getMenuById($id);
	public function getMenuInfoForView($id);
	public function getMenuListByParentMenuId($parentMenuId);
	public function getMenuMaxOrderBy();
	public function isMenuLinkExists($menuLink,$id);
	public function saveMenu(array $dataArray);
	public function updateMenu($id,array $dataArray);
	public function getAllParentMenuList();
	public function getMaxOrderBy();
	public function getMaxOrderByForParentMenu($parentMenuId);
	public function deleteMenuById($id);
}