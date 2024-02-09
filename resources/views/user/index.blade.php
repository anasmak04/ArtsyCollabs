<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .badge {
            background-color: #007bff;
            color: white;
        }
        .row.content {height: 550px}
        .sidenav,
        .static-wrapper{
            height: 100vh;
        }
        @media screen and (max-width: 767px) {
            .row.content {height: auto;}
        }

        .avatar{
            border-radius: 50px;
            width: 50px;
            height: 50px;
        }


        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f7fc;
            margin-top: 0;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343a40;
            overflow-x: hidden;
            padding-top: 20px;
            transition: 0.5s;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ddd;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #fff;
            background-color: #007bff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.5s;
        }
        @media (max-width: 767px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {float: left;}
            .main-content {margin-left: 0;}
        }
        @media (min-width: 768px) {
            .sidebar {width: 250px; height: 100vh; position: fixed;}
            .main-content {margin-left: 250px;}
        }
        .profile-info {
            text-align: center;
            padding: 10px;
        }
        .profile-info img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }


    </style>
</head>
<body>


<div class="sidebar">
    <div class="profile-info">

        <img src="{{ Auth::user()->getFirstMediaUrl('images') }}" alt="Profile Image">
        <h5 style="color: #fff;">{{Auth::user()->name}}</h5>
    </div>
    <a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a>
    <a href="/user"><i class="fas fa-users"></i> Users ({{$userstatistic}})</a>
    <a href="/project"><i class="fas fa-project-diagram"></i> Projects ({{$projectstatistic}})</a>
    <a href="/partner"><i class="fas fa-handshake"></i> Partners ({{$partnerstatistic}})</a>
    <a href="/profile"><i class="fas fa-user-circle"></i> Profile</a>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>


<div class="main-content">
    <div class="container-fluid mx-auto">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Project Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Users</div>
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">{{ $userstatistic }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Projects</div>
                            <div class="card-body">
                                <h5 class="card-title">Projects Count</h5>
                                <p class="card-text">{{ $projectstatistic }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Partners</div>
                            <div class="card-body">
                                <h5 class="card-title">Total Partners</h5>
                                <p class="card-text">{{ $partnerstatistic }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header">Bounce Rate</div>
                            <div class="card-body">
                                <h5 class="card-title">Rate</h5>
                                <p class="card-text">30%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>

                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr  class="">

                            <td class="align-middle  text-center">
                                @if($user->getFirstMediaUrl('images'))
                                    <img class="avatar" src="{{ $user->getFirstMediaUrl('images') }}" width="100" height="100" alt="Profile Image">
                                @endif
                            </td>

                            <td class="align-middle text-center">{{ $user->name }}</td>

                            <td class="align-middle text-center">{{ $user->email }}</td>

                            <td class="align-middle text-center">
                                <span class="badge bg-primary">{{ $user->role->name ?? 'No Role' }}</span>
                            </td>
                            <td class="align-middle text-center">
                                @if($user->status == "pending")
                                    <span style="background-color: yellowgreen" class="badge bg-warning">{{ $user->status }}</span>
                                @elseif($user->status == "accepted")
                                    <span  style="background-color: green" class="badge bg-success">{{ $user->status }}</span>
                                @elseif($user->status == "refused")
                                    <span  style="background-color: red" class="badge bg-danger">{{ $user->status }}</span>
                                @endif


                            </td>

                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#editRoleModal-{{ $user->id }}">Edit</a>
                                    <form action="{{ route("user.destroy", ["user" => $user->id]) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                    @foreach($users as $user)
                        <div class="modal fade" id="editRoleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Role for {{$user->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route("user.update", ["user" => $user->id])}}" method="POST">
                                        @csrf
                                        @method("PATCH")
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="role_id-{{$user->id}}" class="form-label">Role</label>
                                                <select class="form-control" aria-label="Default select example" name="role_id">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





</body>
</html>
