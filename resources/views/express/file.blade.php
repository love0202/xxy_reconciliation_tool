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
                <button class="btn btn-danger text-light" id="table-delete">
                    <i class="bi bi-trash me-1"></i>删除
                </button>
            </div>
        </div>
    </div>
    <table class="table table-hover mb-3 text-break">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col">
                <div class="form-check">
                    <input class="form-check-input yxx-table-check-all" type="checkbox" value="">
                </div>
            </th>
            <th class="w-75" scope="col">文件详情</th>
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
                <td>
                    <?php $fileArr = json_decode($l->file_json, true);?>
                    @foreach ($fileArr as $f)
                        <p class="m-0"><span class="fw-bold">原文件名【导入数量】：</span>{{$f['originalName']}}【{{$f['importNum']}}】</p>
{{--                        <p><span class="fw-bold">原文件后缀【源文件类型】：</span>{{$f['originalExtension']}}【{{$f['originalMimeType']}}】</p>--}}
                        <p class="m-0"><span class="fw-bold">新文件路径：</span>{{$f['path']}}</p>
                    @endforeach
                </td>
                <td>{{ $l->created_at }}</td>
                <td>
                    <a href="{{ route('express.index',['file_id'=>$l->id]) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye me-1"></i>查看
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection

@section('script')
    <x-modal.table-delete id="table-delete" url="{{ route('express.ajax_destroy_file') }}"/>
@endsection
