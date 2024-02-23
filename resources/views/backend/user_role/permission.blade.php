@extends('backend.layouts.master_add_edit')

@section('custom_css')
    <style type="text/css">
        .parentMenuBlock{
            border: 1px solid #d4c8c8;
            padding: 15px 0px;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('page_content')
    <div class="card-body">
        <input type="hidden" name="userroleId" value="{{ $userRole->id }}">

        <div class="row parentMenuBlock">
            <div class="col-md-12">
                <input type="checkbox" class="select_all" name="select_all"> Select All                                        
            </div>
        </div>

        @foreach ($userMenus as $rootMenu)
	        @php
	            $rolePermission = explode(',', $userRole->permission);
                $actionPermission = explode(',', $userRole->action_permission);

	            if (in_array($rootMenu->id, $rolePermission)) {
	                $checked = "checked";
	            } else {
	                $checked = "";
	            }
                $countUserMenuAction = getTotalMenuAction($rootMenu->id);
	        @endphp

            @if ($rootMenu->parent_menu == NULL)
                @if ($countUserMenuAction == 0)
                    @php
                        $parentMenus = getMenusById($rootMenu->id);
                    @endphp
                    <div class="row parentMenuBlock">
                        <div class="col-md-12">
                            <input class="parentMenu_{{ $rootMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $rootMenu->id }}" {{ $checked }}  data-id="{{ $rootMenu->id }}" @if ($rootMenu->id == 1) onclick="return false" checked @endif>
                            <span>{{ $rootMenu->menu_name }}</span>
                          
                            <div class="row" style="padding-left: 30px;">
                                @foreach ($parentMenus as $parentMenu)
                                    @php
                                        $userMenuAction = getMenuActionsById($parentMenu->id);
                                        
                                        if (in_array($parentMenu->id, $rolePermission)) {
                                            $parentChecked = "checked";
                                        } else {
                                            $parentChecked = "";
                                        }                                            
                                    @endphp

                                    <div class="col-md-3">
                                        <input class="parentMenu_{{ $parentMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $parentMenu->id }}" {{ $parentChecked }}  data-id="{{ $parentMenu->id }}">
                                        <span>{{ $parentMenu->menu_name }}</span>
                                        <div style="margin-left: 26px;margin-top: 3px;">
                                            @foreach ($userMenuAction as $action)
                                                @php
                                                    if (in_array($action->id, $actionPermission)) {
                                                        $actionChecked = "checked";
                                                    } else {
                                                        $actionChecked = "";
                                                    }                                                    
                                                @endphp
                                                <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $actionChecked }}> {{ $action->action_name }} <br>
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
                                                        $subMenuChecked = "checked";
                                                    } else {
                                                        $subMenuChecked = "";
                                                    }                                            
                                                @endphp

                                                <div class="col-sm-12">
                                                    <input class="parentMenu_{{ $subMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $subMenu->id }}" {{ $subMenuChecked }}  data-id="{{ $subMenu->id }}">
                                                    <span>{{ $subMenu->menu_name }}</span>
                                                    <div style="margin-left: 26px;margin-top: 3px;">
                                                        @foreach ($userMenuAction as $action)
                                                            @php
                                                                if (in_array($action->id, $actionPermission)) {
                                                                    $subMenuActionChecked = "checked";
                                                                } else {
                                                                    $subMenuActionChecked = "";
                                                                }                                                    
                                                            @endphp
                                                            <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $subMenuActionChecked }}> {{ $action->action_name }} <br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row parentMenuBlock">
                        @php
                            $userMenuAction = getMenuActionsById($rootMenu->id);

                            if (in_array($rootMenu->id, $rolePermission)) {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }                                            
                        @endphp

                        <div class="col-md-12">
                            <input class="parentMenu_{{ $rootMenu->parent_menu }} menu" type="checkbox" name="usermenu[]" value="{{ $rootMenu->id }}" {{ $checked }}  data-id="{{ $rootMenu->id }}">
                            <span>{{ $rootMenu->menu_name }}</span>
                            <div style="margin-left: 26px;margin-top: 3px;">
                                @foreach ($userMenuAction as $action)
                                    @php
                                        if (in_array($action->id, $actionPermission)) {
                                            $actionChecked = "checked";
                                        } else {
                                            $actionChecked = "";
                                        }                                                    
                                    @endphp
                                    <input class="childMenu_{{ $action->parent_menu_id }}" type="checkbox" name="usermenuAction[]" value="{{ $action->id }}" style="margin-bottom: 8px;" {{ $actionChecked }}> {{ $action->action_name }} <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
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