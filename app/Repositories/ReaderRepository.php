<?php

namespace App\Repositories;

use App\Interfaces\ReaderInterface;

use App\Models\Reader;
use DB;

class ReaderRepository implements ReaderInterface
{
	public function getAllReaderLists() {
		$results = Reader::orderBy('id','asc')->get();
		return $results;
	}

	public function getReaderById($id) {
		$result = Reader::find($id);
		return $result;
	}

    public function saveReader(array $dataArray) {
        $result = Reader::create($dataArray);
        return $result;
    }

	public function updateReader($id,array $dataArray) {
		// dd($dataArray);
		$result = Reader::whereId($id)->update($dataArray);
		return $result;
	}

    public function deleteReader($id) {
    	$result = Reader::where('id',$id)->delete();
    	return $result;
    }
}