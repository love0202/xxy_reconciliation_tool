<button class="btn btn-danger text-light" data-bs-toggle="modal"
        data-bs-target="#model-{{ $id }}">
    <i class="{{ $biClass }}"></i>{{ $name }}
</button>
<!-- model-{{ $id }} -->
<div class="modal fade" id="model-{{ $id }}" tabindex="-1" aria-labelledby="model-{{ $id }}-label"
     aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="model-{{ $id }}-label">{{ $name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <i class="bi bi-exclamation-circle fs-3 text-warning" id="model-{{ $id }}-bi"></i>
                    <span class="ms-1" id="model-{{ $id }}-message">{{ $message }}</span>
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
