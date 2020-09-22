<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','level','path','is_directory','is_show','ximg'];
    protected $appends=['parent_data'];

    protected $casts=[
        'is_directory'=>'boolean',
        'is_show'=>'boolean'
    ];

//    关联关系
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getProductsByCid($cid)
    {

    }

    /**
     * 监听创建
     * 自动生成level 和 path
     *
     */
    public static function boot(){
        parent::boot();
        static::creating(function(Category $category){
            if(is_null($category->parent_id)){
                $category->level=0;
                $category->path='-';
            }else{
                $category->level=$category->parent->level+1;
                $category->path=$category->parent->path.$category->parent_id.'-';
            }
        });

    }
    /**
     * 定义一个访问器，获取当前类目的所不是目录的有子id
     * @return ids 返回当前类目的所有子id
     * id 传入的当前类目
     */
    public function getChildrenIds($category){
        return $category->query()->where('path','like','%-'.$category->id.'-%')->where('is_directory',0)->pluck('id');
    }
    /**
     * 定义一个访问器，获取所有父级id
     * @return array 返回类目所有父级id
     */
    public function getParentIdsAttribute()
    {
        return array_filter(explode('-',trim($this->path,'-')));
    }


    /**
     * 定义一个访问器，返回所有父级类目所有数据，并按层级排序
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getParentDataAttribute()
    {
        return Category::query()->whereIn('id',$this->parent_ids)->orderBy('level')->get();
    }

    /**
     * 定义一个访问器，获取当前父级类目全名
     * @return mixed 返回当前类目父级类目全名
     */
    public function getParentFullNameAttribute()
    {
        return $this->parent_data->pluck('name')->push($this->name)->implode(' - ');
    }
}
