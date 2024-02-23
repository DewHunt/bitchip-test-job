<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\MenuInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;

use Auth;

class UserController extends Controller
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
    	$title = "User";
    	$statusLink = "user.status";
    	$deleteLink = "user.delete";

    	$userList = $this->user->getAllUserLists();

    	return view('backend.user.index')->with(compact('title','statusLink','deleteLink','userList'));
    }

    public function add() {
        $title = "Add New User";
        $formLink = "user.save";
        $buttonName = "Save";

        $userRoles = $this->userRole->getAllUserRoleLists();

        return view('backend.user.add')->with(compact('title','formLink','buttonName','userRoles'));
    }

    public function save(Request $request) {
    	// dd($request->all());
        $isUserExists = $this->user->isUserExists($request->username,$request->email);
    	if ($isUserExists) {
    		return redirect(route('user.add'))->with('error','This User Alredy Creted By This User Name Or Email');
    	} else {
	        if (isset($request->userImage)) {
	            $userImage = uploadImage($request->userImage,'public/images/users/');
	        } else {
	            $userImage = "";
	        }

            $data_array = array(
                'user_role_id' => $request->role,     
                'name' => $request->name,
                'user_name' => $request->username,
                'email' => $request->email,
                'image' => $userImage,              
                'password' => bcrypt($request->password),
            );
            $result = $this->user->saveUser($data_array);

            $msg = 'Something Wrong! Save Unsuccessful';
            if ($result) {
                $msg = 'User Saved Successfully';
            }

	        return redirect(route('user.index'))->with('msg',$msg); 
    	}    
    }

    public function edit($userId) {
        $title = "Edit User";
        $formLink = "user.update";
        $buttonName = "Update";

        $userRoles = $this->userRole->getAllUserRoleLists();
        $userInfo = $this->user->getUserById($userId);

        return view('backend.user.edit')->with(compact('title','formLink','buttonName','userRoles','userInfo'));
    }

    public function update(Request $request) {
        // dd($request->all());
        if (isset($request->profileId)) {
            $userId = Auth::user()->id;
            $userData = array(
                'name' => $request->name,
                'user_name' => $request->username,
                'email' => $request->email
            );
            $redirectLink = 'user.profile';
        } else {
            $userId = $request->userId;
            $userData = array(
                'user_role_id' => $request->role,     
                'name' => $request->name,
                'user_name' => $request->username,
                'email' => $request->email,
            );
            if ($request->password) {
                $userData['password'] = bcrypt($request->password);                
            }
            $redirectLink = 'user.index';
        }

        $isUserExists = $this->user->isUserExists($request->username,$request->email,$userId);

    	if ($isUserExists) {
    		return redirect(route($redirectLink == 'user.profile' ? $redirectLink : $redirectLink,$userId))->with('error','This User Alredy Creted By This User Name Or Email');
    	} else {            
	        if (!empty($request->userImage)) {
	            $userImage = uploadImage($request->userImage,'public/images/users/');
	        } else {
	            $userImage = $request->previousUserImage;
	        }

            $userData['image'] = $userImage;
            $result = $this->user->updateUser($userId,$userData);

            $msg = 'Something Wrong! Save Unsuccessful';
            if ($result) {
                $msg = 'User Updated Successfully';
            }

	        return redirect(route($redirectLink == 'user.profile' ? $redirectLink : $redirectLink,$userId))->with('msg',$msg); 
    	}    
    }

    public function permission($userId) {
        $formLink = "user.updatePermission";
        $buttonName = "Update";

        $userMenus = $this->menu->getAllMenuListsByStatus(1);
        // dd($userMenus);
        $userInfo = $this->user->getUserById($userId);
        $userRole = $this->userRole->getUserRoleById($userInfo->user_role_id);
        $title = "User's Menu Permission (".$userInfo->name.")";

        return view('backend.user.permission')->with(compact('title','formLink','buttonName','userMenus','userInfo','userRole'));
    }

    public function updatePermission(Request $request) {
        // dd($request->all());

        $userroleId = $request->userroleId;
        $userId = $request->userId;
        
        if(@$request->usermenu) {
            $usermenus = implode(',', $request->usermenu);
        } else {
            $usermenus = null;
        }
        
        if(@$request->usermenuAction) {
            $usermenuAction = implode(',', @$request->usermenuAction);
        } else {
            $usermenuAction = null;
        }
        
        $data_array = array(
            'permission' => @$usermenus,                     
            'action_permission' => @$usermenuAction, 
        );

        $result = $this->user->updateUser($userId,$data_array);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'User Menu Permission Updated Successfully';
        }

        return redirect(route('user.index'))->with('msg',$msg); 
    }

    public function changePassword($userId) {
        $title = "Change Password";
        $formLink = "user.updatePassword";
        $buttonName = "Update";

        return view('backend.user.change_password')->with(compact('title','formLink','buttonName','userId'));
    }

    public function updatePassword(Request $request) {
        if (isset($request->profileId)) {
            $userId = Auth::user()->id;
            $redirectLink = 'user.profile';
        } else {
            $userId = $request->userId;
            $redirectLink = 'user.index';
        }

        $data_array = array(
            'password' => bcrypt($request->password)
        );

        $result = $this->user->updateUser($userId,$data_array);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'User Password Updated Successfully';
        }

        return redirect(route($redirectLink == 'user.profile' ? $redirectLink : $redirectLink))->with('msg','User Password Updated Successfully'); 
    }

    public function view($userId) {
        // dd($request->all());
        $title = "View User Info";
        $editLink = "user.edit";
        $editButtonName = "Edit Profile Info";
        $changePasswordLink = "user.changePassword";
        $changePasswordButtonName = "Change Password";

        $userInfo = $this->user->getUserById($userId);

        return view('backend.user.view')->with(compact('title','editLink','editButtonName','changePasswordLink','changePasswordButtonName','userInfo'));
    }

    public function profile() {
        // dd($request->all());
        $title = "User Profile";
        $editFormLink = "user.update";
        $editButtonName = "Edit Profile Info";
        $changePasswordFormLink = "user.updatePassword";
        $changePasswordButtonName = "Change Password";

        $userInfo = $this->user->getUserById(Auth::user()->id);

        return view('backend.user.view')->with(compact('title','editFormLink','editButtonName','changePasswordFormLink','changePasswordButtonName','userInfo'));
    }

    public function status(Request $request) {
        $result = $this->user->getUserById($request->id);

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
        $this->user->deleteUser($request->id);
        
        if($request->ajax()) {
            return response()->json(['isDelete'=>$isDelete,'message'=>$message]);
        }
    }
}
