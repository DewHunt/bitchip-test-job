@extends('backend.layouts.master_add_edit')

@section('custom_css')
    <style type="text/css">
        .parentMenuBlock{
            border: 1px solid #d4c8c8;
            padding: 17px 0px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('page_content')
    <div class="card-body">
        <input type="hidden" name="userroleId" value="{{ $userRole->id }}">
        <input type="hidden" name="userId" value="{{ $userInfo->id }}">

        <div class="row">
            <div class="col-md-10">
                <input type="checkbox" class="select_all" name="select_all"> Select All                                        
            </div>
        </div>

        <div style="padding-bottom: 10px;"></div>

        @foreach ($userMenus as $rootMenu)
	        @php
	            $rolePermission = explode(',', $userRole->permission);
                $userPermission = explode(',', $userInfo->permission);

                $roleActionPermission = explode(',', $userRole->action_permission);
                $userActionPermission = explode(',', $userInfo->action_permission);

	            if (in_array($rootMenu->id, $rolePermission)) {
	                $roleChecked = "checked";
	            } else {
	                $roleChecked = "";
	            }

                if (in_array($rootMenu->id, $userPermission)) {
                    $userChecked = "checked";
                } else {
                    $userChecked = "";
                }
                $countUserMenuAction = getTotalMenuAction($rootMenu->id);
	        @endphp

            @if ($rootMenu->parent_menu == NULL)
                @if ($countUserMenuAction == 0)
                    @php
                        $parentMenus = getMenusById($rootMenu->id);
                    @endphp

                    @if ($roleChecked == 'checked')
                        <div class="row parentMenuBlock">
                            <div class="col-md-12">
                                <input class="parentMenu_{{ $rootMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $rootMenu->id }}" {{ $userChecked }}  data-id="{{ $rootMenu->id }}" @if ($rootMenu->id == 1) onclick="return false" checked @endif>
                                <span>{{ $rootMenu->menu_name }}</span>
                              
                                <div class="row" style="padding-left: 30px;">
                                    @foreach ($parentMenus as $parentMenu)
                                        @php
                                            $userMenuAction = getMenuActionsById($parentMenu->id);
                                            // dd($userMenuAction);

                                            if (in_array($parentMenu->id, $rolePermission)) {
                                                $roleParentChecked = "checked";
                                            } else {
                                                $roleParentChecked = "";
                                            }
                                            
                                            if (in_array($parentMenu->id, $userPermission)) {
                                                $userParentChecked = "checked";
                                            } else {
                                                $userParentChecked = "";
                                            }                                            
                                        @endphp

                                        @if ($roleParentChecked == 'checked')
                                            <div class="col-md-3">
                                                <input class="parentMenu_{{ $parentMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $parentMenu->id }}" {{ $userParentChecked }}  data-id="{{ $parentMenu->id }}">
                                                <span>{{ $parentMenu->menu_name }}</span>
                                                <div style="margin-left: 26px;margin-top: 3px;">
                                                    @foreach ($userMenuAction as $action)
                                                        @php
                                                            if (in_array($action->id, $roleActionPermission)) {
                                                                $roleActionChecked = "checked";
                                                            } else {
                                                                $roleActionChecked = "";
                                                            }

                                                            if (in_array($action->id, $userActionPermission)) {
                                                                $userActionChecked = "checked";
                                                            } else {
                                                                $userActionChecked = "dew";
                                                            }                                                    
                                                        @endphp

                                                        @if ($roleActionChecked == 'checked')
                                                            <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $userActionChecked }}> {{ $action->action_name }} <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                  
                                                <div class="row" style="padding-left: 30px;">
                                                    @php
                                                        $subMenus = getMenusById($parentMenu->id);
                                                    @endphp
                                                    @foreach ($subMenus as $subMenu)
                                                        @php
                                                            $userMenuAction = getMenuActionsById($subMenu->id);

                                                            if (in_array($subMenu->id, $rolePermission)) {
                                                                $roleSubMenuChecked = "checked";
                                                            } else {
                                                                $roleSubMenuChecked = "";
                                                            }

                                                            if (in_array($subMenu->id, $userPermission)) {
                                                                $userSubMenuChecked = "checked";
                                                            } else {
                                                                $userSubMenuChecked = "";
                                                            }
                                                        @endphp

                                                        @if ($roleSubMenuChecked == 'checked')
                                                            <div class="col-sm-12">
                                                                <input class="parentMenu_{{ $subMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $subMenu->id }}" {{ $userSubMenuChecked }}  data-id="{{ $subMenu->id }}">
                                                                <span>{{ $subMenu->menu_name }}</span>
                                                                <div style="margin-left: 26px;margin-top: 3px;">
                                                                    @foreach ($userMenuAction as $action)
                                                                        @php
                                                                            if (in_array($action->id, $roleActionPermission)) {
                                                                                $roleSubMenuActionChecked = "checked";
                                                                            } else {
                                                                                $roleSubMenuActionChecked = "";
                                                                            }

                                                                            if (in_array($action->id, $userActionPermission)) {
                                                                                $userSubMenuActionChecked = "checked";
                                                                            } else {
                                                                                $userSubMenuActionChecked = "";
                                                                            }
                                                                        @endphp

                                                                        @if ($roleSubMenuActionChecked == 'checked')
                                                                            <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $userSubMenuActionChecked }}> {{ $action->action_name }} <br>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @php
                        $userMenuAction = getMenuActionsById($rootMenu->id);
                        
                        if (in_array($rootMenu->id, $rolePermission)) {
                            $roleChecked = "checked";
                        } else {
                            $roleChecked = "";
                        }
                        
                        if (in_array($rootMenu->id, $userPermission)) {
                            $userChecked = "checked";
                        } else {
                            $userChecked = "";
                        }
                    @endphp
                    @if ($roleChecked == 'checked' && count($userMenuAction) > 0)
                        <div class="row parentMenuBlock">
                            <div class="col-md-12">
                                <input class="parentMenu_{{ $rootMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $rootMenu->id }}" {{ $userChecked }}  data-id="{{ $rootMenu->id }}">
                                <span>{{ $rootMenu->menu_name }}</span>
                                <div style="margin-left: 26px;margin-top: 3px;">
                                    @foreach ($userMenuAction as $action)
                                        @php
                                            if (in_array($action->id, $roleActionPermission)) {
                                                $roleActionChecked = "checked";
                                            } else {
                                                $roleActionChecked = "";
                                            }

                                            if (in_array($action->id, $userActionPermission)) {
                                                $userActionChecked = "checked";
                                            } else {
                                                $userActionChecked = "";
                                            }
                                        @endphp

                                        @if ($roleActionChecked == 'checked')
                                            <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $userActionChecked }}> {{ $action->action_name }} <br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select_all').click(function(event){
                if (this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() { this.checked = true; });
                } else {
                    $(':checkbox').each(function() { this.checked = false; });
                }
            });

            $('.menu').click(function(event){
                var menuId = $(this).data('id');
                if (this.checked) {
                    $('.parentMenu_'+menuId).each(function() { this.checked = true; });
                    $('.childMenu_'+menuId).each(function() { this.checked = true; });
                } else {
                    $('.parentMenu_'+menuId).each(function() { this.checked = false; });
                    $('.childMenu_'+menuId).each(function() { this.checked = false; });
                }
            });
        });
    </script>
@endsection