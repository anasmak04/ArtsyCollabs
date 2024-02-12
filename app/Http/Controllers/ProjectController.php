<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\updateProjectRequest;
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
        $users = User::all();

        return view("Project.index", compact("projects", "userstatistic", "projectstatistic", "partnerstatistic", "users"));
    }

    public function create()
    {
        $partners = Partner::all();
        $users = User::all();
        $projectstatistic = Project::count();
        $partnerstatistic = Partner::count();
        $userstatistic = User::count();

        return view("Project.create", compact("partners" , "users", "projectstatistic","userstatistic" , "partnerstatistic"));
    }

    public function store(ProjectRequest $projectRequest)
    {


        $data = $projectRequest->all();
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


    public function assign(Project $project, updateProjectRequest $request)
    {
        $validated = $request->validated();

        $project->user_id = $validated['user_id'];

        $project->save();

        return redirect()->route("project.index");
    }


}
