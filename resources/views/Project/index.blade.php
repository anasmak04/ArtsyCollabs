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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #2C3E50;            overflow-x: hidden;
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
            background-color: #18BC9C;
            color: #fff;
        }
        .card {
            border: none; /* Remove default border */
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        .btn-outline-secondary {
            border-color: #18BC9C;
            color: #18BC9C;
        }
        .btn-outline-secondary:hover {
            background-color: #18BC9C;
            color: #fff;
        }

        .btn-outline-danger {
            border-color: #E74C3C;
            color: #E74C3C;
        }
        .btn-outline-danger:hover {
            background-color: #E74C3C;
            color: #fff;
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
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Projects</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>avatar</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Budget</th>
                                        <th>Owner</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td><img style="width: 60px" src="{{$project->getFirstMediaUrl("images")}}" alt=""></td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->description }}</td>
                                            <td>${{ $project->budget }}</td>
                                            <td>{{ $project->user->name }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editProjectModal-{{ $project->id }}">Edit</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#showProjectModal-{{ $project->id }}">Show</button>
                                                <form action="{{ route('project.destroy', ['project' => $project->id]) }}" method="post" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@foreach($projects as $project)
    <div class="modal fade" id="showProjectModal-{{$project->id}}" tabindex="-1" aria-labelledby="showProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showProjectModalLabel">{{ $project->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display the project image in a larger size -->
                    <img src="{{$project->getFirstMediaUrl('images')}}" alt="Project Image" style="width: 100%; max-height: 400px; object-fit: cover;">
                    <div class="mt-3"> <!-- Use margin-top (mt-3) to add some spacing between the image and the text content -->
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Budget:</strong> ${{ $project->budget }}</p>
                        <p><strong>Owner:</strong> {{ $project->user->name }}</p>
                        <!-- Add more details as needed -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

</body>
</html>
