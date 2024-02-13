<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Partner;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectApplicationController extends Controller
{


    public function index()
    {
        $userstatistic = User::count();
        $projectstatistic = Project::count();
        $partnerstatistic = Partner::count();
        $applications = Application::where("approved", 0)->get();
        return view("Project.applications", compact("userstatistic","applications" ,"projectstatistic", "partnerstatistic"));
    }


    public function store(Request $request, $projectId)
    {

        $application = new Application();
        $application->project_id = $projectId;
        $application->user_id = auth()->id();
        $application->approved = false;
        $application->save();
        return redirect()->route("home");
    }


    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'approved' => 'required|boolean',
        ]);

        $application->approved = $validatedData['approved'];
        $application->save();

        if ($application->approved) {
            $project = $application->project;

            if (is_null($project->user_id)) {
                $project->user_id = $application->user_id;
                $project->save();
            }
        }



        return redirect()->route("applications.index")->with('success', 'Application status updated successfully.');
    }




    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route("applications.index");
    }




}
