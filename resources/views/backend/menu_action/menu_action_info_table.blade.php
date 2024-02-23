<div class="dt-responsive table-responsive">
    <table id="complex-dt" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Menu Name</th>
                <th>Menu Type</th>
                <th>Action Name</th>
                <th>Link</th>
                <th width="20px">Order</th>
                <th width="50px">Status</th>
                <th width="70px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sl = 1;
            @endphp

            @foreach ($menuActionList as $menuAction)
                <tr class="row_{{ $menuAction->id }}">
                    <td>{{ $sl }}</td>
                    @if ($sl == 1)
                        <td rowspan="{{ count($menuActionList) }}">{{ $menuAction->menuName }}</td>
                    @endif
                    <td>{{ $menuAction->menuTypeName }}</td>
                    <td>{{ $menuAction->action_name }}</td>
                    <td>{{ $menuAction->action_link }}</td>
                    <td>{{ $menuAction->order_by }}</td>
                    <td>
                        @php
                            echo status($menuAction->id,$menuAction->status);
                        @endphp
                    </td>
                    <td>
                        @php
                            echo actions($menuAction->id);
                        @endphp
                    </td>
                </tr>
                @php
                    $sl++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>