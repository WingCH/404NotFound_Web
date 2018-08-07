function fireFormatter(value, row, index) {
    // var icon = row.id % 2 === 0 ? 'glyphicon-star' : 'glyphicon-star-empty';
    return '<span class="badge">' + value.length + '</span>';
}

function statusFormatter(value, row, index) {
	var label_type;
    switch (value) {
        case "Solved":
            label_type = "label-success";
            break;
        case "Processing":
            label_type = "label-warning";
            break;
        case "Rejected":
            label_type = "label-danger";
            break;
    }
    return ['<span class="label '+label_type+'">',
        value, '</span>'
    ].join('');
}

function viewFormatter(value, row, index) {
    //Route::get('{projectId}/{bugId}', 'ProjectBugListController@bugInfo')->name('bugInfo')->middleware('auth');
    return '<a href="' + location.href + "/" + value + '" class="btn btn-primary" role="button">' + "View" + '</a>';
}