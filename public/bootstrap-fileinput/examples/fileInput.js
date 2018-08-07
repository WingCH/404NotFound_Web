    $(document).ready(function () {

        $("#kv-explorer").fileinput({
            theme: 'explorer-fa',
            uploadUrl: 'http://www.laravel.wingpage.net/upload/test',//upload個框  
            //https://github.com/kartik-v/bootstrap-fileinput/issues/325
            //拖放僅適用於AJAX模式，並且在配置為使用表單提交或使用本機HTML輸入功能時不起作用 - 因此在表單提交時不會將數據發送到服務器。
            overwriteInitial: false,//覆蓋 預載的文件(initialPreview)
            initialPreviewAsData: true,//初始預覽為數據
            showCaption: true,//3 files selected 呢d
            showPreview: true,


            fileActionSettings : {
            // Disable
                showUpload : false,//disable upload https://github.com/kartik-v/bootstrap-fileinput/issues/925
            },
        });

        $('#kv-explorer').on('fileloaded', function(event, file, previewId, index, reader) {
    console.log("fileloaded");
});

    });
