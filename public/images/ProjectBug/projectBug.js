    $(document).ready(function() {
        console.log(image_caption_downloadUrl_Array); // bar
        console.log(image_url_Array);
        $("#input-ke-2").fileinput({
            theme: "explorer",
            uploadUrl: "",
            minFileCount: 2,
            maxFileCount: 5,
            overwriteInitial: false,
            showRemove: false,
            previewFileIcon: '<i class="fa fa-file"></i>',
            initialPreview: image_url_Array,
            initialPreviewShowDelete: false,
            initialPreviewAsData: true, // defaults markup  
            initialPreviewConfig: image_caption_downloadUrl_Array,
            preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
            previewFileIconSettings: { // configure your icon file extensions
                'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                'htm': '<i class="fa fa-file-code-o text-info"></i>',
                'txt': '<i class="fa fa-file-text-o text-info"></i>',
                'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
                'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
                // note for these file types below no extension determination logic 
                // has been configured (the keys itself will be used as extensions)
                'jpg': '<i class="fa fa-file-photo-o text-danger"></i>',
                'gif': '<i class="fa fa-file-photo-o text-muted"></i>',
                'png': '<i class="fa fa-file-photo-o text-primary " ></i>'
            },
            previewFileExtSettings: { // configure the logic for determining icon file extensions
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function(ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function(ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function(ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function(ext) {
                    return ext.match(/(htm|html)$/i);
                },
                'txt': function(ext) {
                    return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                },
                'mov': function(ext) {
                    return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                },
                'mp3': function(ext) {
                    return ext.match(/(mp3|wav)$/i);
                }
            },
            fileActionSettings: {
                showRemove: false,
                showDrag: false,
            },
        });
        //隱藏file input
        $(".file-caption-main").hide();
        //textarea
        $('textarea.js-auto-size').textareaAutoSize();
        textarea = $('textarea.js-auto-size');
        $(document).on('click', '.fireButton', function() {
            console.log("fireButton click");
        });
    });
    $("#bugFormID").submit(function(e) {
        var url = location.pathname + "/commentSubmit";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#bugFormID").serialize(), // serializes the form's elements.
            dataType: "json",
            success: function(data) {
                var head;
                if (data.id == project_create_user_id) {
                    head = '<div class="right speech">';
                } else {
                    head = '<div class="left speech">';
                }
                document.getElementById('commentBox').innerHTML += head + '<div class="content">\n' + '<div class="author">\n' + data.name + '</div>\n' + '<div class="text">\n' + data.content + '</div>\n' + '</div>\n' + '</div>\n';
                document.getElementById('input_description').value = "";
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $("#fireButton").click(function() {
        console.log("fireButton click");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "http://www.404NotFound.wingpage.net/updateFire",
            // dataType: "json",
            data: {
                project_id: $("#project_id").val(),
                bug_id: $("#bug_id").val(),
                user_id: $("#user_id").val()
            },
            success: function(data) {
                $('#fireSpan').text(data);
                $('#fireButton').prop('disabled', true);
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        });
    });

    function statusOnChange() {
        var status = $("#status").val();
        var bug_id = $("#bug_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "http://www.404NotFound.wingpage.net/updateStatus",
            // dataType: "json",
            data: {
                status: $("#status").val(),
                bug_id: $("#bug_id").val(),
            },
            success: function(data) {
                console.log("成功將status轉成: " + data);
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        });
    }