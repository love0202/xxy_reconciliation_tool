@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form method="POST" action="{{ route('project.store') }}">
            @csrf
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">对账方案：</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="请输入对账方案">
                </div>
            </div>
            <button type="submit" class="btn btn-primary text-white">进入对账方案</button>
        </form>
    </div>
@endsection
