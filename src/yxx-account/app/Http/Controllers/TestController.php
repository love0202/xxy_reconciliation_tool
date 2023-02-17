<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function img()
    {
        // 修改指定图片的大小
        $img = Image::make('upload/test.jpg')->resize(200, 200);

        // 插入水印, 水印位置在原图片的右下角, 距离下边距 10 像素, 距离右边距 15 像素
        $img->insert('upload/yxx.jpg', 'bottom-right', 15, 10);

        // 将处理后的图片重新保存到其他路径
        $img->save('upload/test_avatar.jpg');

        /* 上面的逻辑可以通过链式表达式搞定 */
//        $img = Image::make('images/avatar.jpg')->resize(200, 200)->insert('images/new_avatar.jpg', 'bottom-right', 15, 10);
        dd('生成图片成功');
    }
}
