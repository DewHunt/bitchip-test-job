<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\ReaderInterface;

use Auth;

class ReaderController extends Controller
{
    protected $readerRepo;

    function __construct(ReaderInterface $readerRepo) {
        $this->reader = $readerRepo;
    }

    public function index() {
        $title = "Books";
        $statusLink = "reader.status";
        $deleteLink = "reader.delete";

        $readerList = $this->reader->getAllReaderLists();

        return view('backend.reader.index')->with(compact('title','statusLink','deleteLink','readerList'));
    }

    public function add() {
        $title = "Add New Reader";
        $formLink = "reader.save";
        $buttonName = "Save";

        return view('backend.reader.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(Request $request) {
        // dd($request->all());

        $dataArray = array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => date('Y-m-d'),
        );
        $result = $this->reader->saveReader($dataArray);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'Reader Saved Successfully';
        }

        return redirect(route('reader.index'))->with('msg',$msg); 
    }

    public function edit($userId) {
        $title = "Edit Reader";
        $formLink = "reader.update";
        $buttonName = "Update";

        $readerInfo = $this->reader->getReaderById($userId);

        return view('backend.reader.edit')->with(compact('title','formLink','buttonName','readerInfo'));
    }

    public function update(Request $request) {
        // dd($request->all());
        $readerId = $request->readerId;

        $dataArray = array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,   
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => date('Y-m-d'),
        );
        $result = $this->reader->updateReader($readerId,$dataArray);

        $msg = 'Something Wrong! Update Unsuccessful';
        if ($result) {
            $msg = 'Reader Updated Successfully';
        }

        return redirect(route('reader.index'))->with('msg',$msg); 
    }

    public function status(Request $request) {
        $result = $this->reader->getReaderById($request->id);

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

        $this->reader->deleteReader($request->id);
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }
}
