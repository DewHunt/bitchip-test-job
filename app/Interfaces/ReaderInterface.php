<?php

namespace App\Interfaces;

interface ReaderInterface {
	public function getAllReaderLists();
	public function getReaderById($id);
	public function saveReader(array $dataArray);
	public function updateReader($id,array $dataArray);
	public function deleteReader($id);
}