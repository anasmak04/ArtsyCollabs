<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
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
                <!-- Projects Section -->
                <div class="row">
                    @foreach($projects as $project)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    {{ $project->name }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $project->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Budget: ${{ $project->budget }}</small>
                                        <small class="text-muted">By: {{ $project->user->name }}</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editProjectModal-{{ $project->id }}">Edit</button>
                                    <form action="{{ route('project.destroy', ['project' => $project->id]) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Edit Modal -->
@foreach($projects as $project)
    <div class="modal fade" id="editProjectModal-{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('project.update', ['project' => $project->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Form fields for editing a project -->
                        <div class="form-group">
                            <label for="projectName">Project Name</label>
                            <input type="text" class="form-control" id="projectName" name="name" value="{{ $project->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="projectDescription">Description</label>
                            <textarea class="form-control" id="projectDescription" name="description" rows="3" required>{{ $project->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="projectBudget">Budget</label>
                            <input type="number" class="form-control" id="projectBudget" name="budget" value="{{ $project->budget }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

</body>
</html>
