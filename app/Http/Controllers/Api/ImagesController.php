<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    //图片上传
    public function store(ImageRequest $request,Image $image)
    {
        $file=$request->image;
        $type=$request->type;
        $user=$request->user();
//        获取后缀
        $ext=strtolower($file->getClientOriginalExtension())?:'png';
//        组合文件名称
        $file_name=$user->id.'_'.time().'_'.Str::random(10).'.'.$ext;
//        组合文件目录
        $dir='Uploads/'.$type.'/'.date('Ym/d',time());
//        组合物理路径
        $upload_dir=public_path().'/'.$dir;
        $file->move($upload_dir,$file_name);
        $image->type=$type;
        $image->user_id=$user->id;
        $image->path=config('app.url').'/'.$dir.'/'.$file_name;
        $image->save();
        return new ImageResource($image);

    }
}
