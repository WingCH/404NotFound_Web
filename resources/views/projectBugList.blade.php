@extends('layouts.app')

@section('content')
{{-- css --}}
<link href="../images/ProjectBugListPage/css/ProjectBugListPage.css" rel="stylesheet"/>
<link href="../images/ProjectBugListPage/bootstrap-table/src/bootstrap-table.css" rel="stylesheet"/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>
                        {{ $projects->name }}
                    </h1>
                    <p>
                        @if ($projects->description === "")
                        description
                    @else
                        {!!nl2br($projects->description)!!}
                    
                    {{ Debugbar::info(nl2br($projects->description))}}
                    @endif
                    </p>
                    <p>
                        <a class="btn btn-danger btn-lg" href="{{ route('reportBug', $projects->id) }}" role="button">
                            Report bugs
                        </a>
                    </p>
                </div>
            </div>
            {{-- table --}}
            <div class="row">
                <div class="col-md-12">
                    <table data-check-on-init="true" data-mobile-responsive="true" data-search="true" data-show-columns="true" data-toggle="table" data-url="http://www.404notfound.wingpage.net/project/{{ $projects->id }}/getbugList" id="table">
                        <thead>
                            <tr>
                                <th data-align="center" data-field="fire" data-formatter="fireFormatter" data-valign="middle" data-width="5%"   data-sort-name="value">
                                    <span aria-hidden="true" class="glyphicon glyphicon-fire">
                                    </span>
                                    Fire
                                </th>
                                <th data-field="name" data-width="50%" data-align="center" data-valign="middle">
                                    bugs title
                                </th>
                                <th data-field="user.name" data-width="15%" data-align="center" data-valign="middle">
                                    reporter
                                </th>
                                <th data-field="created_at" data-sortable="true" data-width="15%" data-align="center" data-valign="middle">
                                    created time
                                </th>
                                <th data-align="center" data-field="status" data-formatter="statusFormatter" data-sortable="true" data-valign="middle" data-width="10%">
                                    Status
                                </th>
                                <th data-field="id" data-formatter="viewFormatter" data-width="5%">
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('js')
    <script src="../images/ProjectBugListPage/bootstrap-table/src/bootstrap-table.js">
    </script>
    <script src="../images/ProjectBugListPage/bootstrap-table/src/extensions/mobile/bootstrap-table-mobile.js">
    </script>
    <script src="/images/ProjectBugListPage/projectBugList.js" type="text/javascript">
    </script>
    @endsection
