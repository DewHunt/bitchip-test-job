<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;

use App\Models\User;
use DB;

class UserRepository implements UserInterface
{
	public function getAllUserLists() {
		$results = User::select('users.*','user_roles.name as userRoleName')
    		->leftJoin('user_roles','user_roles.id','=','users.user_role_id')
    		->orderBy('users.name','asc')
    		->get();
		return $results;
	}

	public function getUserById($id) {
		$result = User::find($id);
		return $result;
	}

	public function getUserByUserRoleId($userRoleId) {
		$result = User::where('user_role_id',$userRoleId)->get();
		return $result;
	}

	public function isUserExists($userName = "",$email = "",$id = 0) {
		$result = User::where(function($query) use($userName,$email) {
				if ($userName) {
                	$query->where('user_name',$userName);
				}
				if ($email) {
                	$query->orWhere('email',$email);				
				}
			})
			->where(function($query) use($id) {
				if ($id) {
					$query->where('id','<>',$id);
				}
			})
			->first();
		return $result;
	}

    public function saveUser(array $dataArray) {
        $result = User::create($dataArray);
        return $result;
    }

	public function updateUser($id,array $dataArray) {
		$result = User::whereId($id)->update($dataArray);
		return $result;
	}

    public function deleteUser($id) {
    	$result = User::where('id',$id)->delete();
    	return $result;
    }
}