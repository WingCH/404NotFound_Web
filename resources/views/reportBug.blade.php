@extends('layouts.app')

@section('content')
<link href="/images/ReportBugPage/css/reportBugPage.css" rel="stylesheet"/>
{{-- fileinput.css --}}
<link href="/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
{{-- fileinput theme --}}
<link href="/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
{{-- bootstrap-select --}}
{{-- <link href="/bootstrap-select-1.12.4/dist/css/bootstrap-select.css" media="all" rel="stylesheet" type="text/css"/> --}}
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Report Bugs form
                </div>
                <div class="panel-body">
                    {{-- {{ $projectId }} --}}
                    <form action="{{ action('ReportBugController@submit') }}" class="form-horizontal" enctype="multipart/form-data" id="bugFormID" method="POST" name="projectForm" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input name="project_id" type="hidden" value="{{ $project->id }}">
                            </input>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Name">
                                Base on
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" id="input_Name" name="name" placeholder="Project Name" readonly="" required="" type="text" value="{{ $project->name}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Name">
                                Bugs title
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" id="input_Name" name="name" required="" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_type">
                                Type
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control selectpicker" id="input_type" name="type">
                                    <option>
                                        UI
                                    </option>
                                    <option>
                                        UX
                                    </option>
                                    <option>
                                        Function
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Description">
                                Description
                            </label>
                            <div class="col-sm-10">
                                {{-- error 一開始三行 之後會自己縮番埋 --}}
                                <textarea autofocus="" class="multiple-lines js-auto-size" id="input_description" name="description" required="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Description">
                                Steps
                            </label>
                            <div class="col-sm-10">
                                {{-- error 一開始三行 之後會自己縮番埋 --}}
                                <textarea autofocus="" class="multiple-lines js-auto-size" id="input_description" name="step" required="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Name">
                                File
                            </label>
                            <div class="col-sm-10">
                                <div class="file-loading">
                                    <input id="kv-explorer" multiple="" name="uploadFile[]" type="file">
                                    </input>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="text-right">
                        <button class="btn btn-danger" form="bugFormID" id="bugFormSubmit" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- bootstrap-select --}}
{{-- <script src="/bootstrap-select-1.12.4/dist/js/bootstrap-select.min.js" type="text/javascript">
</script>
<script src="/bootstrap-select-1.12.4/dist/js/i18n/defaults-en_US.js" type="text/javascript">
</script> --}}
{{-- textarea autosize --}}
<script src="/textarea-autosize/dist/jquery.textarea_autosize.js" type="text/javascript">
</script>
{{-- fileinput --}}
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
{{-- own js --}}
<script src="/images/ReportBugPage/reportBug.js" type="text/javascript">
</script>
@endsection
