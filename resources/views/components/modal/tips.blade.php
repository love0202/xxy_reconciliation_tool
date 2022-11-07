<!-- 提示弹窗 model-tips-{{ $id }} -->
<div class="modal fade" id="model-tips-{{ $id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-tips-{{ $id }}-label">
                    {{ $title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="bi bi-exclamation-circle fs-3 text-warning" id="model-tips-{{ $id }}-bi"></i>
                    <span class="ms-1" id="model-tips-{{ $id }}-message">message</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="model-tips-{{ $id }}-confirm"
                        data-bs-dismiss="modal">确认
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    {{--  提示弹窗 model-check-{{ $id }}-confirm  --}}
    $("#model-check-{{ $id }}-confirm").click(function () {
        $("#model-check-{{ $id }}").modal("hide");
        if (window.reload)
            location.reload();
    })
</script>
