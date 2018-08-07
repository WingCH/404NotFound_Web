@extends('layouts.app')

@section('content')
<!-- Tocas UI：CSS 與元件 -->
<link href="/TocasUI/dist/tocas.css" media="all" rel="stylesheet" type="text/css"/>
<link href="/images/ProjectPage/css/ProjectPage.css" rel="stylesheet"/>
{{-- fileinput.css --}}
<link href="/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
{{-- fileinput theme --}}
<link href="/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row">
        @foreach ($projects as $project)
        {{ Debugbar::info($project->id) }}
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="thumbnail" id="{{ $project->id }}">
                <img alt="{{ $project->name }}" class="img-responsive img-rounded " src="{{ $project->image->url }}">
                    <div class="caption">
                        <div class="row">
                            <div class="col-xs-6 text-center line">
                                <i aria-hidden="true" class="fa fa-fire fa-lg center-vertical" id="icon">
                                </i>
                                <i class="fa-2x center-vertical" id="icon_text">
                                    {{  $project->fire->count() }}
                                </i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <i aria-hidden="true" class="fa fa-bar-chart fa-lg center-vertical" id="icon">
                                </i>
                                <i class="fa-2x center-vertical" id="icon_text">
                                    {{ $project->bug }}
                                </i>
                            </div>
                        </div>
                    </div>
                </img>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Project Form
                </h4>
            </div>
            <div class="modal-body" id="modal-body">
                <form action="{{ action('ProjectPageController@submit') }}" class="form-horizontal" enctype="multipart/form-data" id="projectFormID" method="POST" name="projectForm" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_Name">
                            Name
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="input_Name" name="name" placeholder="Project Name" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_Description">
                            Description
                        </label>
                        <div class="col-sm-10">
                            {{-- error 一開始三行 之後會自己縮番埋 --}}
                            <textarea autofocus="" class="multiple-lines js-auto-size" id="input_description" name="description" rows="3">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input_Name">
                            Wallpaper
                        </label>
                        <div class="col-sm-10">
                            <div class="file-loading">
                                <input id="kv-explorer" name="uploadFile[]" type="file">
                                </input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Close
                </button>
                <button class="btn btn-primary" form="projectFormID" id="projectFormSubmit" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- textarea autosize --}}
<script src="/textarea-autosize/dist/jquery.textarea_autosize.js" type="text/javascript">
</script>
{{-- own js --}}
<script src="/images/ProjectPage/projectPage.js" type="text/javascript">
</script>
{{-- fileinput --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js">
</script>
<script src="/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/js/fileinput.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/js/locales/fr.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/js/locales/es.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/themes/explorer-fa/theme.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/themes/fa/theme.js" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript">
</script>
{{--
<script src="/bootstrap-fileinput/myFileInput.js" type="text/javascript">
</script>
--}}
@endsection
