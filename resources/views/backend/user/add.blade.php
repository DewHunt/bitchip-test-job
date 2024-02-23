@extends('backend.layouts.master_add_edit')

@section('page_content')
    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                <label for="role">User Role</label>
                <select class="form-control select2" name="role" required>
                    <option value=""> Select Role</option>
                    @foreach($userRoles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>                                       
        </div>

        <div class="col-md-4">                 
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-danger" name="name" value="" required>
            </div>                                       
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="user-name">User Name</label>
                <input type="text" class="form-control form-control-danger" name="username" value="" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-danger" name="email" value="" required>
            </div>                                       
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-danger" name="password" value="" required>
            </div>                                        
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="user-image">User Image</label>
                <input type="file" class="form-control" name="userImage">
            </div>
        </div>
    </div>
@endsection