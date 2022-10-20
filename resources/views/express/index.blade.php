@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <a href="{{ route('express.create') }}" class="btn btn-success text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>导入
                </a>
            </div>
        </div>
    </div>
    <table class="table table-hover mb-3">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col" class="w-25">快递单号【快递重量】</th>
            <th scope="col">创建时间</th>
            <th scope="col" class="w-50">商户重量【商户商品详情】</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $l)
            <tr>
                <th>
                    {{ $l->order_number }}【{{ $l->express_weight }}】
                </th>
                <td>{{ $l->created_at }}</td>
                <td>{{ $l->merchant_weight }}【{{ $l->merchant_shop_info }}】</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection
