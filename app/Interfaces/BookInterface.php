<?php

namespace App\Interfaces;

interface BookInterface {
	public function getAllBookLists();
	public function getBookById($id);
	public function saveBook(array $dataArray);
	public function updateBook($id,array $dataArray);
	public function deleteBook($id);
}