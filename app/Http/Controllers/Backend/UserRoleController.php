<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MenuInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;

use App\Models\UserRole;
use App\Models\User;
use App\Models\Menu;

class UserRoleController extends Controller
{
    protected $menuRepo;
    protected $userRepo;
    protected $userRoleRepo;

    function __construct(
        MenuInterface $menuRepo,
        UserInterface $userRepo,
        UserRoleInterface $userRoleRepo
    ) {
        $this->menu = $menuRepo;
        $this->user = $userRepo;
        $this->userRole = $userRoleRepo;
    }

	public function index() {
		$title = 'User Role';
        $statusLink = "user_role.status";
        $deleteLink = "user_role.delete";

		$userRoleList = $this->userRole->getAllUserRoleLists();

		return view('backend.user_role.index')->with(compact('title','userRoleList','statusLink','deleteLink'));
	}

	public function add() {
		$title = "Add User Role";
        $goBackLink = "user_role.index";
        $formLink = "user_role.save";
        $buttonName = "Save";

		return view('backend.user_role.add')->with(compact('title','goBackLink','formLink','buttonName'));
	}

	public function save(Request $request) {
        $data_array = array(
            'name' => $request->name,
            'order_by' => $request->order_by,
        );
        $result = $this->userRole->saveUserRole($data_array);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'User Role Saved Successfully';
        }

        return redirect(route('user_role.index'))->with('msg',$msg);
	}

    public function edit($userRoleId) {
        $title = "Edit User's Role";
        $formLink = "user_role.update";
        $buttonName = "Update";

        $userRole = $this->userRole->getUserRoleById($userRoleId);

        return view('backend.user_role.edit')->with(compact('title','formLink','buttonName','userRole'));
    }

    public function update(Request $request) {
        $userRoleId = $request->userRoleId;

        $data_array = array(
            'name' => $request->name,
            'order_by' => $request->order_by,
        );
        $result = $this->userRole->updateUserRole($userRoleId,$data_array);

        $msg = 'Something Wrong! Update Unsuccessful';
        if ($result) {
            $msg = 'User Role Updated Successfully';
        }

        return redirect(route('user_role.index'))->with('msg',$msg);
    }

    public function permission($userRoleId) {
        $formLink = "user_role.updatePermission";
        $buttonName = "Update";

        $userMenus = $this->menu->getAllMenuListsByStatus(1);
        $userRole = $this->userRole->getUserRoleById($userRoleId);
        $title = "User Role's Menu Permission (".$userRole->name.")";

        return view('backend.user_role.permission')->with(compact('title','formLink','buttonName','userMenus','userRole'));
    }

    public function updatePermission(Request $request) {
        $userMenu = null;
        $userMenuAction = null;
        $userroleId = $request->userroleId;
        $userRoles = $this->userRole->getUserRoleById($userroleId);
        $users = $this->user->getUserByUserRoleId($userRoles->id);
        
        foreach ($users as $user) {
            $permission = explode(',', $user->permission);
            $actionPermission = explode(',', $user->action_permission);
            if ($request->usermenu) {
                $intersectMenu = array_intersect($permission, $request->usermenu);
                $userMenu = implode(',', $intersectMenu);
            }

            if ($request->usermenuAction) {
                $intersectMenuAction = array_intersect($actionPermission, $request->usermenuAction);
                $userMenuAction = implode(',', $intersectMenuAction);
            }

            $user->update( [
                'permission' => $userMenu,                     
                'action_permission' => $userMenuAction,                     
            ]);
        }
        
        if (@$request->usermenu) {
            $userRoleMenus = implode(',', $request->usermenu);
        } else {
            $userRoleMenus = '';
        }
        
        if (@$request->usermenuAction) {
            $userRoleMenuAction = implode(',', @$request->usermenuAction);
        } else {
            $userRoleMenuAction = '';
        }
        
        $data_array = array(
            'permission' => @$userRoleMenus,                     
            'action_permission' => @$userRoleMenuAction, 
        );

        $result = $this->userRole->updateUserRole($userroleId,$data_array);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'User Role Menu Permission Updated Successfully';
        }

        return redirect(route('user_role.index'))->with('msg',$msg); 
    }

    public function delete(Request $request) {
        $isDelete = true;
        $message = "";
        $result = $this->userRole->deleteUserRole($request->id);
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }

    public function status(Request $request) {
        $result = $this->userRole->getUserRoleById($request->id);

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
}
