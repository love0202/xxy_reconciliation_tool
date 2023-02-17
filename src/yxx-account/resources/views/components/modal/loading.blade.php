<!-- 提示弹窗 model-loading-{{ $id }} -->
<div class="modal fade" id="model-loading-{{ $id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="ms-1" id="model-loading-{{ $id }}-message">message</span>
                </div>
            </div>
        </div>
    </div>
</div>
