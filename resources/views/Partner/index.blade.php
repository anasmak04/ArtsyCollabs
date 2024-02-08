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



                <div class="row">
                    @foreach($partners as $partner)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header text-center">
                                    {{ $partner->name }}
                                </div>
                                @if($partner->getFirstMediaUrl('images'))
                                    <img src="{{ $partner->getFirstMediaUrl('images') }}" class="card-img-top" alt="Partner Image">
                                @endif
                                <div class="card-body">
                                    <p class="card-text">{{ $partner->description }}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editRoleModal-{{ $partner->id }}">Edit</button>
                                    <form action="{{ route('partner.destroy', ['partner' => $partner->id]) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @foreach($partners as $partner)
                    <div class="modal fade" id="editRoleModal-{{$partner->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Infos for {{$partner->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route("partner.update", ["partner" => $partner->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload Image</label>
                                            <input class="form-control" name="image" type="file" id="formFile">
                                        </div>
                                        <div class="mb-3">
                                            <input value="{{ $partner->name }}" class="form-control form-control-lg" type="text" name="name" placeholder="Enter name" aria-label=".form-control-lg example">
                                        </div>
                                        <div class="mb-3">
                                            <input value="{{ $partner->description }}" class="form-control form-control-lg" type="text" name="description" placeholder="Enter description" aria-label=".form-control-lg example">
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


            </div>
        </div>


    </div>
</div>
</body>
</html>



