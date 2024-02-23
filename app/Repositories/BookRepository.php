<?php

namespace App\Repositories;

use App\Interfaces\BookInterface;

use App\Models\Book;
use DB;

class BookRepository implements BookInterface
{
	public function getAllBookLists() {
		$results = Book::orderBy('id','asc')->get();
		return $results;
	}

	public function getBookById($id) {
		$result = Book::find($id);
		return $result;
	}

    public function saveBook(array $dataArray) {
        $result = Book::create($dataArray);
        return $result;
    }

	public function updateBook($id,array $dataArray) {
		// dd($dataArray);
		$result = Book::whereId($id)->update($dataArray);
		return $result;
	}

    public function deleteBook($id) {
    	$result = Book::where('id',$id)->delete();
    	return $result;
    }
}