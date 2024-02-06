<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function index(Project $project)
    {
        $projects = $project::all();
        return view("Projects.index",compact("projects"));
    }



    public function create()
    {
        return view("Project.create");
    }

    public function store(Project $project , ProjectRequest $projectRequest)
    {
        $project->create($projectRequest->all());
        return redirect()->route("projects.index");
    }

    public function edit(Project $project)
    {
        return view("Projects.edit" , compact("project"));
    }

    public function update(Project $project , ProjectRequest $projectRequest)
    {
        $project->update($projectRequest->all());
        return redirect()->route("projects.index");
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("projects.index");
    }


}
