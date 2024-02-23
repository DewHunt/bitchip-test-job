<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\BookInterface;

use Auth;

class BookController extends Controller
{
    protected $bookRepo;

    function __construct(BookInterface $bookRepo) {
        $this->book = $bookRepo;
    }

    public function index() {
        $title = "Books";
        $statusLink = "book.status";
        $deleteLink = "book.delete";

        $bookList = $this->book->getAllBookLists();

        return view('backend.book.index')->with(compact('title','statusLink','deleteLink','bookList'));
    }

    public function add() {
        $title = "Add New Book";
        $formLink = "book.save";
        $buttonName = "Save";

        return view('backend.book.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(Request $request) {
        // dd($request->all());

        if (isset($request->bookImage)) {
            $bookImage = uploadImage($request->bookImage,'public/images/books/');
        } else {
            $bookImage = "";
        }

        $dataArray = array(
            'name' => $request->name,     
            'author' => $request->authorName,
            'description' => $request->description,
            'image' => $bookImage,
            'created_at' => date('Y-m-d'),
        );
        $result = $this->book->saveBook($dataArray);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'Book Saved Successfully';
        }

        return redirect(route('book.index'))->with('msg',$msg); 
    }

    public function edit($userId) {
        $title = "Edit Book";
        $formLink = "book.update";
        $buttonName = "Update";

        $bookInfo = $this->book->getBookById($userId);

        return view('backend.book.edit')->with(compact('title','formLink','buttonName','bookInfo'));
    }

    public function update(Request $request) {
        // dd($request->all());
        $bookId = $request->bookId;

        if (isset($request->bookImage)) {
            $bookImage = uploadImage($request->bookImage,'public/images/books/');
        } else {
            $bookImage = $request->previousBookImage;
        }

        $dataArray = array(
            'name' => $request->name,     
            'author' => $request->authorName,
            'description' => $request->description,
            'image' => $bookImage,
            'updated_at' => date('Y-m-d'),
        );
        $result = $this->book->updateBook($bookId,$dataArray);

        $msg = 'Something Wrong! Update Unsuccessful';
        if ($result) {
            $msg = 'Book Updated Successfully';
        }

        return redirect(route('book.index'))->with('msg',$msg); 
    }

    public function status(Request $request) {
        $result = $this->book->getBookById($request->id);

        if ($result->status == 1) {
            $result->status = 0;
        } else {
            $result->status = 1;
        }
        $result->update();
        
        if ($request->ajax()) {
            return response()->json(['result'=>$result]);
        }
    }

    public function delete(Request $request) {
        $isDelete = true;
        $message = "";

        $this->book->deleteBook($request->id);
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }
}
