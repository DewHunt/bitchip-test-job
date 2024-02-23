<?php
use Illuminate\Support\Facades\Route;

// All Backend Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminSettingsController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MenuActionTypeController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\MenuActionController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\ReaderController;

// All Frontend Controller
use App\Http\Controllers\Frontend\HomeController;

Auth::routes();

Route::get('/',[HomeController::class,'index'])->name('home.index');

Route::get('/admin', function () {
	return view('auth.login');
});
Route::post('/do-login',[LoginController::class,'login'])->name('do_login');
Route::get('/admin', [DashboardController::class,'index'])->name('admin.index');

Route::prefix('admin')->group(function() {
	Route::middleware('auth')->group(function() {
		Route::group(['middleware'=>'MenuPermission'],function() {
			Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.index');

			Route::get('/admin-settings',[AdminSettingsController::class,'index'])->name('admin_settings.index');
			Route::get('/admin-settings/add',[AdminSettingsController::class,'add'])->name('admin_settings.add');
			Route::post('/admin-settings/save',[AdminSettingsController::class,'save'])->name('admin_settings.save');
			Route::get('/admin-settings/edit/{id}',[AdminSettingsController::class,'edit'])->name('admin_settings.edit');
			Route::post('/admin-settings/update',[AdminSettingsController::class,'update'])->name('admin_settings.update');
			Route::post('/admin-settings/status',[AdminSettingsController::class,'status'])->name('admin_settings.status');
			Route::get('/admin-settings/delete/{id}',[AdminSettingsController::class,'delete'])->name('admin_settings.delete');

			Route::get('/user-role',[UserRoleController::class,'index'])->name('user_role.index');
			Route::get('/user-role/add',[UserRoleController::class,'add'])->name('user_role.add');
			Route::post('/user-role/save',[UserRoleController::class,'save'])->name('user_role.save');
			Route::get('/user-role/edit/{id}',[UserRoleController::class,'edit'])->name('user_role.edit');
			Route::post('/user-role/update',[UserRoleController::class,'update'])->name('user_role.update');
			Route::post('/user-role/status',[UserRoleController::class,'status'])->name('user_role.status');
			Route::post('/user-role/delete',[UserRoleController::class,'delete'])->name('user_role.delete');
			Route::get('/user-role/permission/{id}',[UserRoleController::class,'permission'])->name('user_role.permission');
			Route::post('/user-role/permission-update',[UserRoleController::class,'updatePermission'])->name('user_role.updatePermission');

			Route::get('/user',[UserController::class,'index'])->name('user.index');
			Route::get('/user/add',[UserController::class,'add'])->name('user.add');
			Route::post('/user/save',[UserController::class,'save'])->name('user.save');
			Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
			Route::post('/user/update',[UserController::class,'update'])->name('user.update');
			Route::post('/user/status',[UserController::class,'status'])->name('user.status');
			Route::get('/user/view/{id}',[UserController::class,'view'])->name('user.view');
			Route::get('/user/profile',[UserController::class,'profile'])->name('user.profile');
			Route::post('/user/delete',[UserController::class,'delete'])->name('user.delete');
			Route::get('/user/change-password/{id}',[UserController::class,'changePassword'])->name('user.changePassword');
			Route::post('/user/update-password',[UserController::class,'updatePassword'])->name('user.updatePassword');
			Route::get('/user/permission/{id}',[UserController::class,'permission'])->name('user.permission');
			Route::post('/user/permission-update',[UserController::class,'updatePermission'])->name('user.updatePermission');

			Route::get('/menu-action-type',[MenuActionTypeController::class,'index'])->name('menu_action_type.index');
			Route::get('/menu-action-type/add',[MenuActionTypeController::class,'add'])->name('menu_action_type.add');
			Route::post('/menu-action-type/save',[MenuActionTypeController::class,'save'])->name('menu_action_type.save');
			Route::get('/menu-action-type/edit/{id}',[MenuActionTypeController::class,'edit'])->name('menu_action_type.edit');
			Route::post('/menu-action-type/update',[MenuActionTypeController::class,'update'])->name('menu_action_type.update');
			Route::post('/menu-action-type/status',[MenuActionTypeController::class,'status'])->name('menu_action_type.status');
			Route::post('/menu-action-type/delete',[MenuActionTypeController::class,'delete'])->name('menu_action_type.delete');

			Route::get('/menu',[MenuController::class,'index'])->name('menu.index');
			Route::get('/menu/add',[MenuController::class,'add'])->name('menu.add');
			Route::post('/menu/save',[MenuController::class,'save'])->name('menu.save');
			Route::get('/menu/edit/{id}',[MenuController::class,'edit'])->name('menu.edit');
			Route::post('/menu/update',[MenuController::class,'update'])->name('menu.update');
			Route::get('/menu/view/{id}',[MenuController::class,'view'])->name('menu.view');
			Route::post('/menu/status',[MenuController::class,'status'])->name('menu.status');
			Route::post('/menu/delete',[MenuController::class,'delete'])->name('menu.delete');
			Route::post('/menu/max-order-by',[MenuController::class,'getMaxOrderBy'])->name('menu.getMaxOrderBy');

			Route::get('/menu-action',[MenuActionController::class,'index'])->name('menu_action.index');
			Route::get('/menu-action/add',[MenuActionController::class,'add'])->name('menu_action.add');
			Route::post('/menu-action/save',[MenuActionController::class,'save'])->name('menu_action.save');
			Route::get('/menu-action/edit/{id}',[MenuActionController::class,'edit'])->name('menu_action.edit');
			Route::post('/menu-action/update',[MenuActionController::class,'update'])->name('menu_action.update');
			Route::post('/menu-action/status',[MenuActionController::class,'status'])->name('menu_action.status');
			Route::post('/menu-action/delete',[MenuActionController::class,'delete'])->name('menu_action.delete');
			Route::post('/menu-action/get-menu-list',[MenuActionController::class,'getMenuListByParentMenuId'])->name('menu_action.getMenuListByParentMenuId');
			Route::post('/menu-action/max-order-by',[MenuActionController::class,'getMaxOrderBy'])->name('menu_action.getMaxOrderBy');
			Route::post('/menu-action/get-menu-action-info',[MenuActionController::class,'getMenuActionInfo'])->name('menu_action.getMenuActionInfo');

			Route::get('/book',[BookController::class,'index'])->name('book.index');
			Route::get('/book/add',[BookController::class,'add'])->name('book.add');
			Route::post('/book/save',[BookController::class,'save'])->name('book.save');
			Route::get('/book/edit/{id}',[BookController::class,'edit'])->name('book.edit');
			Route::post('/book/update',[BookController::class,'update'])->name('book.update');
			Route::post('/book/status',[BookController::class,'status'])->name('book.status');
			Route::post('/book/delete',[BookController::class,'delete'])->name('book.delete');

			Route::get('/reader',[ReaderController::class,'index'])->name('reader.index');
			Route::get('/reader/add',[ReaderController::class,'add'])->name('reader.add');
			Route::post('/reader/save',[ReaderController::class,'save'])->name('reader.save');
			Route::get('/reader/edit/{id}',[ReaderController::class,'edit'])->name('reader.edit');
			Route::post('/reader/update',[ReaderController::class,'update'])->name('reader.update');
			Route::post('/reader/status',[ReaderController::class,'status'])->name('reader.status');
			Route::post('/reader/delete',[ReaderController::class,'delete'])->name('reader.delete');

		});
	});

	//Admin Login Url
	// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	// Route::post('/login', 'Auth\LoginController@login');
    // Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('admin.logout');
});

Route::get('/clear',function () {
	Artisan::call('optimize:clear');

	return 'Clear All Successfully';
});
