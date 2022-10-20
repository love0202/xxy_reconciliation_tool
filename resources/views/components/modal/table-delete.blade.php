<!-- 验证弹窗 model-check-{{ $id }} -->
<div class="modal fade" id="model-check-{{ $id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-check-{{ $id }}-label">删除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="bi bi-exclamation-circle fs-3 text-warning" id="model-check-{{ $id }}-bi"></i>
                    <span class="ms-1" id="model-check-{{ $id }}-message">选择数据不能为空？</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="model-check-{{ $id }}-confirm"
                        data-bs-dismiss="modal">确认
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 执行弹窗 model-execute-{{ $id }} -->
<div class="modal fade" id="model-execute-{{ $id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-execute-{{ $id }}-label">删除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="bi bi-exclamation-circle fs-3 text-warning" id="model-execute-{{ $id }}-bi"></i>
                    <span class="ms-1" id="model-execute-{{ $id }}-message">确认删除选择数据？</span>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary text-white" id="model-execute-{{ $id }}-confirm">确认</button>
                <button type="button" class="btn btn-secondary" id="model-execute-{{ $id }}-cancel"
                        data-bs-dismiss="modal">取消
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    {{--  验证  --}}
    $("#{{ $id }}").click(function () {
        var idArr = [];
        $(".yxx-table-check:checkbox:checked").each(function () {
            idArr.push($(this).val());
        });
        if (idArr.length == 0) {
            $("#model-check-{{ $id }}-message").html("选择数据不能为空");
            $("#model-check-{{ $id }}").modal("show");
            return false;
        } else {
            $("#model-execute-{{ $id }}-confirm").attr("disabled", false);
            $("#model-execute-{{ $id }}-message").html("确认删除选择数据？");
            $("#model-execute-{{ $id }}").modal("show");
        }
    })
    $("#model-check-{{ $id }}-confirm").click(function () {
        $("#model-check-{{ $id }}").modal("hide");
        if (window.reload)
            location.reload();
    })

    {{--  执行  --}}
    $("#model-execute-{{ $id }}-confirm").click(function () {
        $(this).attr("disabled", true);
        var idArr = [];
        $(".yxx-table-check:checkbox:checked").each(function () {
            idArr.push($(this).val());
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ $url }}",
            data: {
                "idArr": idArr,
                "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.success) {
                    $("#model-execute-{{ $id }}").modal("hide");
                    $("#model-check-{{ $id }}-message").html(data.message);
                    $("#model-check-{{ $id }}").modal("show");
                    window.reload = 1;
                } else {
                    $(this).attr("disabled", false);
                    $("#model-execute-{{ $id }}").modal("hide");
                    $("#model-check-{{ $id }}-message").html(data.message);
                    $("#model-check-{{ $id }}").modal("show");
                    window.reload = 0;
                }
            }
        });
    })
</script>
