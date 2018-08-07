<?php

namespace App\Http\Controllers;

use App\Bug as Bugloquent;
use App\Image as ImageEloquent;
use Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
use File;
use Illuminate\Http\Request;
use Storage;

class ReportBugController extends Controller
{
    public function upload(Request $request)
    {
        $files     = $request->file('uploadFile');
        $filesLink = array();

        Debugbar::info(count($files));

        if ($files[0] != null) {
            foreach ($files as $file) {
                // Get the orginal filname or create the filename of your choice
                $filename = $file->getClientOriginalName();
                Storage::disk('gcs')->put($filename, File::get($file));
                $url = Storage::disk('gcs')->url($filename); //url
                array_push($filesLink, $url);
            }
        }
        return $filesLink;
    }

    public function submit(Request $request)
    {
        Debugbar::info($request->toArray());
        $urlArray = array();

        if (!empty($request->input('fileUrl'))) {
            foreach ($request->input('fileUrl') as $file) {
                $Image          = new ImageEloquent;
                $Image->name    = $file[0]; //第[10格系裝file name
                $Image->url     = $file[1]; //第[1]格系裝url
                $Image->user_id = Auth::user()->id;
                $Image->save();
                array_push($urlArray,$Image->id);
            };
        }

        $bug              = new Bugloquent;
        $bug->name        = $request->input('name');
        $bug->type        = $request->input('type');
        $bug->description = $request->input('description');
        $bug->step        = $request->input('step');
        $bug->image_id    = serialize($urlArray); //將array 序列化之後放入去
        $bug->project_id  = $request->input('project_id');
        $bug->user_id     = Auth::user()->id;
        $bug->save();

        return redirect()->action('ProjectBugListController@index', ['projectId' => $request->input('project_id')]);

    }
}
