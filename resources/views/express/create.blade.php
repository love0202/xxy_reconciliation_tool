@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form method="POST" action="{{ route('express.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">快递类型</label>
                <div class="col-sm-10">
                    <select name="type" class="form-select">
                        <option value="" selected>请选择快递类型</option>
                        <option value="1">韵达</option>
                        <option value="2">邮政</option>
                    </select>
                    @error('type')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">上传文件</label>
                <div class="col-sm-10">
                    <input type="file" name="file" class="form-control">
                    @error('file')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">导入</button>
        </form>
    </div>
@endsection
