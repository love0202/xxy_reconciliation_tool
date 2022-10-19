<?php
//dd($id);
?>
<button class="btn btn-danger text-light" data-bs-toggle="modal"
        data-bs-target="#model-{{ $id }}">
    <i class="bi bi-trash me-1"></i>删除
</button>
<!-- model-{{ $id }} -->
<div class="modal fade" id="model-{{ $id }}" tabindex="-1" aria-labelledby="model-{{ $id }}-label"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-{{ $id }}-label">删除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="bi bi-exclamation-circle fs-3 text-warning" id="model-{{ $id }}-bi"></i>
                    <span class="ms-1" id="model-{{ $id }}-message">确认删除选择数据？</span>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary text-white" id="model-{{ $id }}-confirm">确认</button>
                <button type="button" class="btn btn-secondary" id="model-{{ $id }}-cancel"
                        data-bs-dismiss="modal">取消
                </button>
            </div>
        </div>
    </div>
</div>
