@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <a href="{{ route('weight.create') }}" class="btn btn-success text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>导入
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('weight.file') }}" class="btn btn-primary text-light">
                    <i class="bi bi-eye me-1"></i>查看重量文件
                </a>
            </div>
            <div class="col-auto">
                <button class="btn btn-danger text-light" id="batch-delete">
                    <i class="bi bi-trash me-1"></i>删除
                </button>
            </div>
        </div>
    </div>
    <table class="table table-hover mb-3">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col">
                <div class="form-check">
                    <input class="form-check-input yxx-table-check" type="checkbox" value="">
                </div>
            </th>
            <th scope="col">商品详情</th>
            <th scope="col">重量</th>
            <th scope="col">文件ID</th>
            <th scope="col">创建时间</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $l)
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input yxx-table-check" type="checkbox" value="{{ $l->id }}">
                    </div>
                </th>
                <th scope="row">
                    {{ $l->shop_info }}
                </th>
                <td>{{ $l->weight }}</td>
                <td>{{ $l->file_id }}</td>
                <td>{{ $l->created_at }}</td>
                <td>
                    <a type="button" class="btn btn-primary text-white">编辑</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('script')
    <x-modal.table-delete id="batch-delete" url="{{ route('weight.ajax_destroy') }}"/>
@endsection
