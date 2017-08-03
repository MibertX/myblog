@extends('admin.user.layout')

@section('admin-content')
    <div class="row">
        <div class="col-xs-12">
            <form action="" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="roles">Role</label>
                    <select size="1" id="roles" name="role_id">
                        @foreach($roles as $role)
                            <option value="{{$role->role_id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit">
            </form>
        </div>
    </div>
@endsection