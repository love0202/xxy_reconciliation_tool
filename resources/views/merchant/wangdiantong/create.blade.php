@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form method="POST" action="{{ route('merchant.wangdiantong.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">上传文件</label>
                <div class="col-sm-10">
                    <input type="file" name="file" class="form-control">
                    @error('file')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                    <div class="yxx-input-desc mt-3">
                        <p class="m-0">文件说明：</p>
                        <p class="m-0">1. 请下载商户旺店通模板：<a href="{{ yxx_path_static('商户旺店通模板.xlsx','templates') }}">商户旺店通模板.xlsx</a>，根据模板中提示进行填写；</p>
                        <p class="m-0">2. 请填写，根据模板的提示填写必填项，填写完毕后将文档进行上传；</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">导入</button>
        </form>
    </div>
@endsection
