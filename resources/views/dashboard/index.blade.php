@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form class="row g-3" action={{ route('dashboard.index') }}>
            <div class="col-auto">
                <h2>我的对账方案（{{ $list->total() }}）</h2>
            </div>
            <div class="col-auto">
                <input type="text" name="name" class="form-control" value="" placeholder="对账方案">
            </div>
            <div class="col-auto">
                <select class="form-select" name="sort">
                    <option value="">默认排序</option>
                    <option value="1">按照创建时间升序</option>
                    <option value="2">按照创建时间降序</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary text-white"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
    <div class="mb-3">
        <x-forms.input type="error"/>
        2022年对账方案统计
    </div>
@endsection
