<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Partner;
use App\Models\Project;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //

    public function index(Partner $partner)
    {
        $partners = $partner::all();
        return view("",compact(""));
    }



    public function create()
    {
        return view("Partner.create");
    }

    public function store(Partner $partner)
    {
        $partner->create();
        return redirect()->route("partners.index");
    }

    public function edit(Project $project)
    {
        return view("Projects.edit" , compact("project"));
    }

    public function update(Partner $partner)
    {
        $partner->update();
        return redirect()->route("projects.index");
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route("");
    }


}
