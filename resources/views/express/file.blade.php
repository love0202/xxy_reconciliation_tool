@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <div class="row g-3">
            <div class="col-auto">
                <a href="{{ route('express.create') }}" class="btn btn-success text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>导入
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('express.index') }}" class="btn btn-primary text-light">
                    <i class="bi bi-eye me-1"></i>查看
                </a>
            </div>
        </div>
    </div>
    <table class="table table-hover mb-3 text-break">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th class="w-75" scope="col">文件详情</th>
            <th scope="col">创建时间</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $l)
            <tr>
                <td>
                    <?php $fileArr = json_decode($l->file_json, true);?>
                    @foreach ($fileArr as $f)
                        <p><span class="fw-bold">原文件名【导入数量】：</span>{{$f['originalName']}}【{{$f['importNum']}}】</p>
                        <p><span class="fw-bold">原文件后缀【源文件类型】：</span>{{$f['originalExtension']}}【{{$f['originalMimeType']}}】</p>
                        <p><span class="fw-bold">新文件路径：</span>{{$f['path']}}</p>
                    @endforeach
                </td>
                <td>{{ $l->created_at }}</td>
                <td>
                    <a href="{{ route('express.index') }}" class="btn btn-primary text-light">
                        <i class="bi bi-eye me-1"></i>查看
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection
