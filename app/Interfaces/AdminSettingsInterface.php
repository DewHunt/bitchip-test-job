<?php

namespace App\Interfaces;

interface AdminSettingsInterface {
	public function getAdminSettings();
	public function getAdminSettingsById($id);
	public function getFirstActiveAdminSettings();
	public function saveAdminSettings(array $dataArray);
	public function updateAdminSettings($id,array $dataArray);
	public function deleteAdminSettings($id);
}