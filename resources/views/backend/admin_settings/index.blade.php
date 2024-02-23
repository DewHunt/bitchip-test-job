@extends('backend.layouts.master')

@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                            @if (@$adminSettingsInfo)
                                <a class="btn btn-outline-danger btn-lg" href="{{ route('admin_settings.delete',$adminSettingsInfo->id) }}">
                                    <i class="fa fa-trash"></i>Delete
                                </a>
                                <a class="btn btn-outline-info btn-lg" href="{{ route('admin_settings.edit',$adminSettingsInfo->id) }}">
                                    <i class="fa fa-edit"></i>Edit
                                </a>
                            @else
                                @if (addAction())
                                    <a class="btn btn-outline-info btn-lg" href="{{ route($addNewLink) }}">
                                        <i class="fa fa-plus-circle"></i> Add New
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($adminSettingsInfo)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td width="170px" class="text-right">Title</td>
                                        <td>{{ $adminSettingsInfo->title }}</td>
                                    </tr>
                                    <tr>
                                        <td width="170px" class="text-right">Developed By</td>
                                        <td>{{ $adminSettingsInfo->developed_by }}</td>
                                    </tr>
                                    <tr>
                                        <td width="170px" class="text-right">Developer Site</td>
                                        <td>{{ $adminSettingsInfo->developer_site }}</td>
                                    </tr>
                                    <tr>
                                        <td width="170px" class="text-right">Logo</td>
                                        <td><img src="{{ asset($adminSettingsInfo->logo) }}" alt="Logo Image" width="250px" height="100px"></td>
                                    </tr>
                                    <tr>
                                        <td width="170px" class="text-right">Thumb Logo</td>
                                        <td><img src="{{ asset($adminSettingsInfo->thumb_logo) }}" alt="Logo Image" width="250px" height="100px"></td>
                                    </tr>
                                    <tr>
                                        <td width="170px" class="text-right">Fav Icon</td>
                                        <td><img src="{{ asset($adminSettingsInfo->fav_icon) }}" alt="Fav Icon" width="150px" height="100px"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection