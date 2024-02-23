<?php

namespace App\Interfaces;

interface UserInterface {
	public function getAllUserLists();
	public function getUserById($id);
	public function getUserByUserRoleId($userRoleId);
	public function isUserExists($userName = "",$email = "",$id = 0);
	public function saveUser(array $dataArray);
	public function updateUser($id,array $dataArray);
	public function deleteUser($id);
}