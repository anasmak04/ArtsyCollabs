<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Include Bootstrap CSS from a CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Submit Your Project</h2>

    <form action="{{route('project.store')}}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            @error("name")
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
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

        <input type="hidden" name="user_id">
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Optional JavaScript and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
