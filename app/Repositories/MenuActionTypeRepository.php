<?php

namespace App\Repositories;

use App\Interfaces\MenuActionTypeInterface;

use App\Models\MenuActionType;

class MenuActionTypeRepository implements MenuActionTypeInterface
{
	public function getAllMenuActionType() {
		$results = MenuActionType::orderBy('action_id','asc')->get();
		return $results;
	}

	public function getMenuActionTypeById($id) {
		$result = MenuActionType::find($id);
		return $result;
	}

	public function getMaxMenuActionTypeId() {
		$result = MenuActionType::max('action_id');
		return $result;
	}

	public function isMenuActionTypeExists($menuActionTypeName = "",$id = 0) {
		$result = MenuActionType::where('name',$menuActionTypeName)
			->where(function($query) use($id) {
				if ($id) {
					$query->where('id','<>',$id);
				}
			})
			->first();
		return $result;
	}

    public function saveMenuActionType(array $dataArray) {
        $result = MenuActionType::create($dataArray);
        return $result;
    }

	public function updateMenuActionType($id,array $dataArray) {
		$result = MenuActionType::whereId($id)->update($dataArray);
		return $result;
	}

	public function deleteMenuActionType($id) {
		$result = MenuActionType::destroy($id);
		return $result;
	}
}