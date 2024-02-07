<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
        }

        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }


    </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="#">Age</a></li>
                <li><a href="#">Gender</a></li>
                <li><a href="#">Geo</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content static-wrapper">
        <div class="col-sm-3 sidenav hidden-xs">
            <h2>Dashboard</h2>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#section1">users</a></li>
                <li><a href="#section2">partners</a></li>
                <li><a href="#section3">Gender</a></li>
                <li><a href="#section4">Geo</a></li>
            </ul><br>
        </div>
        <br>

        <div class="col-sm-9">
            <div class="well">
                <h4>Dashboard</h4>
                <p>Some text..</p>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="well text-center">
                        <h4>Users <span class="badge">{{$userstatistic}}</span></h4>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="well text-center">
                        <h4>Projects <span class="badge">{{$projectstatistic}}</span></h4>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="well text-center">
                        <h4>Partners <span class="badge">{{$partnerstatistic}}</span></h4>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="well text-center">
                        <h4>Bounce Rate <span class="badge">30%</span></h4>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                                <tr class="">
                                    <td class="align-middle text-center">{{ $user->id }}</td>

                                    <td class="align-middle text-center">
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
                                        <span class="badge bg-success">{{ $user->status }}</span>
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
                                <!-- Modal Structure -->
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
    </div>
</div>

</body>
</html>
