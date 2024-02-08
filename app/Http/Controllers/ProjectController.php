<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Partner;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Project $project)
    {
        $projects = Project::with("user")->get();
        $userstatistic = User::count();
        $projectstatistic = Project::count();
        $partnerstatistic = Partner::count();
        return view("Project.index", compact("projects", "userstatistic", "projectstatistic", "partnerstatistic"));
    }

    public function create()
    {
        return view("Project.create");
    }

    public function store(ProjectRequest $projectRequest)
    {
        $userId = Auth::id();
        $data = $projectRequest->all();
        $data['user_id'] = $userId;



        $project = Project::create($data);


        if (request()->hasFile('project_img')) {
            $project->addMediaFromRequest('project_img')->toMediaCollection('images');
        }

        return redirect()->route("project.index");
    }

    public function edit(Project $project)
    {
        return view("Project.edit", compact("project"));
    }

    public function update(Project $project, ProjectRequest $projectRequest)
    {
        $project->update($projectRequest->all());
        return redirect()->route("project.index");
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("project.index");
    }
}
