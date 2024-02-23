<?php

namespace App\Interfaces;

interface MenuActionTypeInterface {
	public function getAllMenuActionType();
	public function getMenuActionTypeById($id);
	public function getMaxMenuActionTypeId();
	public function isMenuActionTypeExists($manuActionTypeName,$id);
	public function saveMenuActionType(array $dataArray);
	public function updateMenuActionType($id,array $dataArray);
	public function deleteMenuActionType($id);
}