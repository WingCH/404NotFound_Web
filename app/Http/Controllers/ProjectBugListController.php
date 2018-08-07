<?php

namespace App\Http\Controllers;

use App\Bug as BugEloquent;
use App\Comment as CommentEloquent;
use App\Fire as FireEloquent;
use App\Image as ImageEloquent;
use App\Project as ProjectEloquent;
use Barryvdh\Debugbar\Facade as Debugbar;
use JavaScript;

class ProjectBugListController extends Controller
{
    public function index($projectId) //base on {projectId}

    {
        $projects = ProjectEloquent::find($projectId);
        return view('projectBugList', ['projects' => $projects]);

    }

    public function getBug($projectId)
    {
        $projects = BugEloquent::with('user', 'fire')->where('project_id', $projectId)->get();

        Debugbar::info($projects->toArray());

        return $projects->toJson();
    }

    public function reportBug($projectId) //base on {projectId}

    {
        $projects = ProjectEloquent::find($projectId);
        return view('reportBug', ['project' => $projects]);
    }

    public function bugInfo($projectId, $bugId) //base on {projectId}/{bugId}

    {
        $bug       = BugEloquent::with('project')->find($bugId);
        $comment   = CommentEloquent::with('user')->where('bug_id', $bugId)->get();
        $fire      = FireEloquent::where('bug_id', $bug->id)->get();
        Debugbar::info($bug->toArray());
        //select * from `bugs` where `bugs`.`id` = '7' limit 1
        Debugbar::info($comment->toArray());
        Debugbar::info($fire->toArray());

        $image_caption_downloadUrl_Array = array();
        $image_url_Array                 = array();

        foreach (unserialize($bug->image_id) as $image_id) {
            $image = ImageEloquent::find($image_id);
            array_push($image_caption_downloadUrl_Array, ["caption" => $image->name, "downloadUrl" => $image->url]);
            array_push($image_url_Array, $image->url);

        }

        JavaScript::put([
            'project_create_user_id'          => $bug->project->user_id,
            'image_caption_downloadUrl_Array' => $image_caption_downloadUrl_Array,
            'image_url_Array'                 => $image_url_Array,
        ]);
        return view('projectBug', ['bug' => $bug, 'comments' => $comment, 'fires' => $fire->toArray()]);
    }

}
