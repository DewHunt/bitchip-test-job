<?php

namespace App\Interfaces;

interface UserRoleInterface {
	public function getAllUserRoleLists();
	public function getUserRoleById($id);
	public function saveUserRole(array $dataArray);
	public function updateUserRole($id,array $dataArray);
	public function deleteUserRole($id);
}