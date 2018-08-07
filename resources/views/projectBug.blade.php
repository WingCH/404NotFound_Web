@extends('layouts.app')

@section('content')
{{-- fileinput.css --}}
<link href="/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
{{-- fileinput theme --}}
<link href="/bootstrap-fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
<!-- Tocas UI：CSS 與元件 -->
<link href="/TocasUI/dist/tocas.css" media="all" rel="stylesheet" type="text/css"/>
<link href="/images/ProjectBug/css/projectBug.css" rel="stylesheet"/>
{{ Debugbar::info($bug->toJson()) }}
<div class="container">
    <input id="bug_id" name="bug_id" type="hidden" value="{{ $bug->id }}"/>
    <input id="project_id" name="project_id" type="hidden" value="{{ $bug->project_id }}"/>
    @if(!Auth::guest())
    <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}"/>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10 col-md-offset-1">
                        <h1>
                            {{ $bug -> name }}
                            <small>
                                {{ $bug -> project -> name }} issue
                            </small>
                        </h1>
                    </div>
                    <div class="col-sm-1">
                        @if(!Auth::guest())
                    {{ Debugbar::info("if()") }}
                        @forelse($fires as $fire)
                        {{ Debugbar::info("forelse") }}
                            @if($fire['user_id']==Auth::user()->id)
                        <button class="btn btn-lg pull-right" disabled="disabled" id="fireButton" type="button">
                            @break                               
                            @endif
                            @if($fire==end($fires))
                                {{ Debugbar::info("系最後一個啦") }}
                            <button class="btn btn-lg pull-right" id="fireButton" type="button">
                                @endif
                        @empty
                            {{ Debugbar::info("empty") }}
                                <button class="btn btn-lg pull-right" id="fireButton" type="button">
                                    @endforelse
                    @else
                        {{ Debugbar::info("else") }}
                                    <button class="btn btn-lg pull-right" disabled="disabled" id="fireButton" type="button">
                                        @endif
                                        <span aria-hidden="true" class="glyphicon glyphicon-fire lg" style="color:#990000">
                                        </span>
                                        <span class="badge" id="fireSpan">
                                            {{ count($fires) }}
                                        </span>
                                    </button>
                                </button>
                            </button>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Type
                        </label>
                        <div class="col-sm-10">
                            <p class="form-control-static">
                                {{ $bug -> type }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Description
                        </label>
                        <div class="col-sm-10">
                            <p class="form-control-static">
                                {!!nl2br($bug -> description)!!}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Status
                        </label>
                        <div class="col-sm-10">
                            @if (!Auth::guest())
                                @if ($bug->project->user_id == Auth::user()->id)
                            <div class="ts form">
                                <div class="field">
                                    <select form="statusForm" id="status" name="status" onchange="statusOnChange()">

                                        <option {{$bug->status==="Solved"  ? 'selected' : '' }}>
                                                Solved
                                        </option>
                                        <option {{$bug->status==="Processing"  ? 'selected' : '' }}>
                                                Processing
                                        </option>
                                        <option {{$bug->status==="Rejected"  ? 'selected' : '' }}>
                                                Rejected
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @else
                            <p class="form-control-static">
                                {{ $bug -> status }}
                            </p>
                            @endif
                            @else
                            <p class="form-control-static">
                                {{ $bug -> status }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Steps
                        </label>
                        <div class="col-sm-10">
                            <p class="form-control-static">
                                {!!nl2br($bug -> step)!!}
                            </p>
                        </div>
                    </div>
                </form>
                <div class="ts speeches" id="commentBox">
                    <div class="ts horizontal divider">
                        Comment
                    </div>
                    @if ($comments->count()==0)
                    <div class="right speech">
                        <div class="content">
                            <div class="author">
                                Developer
                            </div>
                            <div class="text">
                                Weclome comment in here.
                            </div>
                        </div>
                    </div>
                    <div class="left speech">
                        <div class="content">
                            <div class="author">
                                Yami Odymel
                            </div>
                            <div class="text">
                                嗨！早安。
                            </div>
                        </div>
                    </div>
                    @else
                    @foreach ($comments as $comment)
                    {{-- 如果系個project既創立人留言會顯示在右邊 --}}
                    <div class="{{ $bug->project->user_id === $comment->user_id ? 'right' : 'left' }} speech">
                        <div class="content">
                            <div class="author">
                                {{ $comment->user->name }}
                            </div>
                            <div class="text">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        File
                    </div>
                    <div class="panel-body">
                        <div class="file-loading">
                            <input id="input-ke-2" multiple="" name="input-ke-2[]" type="file">
                            </input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (!Auth::guest())
            <div class="ts horizontal divider">
                Write down your Comment
            </div>
            <form action="" class="form-horizontal" enctype="multipart/form-data" id="bugFormID" method="POST" name="projectForm" role="form">
                {{ csrf_field() }}
                <input name="projectId" type="hidden" value="{{ $bug->project_id }}">
                </input>
                <input name="bug_Id" type="hidden" value="{{ $bug->id }}">
                </input>
                <textarea class="multiple-lines js-auto-size" id="input_description" name="comment" required="" rows="3" tabindex="-1"></textarea>
                <button class="btn btn-danger pull-right" id="bugFormSubmit" name="bugFormSubmit" type="submit">
                    Submit
                </button>
            </form>
            @else
            <div class="ts horizontal divider">
                Please Login to comment
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- textarea autosize --}}
<script src="/textarea-autosize/dist/jquery.textarea_autosize.js" type="text/javascript">
</script>
{{-- fileinput --}}
<script src="/bootstrap-fileinput/js/fileinput.js" type="text/javascript">
</script>
<script src="/bootstrap-fileinput/themes/explorer/theme.js" type="text/javascript">
</script>
<!-- Tocas JS：模塊與 JavaScript 函式 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.js">
</script>
{{-- own js --}}
<script src="/images/ProjectBug/projectBug.js" type="text/javascript">
</script>
@endsection
