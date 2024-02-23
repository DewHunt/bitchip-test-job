<?php

namespace App\Repositories;

use App\Interfaces\UserRoleInterface;

use App\Models\UserRole;
use DB;

class UserRoleRepository implements UserRoleInterface
{
	public function getAllUserRoleLists() {
		$results = UserRole::orderBy('order_by','asc')->get();
		return $results;
	}

	public function getUserRoleById($id) {
		$result = UserRole::find($id);
		return $result;
	}

    public function saveUserRole(array $dataArray) {
        $result = UserRole::create($dataArray);
        return $result;
    }

	public function updateUserRole($id,array $dataArray) {
		// dd($dataArray);
		$result = UserRole::whereId($id)->update($dataArray);
		return $result;
	}

    public function deleteUserRole($id) {
    	$result = UserRole::where('id',$id)->delete();
    	return $result;
    }
}