<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Submit Your Project</h2>

    <form action="{{route('project.store')}}" method="POST" class="needs-validation" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            @error("name")
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <div class="form-group">
            <input type="file" name="project_img" id="">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" id="description" required>
            @error("description")
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="budget">Budget:</label>
            <input type="number" class="form-control" name="budget" id="budget" required>
            @error("budget")
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <select name="partner_id" id="partner_id">
            <option value="">Select a Category</option>
            @foreach($partners as $partner)
                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
            @endforeach
        </select>


        <select name="user_id" id="user_id">
            <option value="">Select a Category</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Optional JavaScript and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
