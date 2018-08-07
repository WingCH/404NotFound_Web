<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

use App\Http\Requests;
use App\Project as ProjectEloquent;
use App\Bug as BugEloquent;
use Illuminate\Support\Facades\Redirect;

class OwnProjectController extends Controller
{
    public function index()
    {
        return view('ownProject');
    }

    public function bugInfo($bugId)
    {//連接番bugInfo本身個條link
        $projectId = BugEloquent::find($bugId);
        return Redirect::action('ProjectBugListController@bugInfo', array('projectId' => $projectId, 'bugId' => $bugId));
    }

    public function getBug($userId)
    {
        $projects = BugEloquent::with('user','fire','project')->get();
        Debugbar::info($projects->toArray());

        foreach ($projects as $key=>$project) {
            if ($project->project->user_id!=$userId) {
                unset($projects[$key]);//$key = index
            }
        }
        
        foreach ($projects as $project) {
            $fireCount = $project->fire->count();
            unset($project->fire);//fire d data
            $project->fire = $fireCount;//將bug數量放入"$project->bug"
        }
        return $projects->toJson();
    }




}
