<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AdminSettingsInterface;

class AdminSettingsController extends Controller
{
    protected $adminSettingsRepo;

    public function __construct(AdminSettingsInterface $adminSettingsRepo) {
        $this->adminSettings = $adminSettingsRepo;
    }

    public function index() {
        $title = "Admin Settings";
        $statusLink = "admin_settings.status";
        $deleteLink = "admin_settings.delete";

        $adminSettingsInfo = $this->adminSettings->getAdminSettings();

        return view('backend.admin_settings.index')->with(compact('title','statusLink','deleteLink','adminSettingsInfo'));
    }

    public function add(Request $request) {
        $title = "Add Admin Settings";
        $formLink = "admin_settings.save";
        $buttonName = "Save";       

        return view('backend.admin_settings.add')->with(compact('title','formLink','buttonName'));
    }

    public function save(request $request) {
        // dd($request->all());
        $logoImage = "";
        if (!empty($request->logoImage)) {
            $logoImage = uploadImage($request->logoImage,'public/admin/assets/images/');
        } 

        $thumbLogoImage = "";
        if (!empty($request->thumbLogoImage)) {
            $thumbLogoImage = uploadImage($request->thumbLogoImage,'public/admin/assets/images/');
        }        
        
        $favIcon = "";
        if (!empty($request->favIcon)) {
            $favIcon = uploadImage($request->favIcon,'public/admin/assets/images/');
        }

        $data_array = array(
            'title' => $request->title,
            'developed_by' => $request->developedBy,
            'developer_site' => $request->developerSite,
            'logo' => $logoImage,
            'thumb_logo' => $thumbLogoImage,
            'fav_icon' => $favIcon,
            'created_at' => date('Y-m-d H:i:s')
        );
        $result = $this->adminSettings->saveAdminSettings($data_array);

        $msg = 'Something Wrong! Save Unsuccessful';
        if ($result) {
            $msg = 'Admin Settings Saved Successfully';
        }

        return redirect(route('admin_settings.index'))->with('msg',$msg);
    }

    public function edit($id) {
        $title = "Edit Admin Settings";
        $formLink = "admin_settings.update";
        $buttonName = "Update";

        $adminSettingsInfo = $this->adminSettings->getAdminSettingsById($id);

        return view('backend.admin_settings.edit')->with(compact('title','formLink','buttonName','adminSettingsInfo'));
    }

    public function update(request $request) {
        // dd($request->all());
        $adminSettingsId = $request->adminSettingsId;

        $logoImage = $request->previousLogoImage;
        if (!empty($request->logoImage)) {
            $logoImage = uploadImage($request->logoImage,'public/admin/assets/images/');
        } 

        $thumbLogoImage = $request->previoustThumbLogoImage;
        if (!empty($request->thumbLogoImage)) {
            $thumbLogoImage = uploadImage($request->thumbLogoImage,'public/admin/assets/images/');
        }        
        
        $favIcon = $request->previousFavIcon;
        if (!empty($request->favIcon)) {
            $favIcon = uploadImage($request->favIcon,'public/admin/assets/images/');
        }

        $data_array = array(
            'title' => $request->title,
            'developed_by' => $request->developedBy,
            'developer_site' => $request->developerSite,
            'logo' => $logoImage,
            'thumb_logo' => $thumbLogoImage,
            'fav_icon' => $favIcon,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $result = $this->adminSettings->updateAdminSettings($adminSettingsId,$data_array);

        $msg = 'Something Wrong! Update Unsuccessful';
        if ($result) {
            $msg = 'Admin Settings Updated Successfully';
        }

        return redirect(route('admin_settings.index'))->with('msg',$msg);
    }

    public function status(Request $request) {
        $result = $this->adminSettings->getAdminSettingsById($request->id);

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
        $result = $this->adminSettings->deleteAdminSettings($request->id);
        $msg = 'Something Wrong! Delete Unsuccessful';
        if ($result) {
            $msg = 'Admin Settings Deleted Successfully';
        }

        return redirect(route('admin_settings.index'))->with('msg',$msg);
    }
}
