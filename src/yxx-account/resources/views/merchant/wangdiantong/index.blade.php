@extends('layouts.app')

@section('content')
    <table class="table table-hover mb-3">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col">（快递）单号</th>
            <th scope="col">（快递）重量</th>
            <th scope="col">文件ID</th>
            <th scope="col">创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $l)
            <tr>
                <th scope="row">
                    {{ $l->express_number }}
                </th>
                <td>{{ $l->express_weight }}</td>
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
