@extends('layouts.app')

@section('content')
    <div class="hero-section position-relative text-white d-flex justify-content-center align-items-center mb-4" style="background: url('/path-to-your-image.jpg') no-repeat center center; background-size: cover; height: 450px;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);"></div>
        <div class="container text-center position-relative" style="z-index: 2;">
            <h1 class="display-4 fw-bold">Welcome to Our Job Platform</h1>
            <p class="fs-4">Connecting talented individuals with companies and projects that matter. Explore opportunities or find your next team member today.</p>
            <a href="#projects" class="btn btn-primary btn-lg">Discover More</a>
        </div>
    </div>
    <div class="container my-4">
        <h2 class="mb-3">Projects and Companies</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($projects as $project)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($project->getFirstMediaUrl("images"))
                            <img src="{{ $project->getFirstMediaUrl("images") }}" class="card-img-top" alt="{{ $project->name }}" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text"><span class="badge bg-primary">Budget: ${{ $project->budget }}</span></p>
                            <p class="card-text">Company: <strong>{{ $project->company->name ?? 'N/A' }}</strong></p>
                            <p class="card-text">User who apply : <strong>{{ $project->user->name ?? 'N/A' }}</strong></p>
                            <p class="card-text">{{ $project->company->description ?? 'N/A' }}</p>

                            <div class="mt-auto">
                                @if($project->user_id == auth()->id())
                                    <form action="{{ route('projects.leave', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Leave</button>
                                    </form>
                                @else
                                    <form action="{{ route('projects.apply', $project->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Apply</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p class="text-center">No projects found.</p>
                </div>
            @endforelse
        </div>

        <!-- Assuming you want to display partners similarly -->
        <h2 class="mt-5 mb-3">Partners</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($partners as $partner)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($partner->getFirstMediaUrl("images"))
                        <img src="{{ $partner->getFirstMediaUrl("images") }}" class="card-img-top" alt="{{ $partner->name }}" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $partner->name }}</h5>
                            <p class="card-text">{{ $partner->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p class="text-center">No partners found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
