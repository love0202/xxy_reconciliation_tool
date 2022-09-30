@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form method="POST" action="{{ route('project.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">对账方案：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="请输入对账方案,例如：2022年09月对账">
                    @error('name')
                    <div class="alert alert-danger m-0 p-0"><i class="bi bi-exclamation-circle me-1" style="font-size: .875em;"></i><small>{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">进入对账方案</button>
        </form>
    </div>
@endsection
