@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form class="row g-3" action={{ route('project.index') }}>
            <div class="col-auto">
                <select class="form-select" name="year">
                    <option value="2022">2022年</option>
                    <option value="2021">2021年</option>
                    <option value="2020">2020年</option>
                </select>
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
            <div class="col-auto">
                <a href="{{ route('project.create') }}" class="btn btn-success text-light">
                    <i class="bi bi-plus-circle-dotted me-1"></i>创建对账方案
                </a>
            </div>
        </form>
    </div>
    <table class="table table-hover mb-3">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col">对账方案</th>
            <th scope="col">创建时间</th>
            <th scope="col">创建人</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $l)
            <tr>
                <th scope="row">
                    {{ $l->name }}
                </th>
                <td>{{ $l->created_at }}</td>
                <td>{{ $l->adminName }}</td>
                <td>
                    <a class="text-decoration-none" href="{{ route('project.enter',['id'=>$l->id]) }}">进入</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $list->links('vendor.pagination.bootstrap-4') }}
@endsection
