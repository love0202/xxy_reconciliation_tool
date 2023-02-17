@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form class="row g-3" action="{{ route('express.index') }}">
            <div class="col-auto">
                <input type="text" name="express_number" class="form-control"
                       value="{{ isset($input['express_number']) ? $input['express_number'] : '' }}"
                       placeholder="（快递）单号">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary text-white"><i class="bi bi-search"></i></button>
            </div>
        </form>
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
                    {{ $l->express_number }}【{{ $l->express_weight }}】
                </th>
                <td>{{ $l->created_at }}</td>
                <td>{{ $l->merchant_weight }}【{{ $l->merchant_shop_info }}】</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection
