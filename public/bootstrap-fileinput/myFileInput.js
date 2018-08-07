    // $(document).ready(function() {
    //     $("#kv-explorer").fileinput({
    //         theme: 'explorer-fa',
    //         uploadUrl: 'http://www.404NotFound.wingpage.net/projectUpload', //upload個框  預設系post
    //         allowedFileExtensions: ['jpg', 'png'],
    //         maxFileCount: 1,
    //         //https://github.com/kartik-v/bootstrap-fileinput/issues/325
    //         //拖放僅適用於AJAX模式，並且在配置為使用表單提交或使用本機HTML輸入功能時不起作用 - 因此在表單提交時不會將數據發送到服務器。
    //         showCaption: true, //3 files selected 呢d
    //         showPreview: true,
    //         showUpload: true,
    //         showRemove: false,
    //         uploadAsync: true, //逐張逐張放上去? 預設系true 逐張逐張放上去
    //         fileActionSettings: {
    //             showUpload: true, //disable upload https://github.com/kartik-v/bootstrap-fileinput/issues/925
    //         },
    //     });
    //     $('#kv-explorer').on('fileuploaded', function(event, data, previewId, index) {
    //         var fileName = data.files[index].name;
    //         var fileUrl = data.response;
    //         addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', fileName);
    //         addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', fileUrl);
    //         addHidden(document.forms.projectForm, 'fileUrl[' + index + '][]', previewId);
    //     });
    //     //remove
    //     $('#kv-explorer').on('filesuccessremove', function(event, id) {
    //         var fileUrlOfInputSet = findInputNameIsFileUrl();
    //         fileUrlOfInputSet.forEach(function(item) {
    //             var inputArray = document.getElementsByName(item);
    //             if (inputArray[2].value == id) {
    //                 remove(item);
    //             }
    //         });
    //     });
    //      $('#projectFormSubmit').click(function(e){
    //         console.log("projectFormSubmit");
    //      });
    // });

    // function findInputNameIsFileUrl() {
    //     var fileUrlOfInputSet = new Set(); //save input name which ="fileUrl" Set特性不會重覆
    //     //搵input name有"fileUrl"的element
    //     var inputs, index;
    //     inputs = document.getElementsByTagName('input');
    //     for (index = 0; index < inputs.length; ++index) {
    //         if (inputs[index].name.indexOf("fileUrl") >= 0) {
    //             fileUrlOfInputSet.add(inputs[index].name);
    //         }
    //     }
    //     return fileUrlOfInputSet;
    // }

    // function addHidden(theForm, key, value) {
    //     // Create a hidden input element, and append it to the form:
    //     var input = document.createElement('input');
    //     input.type = 'hidden';
    //     input.name = key; // 'the key/name of the attribute/field that is sent to the server
    //     input.value = value;
    //     theForm.appendChild(input);
    // }

    // function remove(inputName) {
    //     var ele = document.getElementsByName(inputName);
    //     len = ele.length;
    //     parentNode = ele[0].parentNode;
    //     for (var i = 0; i < len; i++) {
    //         parentNode.removeChild(ele[0]);
    //     }
    // }