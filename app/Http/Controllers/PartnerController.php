<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Partner;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //

    public function index(Partner $partner)
    {
        $partners = $partner::all();
        $userstatistic = User::count();
        $projectstatistic = Project::count();
        $partnerstatistic = Partner::count();
        return view("partner.index",compact("partners", "userstatistic" , "projectstatistic", "partnerstatistic"));
    }


    public function create()
    {
        return view("Partner.create");
    }

    public function store(Request $request)
    {
        $partner = Partner::create($request->all());

        if ($request->hasFile('image')) {
            $partner->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route("partner.index");
    }

    public function edit(Project $project)
    {
        return view("Projects.edit" , compact("project"));
    }

    public function update(Partner $partner , Request $request)
    {
        $partner->update($request->all());
        return redirect()->route("partner.index");
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route("partner.index");
    }


}
