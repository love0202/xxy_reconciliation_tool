@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <button class="btn btn-danger text-light">
                    <i class="bi bi-trash me-1"></i>返回
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
            <th scope="col">（快递）单号</th>
            <th scope="col">（商户）商品详情</th>
            <th scope="col">文件ID</th>
            <th scope="col">创建时间</th>
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
                    {{ $l->express_number }}
                </th>
                <td>{{ $l->merchant_shop_info }}</td>
                <td>{{ $l->file_id }}</td>
                <td>{{ $l->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('script')
@endsection
