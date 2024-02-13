@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        @if($project->getFirstMediaUrl("images"))
                            <td><img style="width: 60px" src="{{$project->getFirstMediaUrl("images")}}" alt=""></td>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text">Budget: ${{ $project->budget }}</p>
                            <p class="card-text">user: {{ $project->user_id }}</p>
                            <p class="card-text">Partner: {{ $project->partner_id }}</p>

                            <form action="{{ route('projects.apply', $project->id) }}" method="post">
                            @csrf
                                <button type="submit" class="btn btn-success">Apply</button>
                            </form>

                            @if($project->user_id == auth()->id())
                                <form action="{{ route('projects.leave', $project->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-warning">Leave</button>
                                </form>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
