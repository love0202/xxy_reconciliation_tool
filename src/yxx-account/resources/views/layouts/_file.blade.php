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
                    <p class="m-0"><span class="fw-bold">原文件名【导入数量】：</span>{{$f['originalName']}}【{{$f['importNum']}}】</p>
{{--                    <p><span class="fw-bold">原文件后缀【源文件类型】：</span>{{$f['originalExtension']}}【{{$f['originalMimeType']}}】</p>--}}
                    <p class="m-0"><span class="fw-bold">新文件路径：</span>{{$f['path']}}</p>
                @endforeach
            </td>
            <td>{{ $l->created_at }}</td>
            <td>
                删除
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $list->links('vendor.pagination.bootstrap-4') }}
