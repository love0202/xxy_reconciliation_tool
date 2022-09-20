@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <form class="row g-3" action="/">
            <div class="col-auto">
                <h2>我的对账方案（3）</h2>
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
    <table class="table table-hover">
        <thead style="background-color: #F5F5F5">
        <tr>
            <th scope="col">对账方案</th>
            <th scope="col">创建时间</th>
            <th scope="col">创建人</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                <a class="text-decoration-none" href="/">8月对账</a>
            </th>
            <td>2202-09-18</td>
            <td>admin</td>
            <td>
                <a class="text-decoration-none" href="/">进入</a>
            </td>
        </tr>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
@endsection
