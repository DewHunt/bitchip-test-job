@extends('backend.layouts.master_index')

@section('page_content')
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <label for="parent-menu">Parent Menu</label>
            <div class="form-group">
                <select class="form-control select2" id="parentMenuId" name="parentMenuId">
                    <option value="">Select Parent Menu</option>
                    @foreach ($parentMenuList as $parentMenu)
                        <option value="{{ $parentMenu->id }}">{{ $parentMenu->menu_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-5 col-md-5">
            <label for="menu">Menu</label>
            <div class="form-group">
                <div id="menu_list">
                    <select class="form-control select2" id="menuId" name="menuId">
                        <option value="">Select Menu</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2">
            <label></label>
            <div class="form-group mt-2">
                <span class="btn btn-outline-primary btn-block" onclick="showMenuActionInfo()">Show</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="menu_action_info"></div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).on('change','#parentMenuId',function(){
            var parentMenuId = $('#parentMenuId').val();
            
            $.ajax({
                type: "POST",
                url: "{{ route('menu_action.getMenuListByParentMenuId') }}",
                data:{_token:'{{ csrf_token() }}',parentMenuId:parentMenuId},
                success: function(data) {
                    $('#menu_list').html(data.output);
                    $(".select2").select2();
                },
            });
        });

        function showMenuActionInfo() {
            var parentMenuId = $('#parentMenuId').val();
            var menuId = $('#menuId').val();

            $.ajax({
                type: "POST",
                url: "{{ route('menu_action.getMenuActionInfo') }}",
                data:{_token:'{{ csrf_token() }}',parentMenuId:parentMenuId,menuId:menuId},
                success: function(data) {
                    $('#menu_action_info').html(data.output);
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('.js-switch').each(function() {
                        new Switchery($(this)[0], $(this).data());
                    });
                },
            });
        }
    </script>
@endsection