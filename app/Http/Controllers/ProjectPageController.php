<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Http\Requests;
use App\Project as ProjectEloquent;
use App\Image as ImageEloquent;
use App\Http\Requests\ProjectRequest;
use File;
use Storage;
use Auth;
use View;

class ProjectPageController extends Controller
{
    
    public function index()
    {
        $projects = ProjectEloquent::with('image','bug','fire')->get();

        foreach ($projects as $project) {
            $bugCount = $project->bug->count();
            unset($project->bug);//先刪除bug d data
            $project->bug = $bugCount;//將bug數量放入"$project->bug"
        }

        return view('project', ['projects' => $projects]);
    }

    public function upload(Request $request)
    {
        $files     = $request->file('uploadFile');
        $filesLink = array();

        if ($files[0] != null) {
            foreach ($files as $file) {
                // Get the orginal filname or create the filename of your choice
                $filename = $file->getClientOriginalName();
                Storage::disk('gcs')->put($filename, File::get($file));
                $url = Storage::disk('gcs')->url($filename); //url
                array_push($filesLink, $url);
            }
        }
        Debugbar::info($filesLink);

        return $filesLink;
    }

    public function submit(Request $request)
    {
        //php artisan make:request ProjectRequest
        Debugbar::info($request->input('name'));
        Debugbar::info($request->input('description'));
        Debugbar::info($request->input('fileUrl'));

        //淨系會run一次 因為project個到淨系upload一次 但有時會[2][0] xxx 所以要loop
        foreach ($request->input('fileUrl') as $file) {
            $Image          = new ImageEloquent;
            $Image->url     = $file[1]; //第[1]格系裝url
            $Image->user_id = Auth::user()->id;
            $Image->save();
        };

        $project              = new ProjectEloquent;
        $project->name        = $request->input('name');
        $project->description = $request->input('description');
        $project->image_id    = $Image->id;
        $project->user_id     = Auth::user()->id;
        $project->save();

        return redirect()->action('ProjectPageController@index');

    }

}
