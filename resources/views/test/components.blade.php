@extends('layouts.app-test')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <button class="btn btn-outline-primary btn-sm table-export">
                    <i class="bi bi-trash me-1"></i>导出
                </button>
            </div>
        </div>
    </div>
@endsection


<?php
$id = 'table-export';
$time = time();
$totalCount = 200;
$url = '';
?>
@section('script')
    <x-modal.tips id="{{ $id }}" title="信息提示"/>
    <x-modal.loading id="{{ $id }}" title=""/>
    <script>
        {{--  验证  --}}
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
                    $(this).attr("disabled", true);
                }, 3000);
            }
            window.location.href = "";
        })

        {{--  验证  --}}
        function getExportStatus() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ $url }}",
                data: {
                    "export_status_time": "{{ $time }}",
                    "count": parseInt("{{ $totalCount }}"),
                },
                success: function (data) {
                    if (data.success) {
                        var export_status1 = data.export_status;
                        if (export_status1 == 1) {
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
            $(".{{ $id }}").attr("disabled",false);
            $("#model-loading-{{ $id }}").modal("hide");
        }
    </script>
@endsection
