<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MenuActionTypeInterface;

class MenuActionTypeController extends Controller
{
    protected $menuActionTypeRepo;

    public function __construct(MenuActionTypeInterface $menuActionTypeRepo) {
        $this->menuActionType = $menuActionTypeRepo;
    }

    public function index() {
    	$title = "Menu Action Type";
    	$statusLink = "menu_action_type.status";
    	$deleteLink = "menu_action_type.delete";

        $menuActionTypeList = $this->menuActionType->getAllMenuActionType();

        return view('backend.menu_action_type.index')->with(compact('title','statusLink','deleteLink','menuActionTypeList'));
    }

    public function add(Request $request) {
        $title = "Add New Menu Action Type";
        $formLink = "menu_action_type.save";
        $buttonName = "Save";

        $maxActionId = $this->menuActionType->getMaxMenuActionTypeId();

        if ($maxActionId) {
        	$actionId = $maxActionId + 1;
        } else {
        	$actionId = 1;
        }        

        return view('backend.menu_action_type.add')->with(compact('title','formLink','buttonName','actionId'));
    }

    public function save(request $request) {
        // dd($request->all());
        $checkMenuActionType = $this->menuActionType->isMenuActionTypeExists($request->name);

        if ($checkMenuActionType) {
            return redirect(route('menu_action_type.add'))->with('error',"This Menu Action Type Already Exists With This '".$request->name."' Name");
        } else {
            $data_array = array('name' => $request->name,'action_id' => $request->actionId);
            $result = $this->menuActionType->saveMenuActionType($data_array);

            $msg = 'Something Wrong! Save Unsuccessful';
            if ($result) {
                $msg = 'Menu Action Type Saved Successfully';
            }

            return redirect(route('menu_action_type.index'))->with('msg',$msg);
        }   
    }

    public function edit($menuActionTypeId) {
        $title = "Edit Menu Action Type";
        $formLink = "menu_action_type.update";
        $buttonName = "Update";

        $menuActionTypeInfo = $this->menuActionType->getMenuActionTypeById($menuActionTypeId);

        return view('backend.menu_action_type.edit')->with(compact('title','formLink','buttonName','menuActionTypeInfo'));
    }

    public function update(request $request) {
        // dd($request->all());
        $menuActionTypeId = $request->menuActionTypeId;
        $menuActionTypeName = $request->name;
        $checkMenuActionType = $this->menuActionType->isMenuActionTypeExists($menuActionTypeName,$menuActionTypeId);

        if ($checkMenuActionType) {
            return redirect(route('menu_action_type.edit',$menuActionTypeId))->with('error',"This Menu Action Type Already Exists With This '".$menuActionTypeName."' Name");
        } else {
            $data_array = array('name' => $request->name,'action_id' => $request->actionId);
            $result = $this->menuActionType->updateMenuActionType($menuActionTypeId,$data_array);

            $msg = 'Something Wrong! Update Unsuccessful';
            if ($result) {
                $msg = 'Menu Action Type Updated Successfully';
            }

            return redirect(route('menu_action_type.index'))->with('msg',$msg);
        }   
    }

    public function status(Request $request) {
        $result = $this->menuActionType->getMenuActionTypeById($request->id);

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
        $isDelete = false;
        $message = 'Something Wrong! Delete Unsuccessful';
        $result = $this->menuActionType->deleteMenuActionType($request->id);
        if ($result) {
            $isDelete = true;
        }
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }
}
