@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <a href="{{ route('merchant.tianmao.create') }}" class="btn btn-success text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>导入
                </a>
            </div>
            <div class="col-auto">
                <button class="btn btn-danger text-light" id="table-delete">
                    <i class="bi bi-trash me-1"></i>删除
                </button>
            </div>
        </div>
    </div>
    @include('layouts._file')
@endsection

@section('script')
    <x-modal.table-delete id="table-delete" url="{{ route('merchant.tianmao.ajax_destroy') }}"/>
@endsection
