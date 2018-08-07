@extends('layouts.app')

@section('content')
<link href="../images/OwnProject/css/ownProject.css" rel="stylesheet"/>
<link href="../images/OwnProject/bootstrap-table/src/bootstrap-table.css" rel="stylesheet"/>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <table data-check-on-init="true" data-mobile-responsive="true" data-search="true" data-show-columns="true" data-toggle="table" data-url="http://www.404notfound.wingpage.net/myproject/{{ Auth::user()->id }}/getBugList" id="table">
                    <thead>
                        <tr>
                            <th data-align="center" data-field="fire" data-formatter="fireFormatter" data-sort-name="value" data-valign="middle" data-width="5%" >
                                <span aria-hidden="true" class="glyphicon glyphicon-fire">
                                </span>
                                Fire
                            </th>
                            <th data-align="center" data-field="name" data-valign="middle" data-width="50%">
                                bugs title
                            </th>
                            <th data-align="center" data-field="project.name" data-width="15%" data-valign="middle" data-sortable="true">
                                project
                            </th>
                            <th data-align="center" data-field="created_at" data-sortable="true" data-width="15%">
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
<script src="../images/OwnProject/bootstrap-table/src/bootstrap-table.js">
</script>
<script src="../images/OwnProject/bootstrap-table/src/extensions/mobile/bootstrap-table-mobile.js">
</script>
<script src="/images/OwnProject/ownProject.js" type="text/javascript">
</script>
@endsection
