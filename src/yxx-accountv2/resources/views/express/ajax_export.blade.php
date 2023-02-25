<?php
$id = 'table-export';
$time = time();
$totalCount = 70000;
?>
<x-modal.tips id="{{ $id }}" title="信息提示"/>
<x-modal.loading id="{{ $id }}" title=""/>
<script>
    {{--  按钮点击事件  --}}
    $(".{{ $id }}").click(function () {
        var total = parseInt("{{ $totalCount }}");
        if (total > 100000) {
            $("#model-tips-{{ $id }}-message").html("导出数据最多支持10万条。");
            $("#model-tips-{{ $id }}-bi").attr("class", "bi bi-exclamation-circle fs-3 text-warning");
            $("#model-tips-{{ $id }}").modal("show");
            return false;
        }
        // 防止重复点击
        $(this).attr("disabled", true);

        if (total > 100) {
            $("#model-loading-{{ $id }}-message").html("正在导出文件，请不要关闭浏览器...");
            $("#model-loading-{{ $id }}").modal("show");
            setTimeout(getExportStatus, 3000);
        } else {
            setTimeout(function () {
                $(this).attr("disabled", false);
            }, 3000);
        }
        window.location.href = "{{ route('express.export_file',["export_time"=>$time]) }}";
    })

    {{--  导出状态  --}}
    function getExportStatus() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('public.ajax_export_status') }}",
            data: {
                "export_time": "{{ $time }}",
                "count": parseInt("{{ $totalCount }}"),
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.success) {
                    if (data.status == 1) {
                        closeLoading();
                    } else {
                        setTimeout(getExportStatus, 3000);
                    }
                } else {
                    return false;
                }
            }
        });
    }

    {{--  关闭提示Loading页面  --}}
    function closeLoading() {
        $(".{{ $id }}").attr("disabled", false);
        $("#model-loading-{{ $id }}").modal("hide");
    }
</script>
