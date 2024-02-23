<?php

namespace App\Repositories;

use App\Interfaces\AdminSettingsInterface;

use App\Models\AdminSettings;

class AdminSettingsRepository implements AdminSettingsInterface
{
	public function getAdminSettings() {
		$results = AdminSettings::first();
		return $results;
	}

	public function getAdminSettingsById($id) {
		$result = AdminSettings::find($id);
		return $result;
	}

	public function getFirstActiveAdminSettings() {
		$result = AdminSettings::where('status',1)->first();
		return $result;
	}

    public function saveAdminSettings(array $dataArray) {
        $result = AdminSettings::create($dataArray);
        return $result;
    }

	public function updateAdminSettings($id,array $dataArray) {
		$result = AdminSettings::whereId($id)->update($dataArray);
		return $result;
	}

	public function deleteAdminSettings($id) {
		$result = AdminSettings::destroy($id);
		return $result;
	}
}