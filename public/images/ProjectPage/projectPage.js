    $(".thumbnail").click(function(e) {
        var projectId = jQuery(this).attr("id");
        console.log(projectId);
        window.location.assign("http://www.404NotFound.wingpage.net/project/"+projectId);
    });
    $(document).ready(function() {
        $('#createProject').click(function(e) {
            $('#myModal').modal('show');
        });
        $('textarea.js-auto-size').textareaAutoSize();
        textarea = $('textarea.js-auto-size');
        $("#kv-explorer").fileinput({
            theme: 'explorer-fa',
            uploadUrl: 'http://www.404NotFound.wingpage.net/projectUpload', //upload個框  預設系post
            allowedFileExtensions: ['jpg','jpeg', 'png'],
            maxFileCount: 1,
            validateInitialCount: true,
            //https://github.com/kartik-v/bootstrap-fileinput/issues/325
            //拖放僅適用於AJAX模式，並且在配置為使用表單提交或使用本機HTML輸入功能時不起作用 - 因此在表單提交時不會將數據發送到服務器。
            showCaption: true, //3 files selected 呢d
            dropZoneEnabled: false,
            showPreview: true,
            showUpload: true,
            showRemove: false,
            uploadAsync: true, //逐張逐張放上去? 預設系true 逐張逐張放上去
            fileActionSettings: {
                showUpload: false, //disable upload https://github.com/kartik-v/bootstrap-fileinput/issues/925
            },
        });
        $('#kv-explorer').on('filebatchselected', function(event, files) {
            $('#kv-explorer').fileinput("upload");
        });
        $('#kv-explorer').on('fileuploaded', function(event, data, previewId, index) {
            var fileName = data.files[index].name;
            var fileUrl = data.response;
            addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', fileName);
            addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', fileUrl);
            addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', previewId);
        });
        //(在fileuploaded之後觸發) upload成功後會觸發(bar個個upload)
        $('#kv-explorer').on('filebatchuploadcomplete', function(event, files, extra) {
            // ---加埋先可以完美disabled到---- 
            var fileInput = document.getElementsByClassName('btn-file');
            fileInput[0].classList.add("disabled");
            var fileInput2 = document.getElementById("kv-explorer");
            fileInput2.setAttribute("disabled", "");
            //-----------------------------
        });
        //remove
        $('#kv-explorer').on('filesuccessremove', function(event, id) {
            var fileUrlOfInputSet = findInputNameIsFileUrl();
            fileUrlOfInputSet.forEach(function(item) {
                var inputArray = document.getElementsByName(item);
                if (inputArray[2].value == id) {
                    remove(item);
                }
            });
            // ---加埋先可以完美解除disabled到---- 
            var fileInput = document.getElementsByClassName('btn-file');
            fileInput[0].classList.remove("disabled");
            var fileInput2 = document.getElementById("kv-explorer");
            fileInput2.removeAttribute("disabled");
            //--------------------------------
        });
        // $('#projectFormSubmit').click(function(e) {
        //     return false; // avoid to execute the actual submit of the form.
        // });
    });

    function findInputNameIsFileUrl() {
        var fileUrlOfInputSet = new Set(); //save input name which ="fileUrl" Set特性不會重覆
        //搵input name有"fileUrl"的element
        var inputs, index;
        inputs = document.getElementsByTagName('input');
        for (index = 0; index < inputs.length; ++index) {
            if (inputs[index].name.indexOf("fileUrl") >= 0) {
                fileUrlOfInputSet.add(inputs[index].name);
            }
        }
        return fileUrlOfInputSet;
    }

    function addHidden(theForm, key, value) {
        // Create a hidden input element, and append it to the form:
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = key; // 'the key/name of the attribute/field that is sent to the server
        input.value = value;
        theForm.appendChild(input);
    }

    function remove(inputName) {
        var ele = document.getElementsByName(inputName);
        len = ele.length;
        parentNode = ele[0].parentNode;
        for (var i = 0; i < len; i++) {
            parentNode.removeChild(ele[0]);
        }
    }