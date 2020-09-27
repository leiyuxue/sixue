<?php

namespace App\Http\Controllers;

use App\Category;
use App\Console\Commands\Elasticsearch\Indices\ProjectIndex;
use App\OrderItemReviewImg;
use App\Product;
use App\SearchBuilders\ProductSearchBuilder;
use App\SeckillTime;
use App\Solider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesController extends Controller
{
    public function root()
    {

        $data=Category::query()->whereNull('parent_id')->where('is_directory',1)->where('is_show',1)->get();
        foreach($data as $d){
            $ids=Category::query()->where('path','like','%-'.$d->id.'-%')->where('is_directory',0)->pluck('id');
            $d['products']=Product::query()->whereIn('category_id',$ids)->where('on_sale',1)->get();
        }
//        查询所有幻灯片数据
        $soliders=Solider::query()->where('enable',1)->get();
//        闪购数据
        $time=date('H:i:s');
//        $seckills=SeckillTime::query()->whereDate('start_at','<=',$time)->whereDate('end_at','>=',$time)->with(['products'=>function($query){
//            $query->where('type',Product::TYPE_SECKILL)->where('on_sale',1);
//        }])->first();
        $seckills=SeckillTime::query()
            ->where('start_at','<=',$time)
            ->where('end_at','>=',$time)
            ->with(['products'=>function($query){
           $query->where('type',Product::TYPE_SECKILL)->where('on_sale',1);
       }])->first();
        return view('pages.root',['data'=>$data,'soliders'=>$soliders,'seckills'=>$seckills]);
    }

    public function abc(Request $request)
    {
                $data=$request->file;
                $oid=$request->oid;
//        获取后缀
        $extension=strtolower($data->getClientOriginalExtension());
//        上一级目录
        $folder='reviews';
        $folder_dir='uploads/'.$folder.'/'.date("Ym/d",time());
//        文件名称
        $file_name='100_'.time().'_'.Str::random(10).'.'.$extension;
//        全路径 uploads/reviews/2020/8/100_152412542_1223456789.jpg
        $data->move($folder_dir,$file_name);
        $orderImg=OrderItemReviewImg::create(['order_item_id'=>$oid,'url'=>config('app.url').'/'.$folder_dir.'/'.$file_name]);
        return $orderImg;
    }

    public function search(Request $request)
    {

//        $indices=[ProjectIndex::class];
//        dd($indices);

//        $arr=[];
//        $arr['body']['query']['bool']['filter'][]=[
//            'nested'=>[
//                'path'=>'propties',
//                'query'=>[
//                    ['term'=>['a'=>'a1']]
//                ],
//            ],
//        ];
//        $arr['body']['query']['bool']['filter'][]=[
//            'nested'=>[
//                'path'=>'propties',
//                'query'=>[
//                    ['term'=>['b'=>'b1']]
//                ],
//            ],
//        ];
//        $arr['body']['query']['bool']['must_not']=[['term'=>['id'=>1]]];
//        $arr1['body']['query']['bool']['must_not'][]=['term'=>['id'=>1]];
//        dd($arr1);
//        分页 默认第一页
        $page=$request->input('page',1);
        $perPage=16;
        $builder=(new ProductSearchBuilder())->onSale()->pagination($page,$perPage);

//        排序
        if($order=$request->input('order','')){
            preg_match('/^(.+)_(asc|desc)$/',$order,$m);
            if(in_array($m[1],['price','sold_count','id'])){
                $builder->orderBy($m[1],$m[2]);
            }
        }

//        关键词搜索
        if ($search = $request->input('keyword', '')) {
            $keywords = array_filter(explode(' ', $search));
            $builder->keyword($keywords);
        }

//        如果传递了分类，就加入分类搜索
        if($request->input('category_id') && $category=Category::find($request->input('category_id'))){
            $builder->category($category);
        }
        // 只有当用户有输入搜索词或者使用了类目筛选的时候才会做聚合
        if ($search || isset($category)) {
           $builder->aggregatePropties();
        }
//        如果传递了filters参数（查找属性）如：?filters=传输类型:DDR4|内存容量:32GB
//        定义一个已选择的属性数组
        $checkedPropties=[];
        if($filterString=$request->input('filters')){
            $filterArray=explode('|',$filterString);
            foreach($filterArray as $filter){
                list($name,$value)=explode(':',$filter);
//                把查询到的属性放到已选属性数组中
                $checkedPropties[$name]=$value;
                $builder->proptiesFilter($name,$value);
            }
        }
//        es查询
        $result=app('es')->search($builder->getParams());
//        dd($result);
//        如果在查询结果中属性在已选属性，和值是一个的，就过滤掉不显示，如果是一个，点击还是这些数据，没有意义，所以过滤掉
        $propties=[];
        if(isset($result['aggregations'])){
            $propties=collect($result['aggregations']['proptiess']['name']['buckets'])->map(function($item){
                return [
                    'key'=>$item['key'],
                    'values'=>collect($item['value']['buckets'])->pluck('key')->all(),
                ];
            })->filter(function($propty) use($checkedPropties){
//                过滤掉属性值只有一个值的和在已选属性数组中的属性
                return count($propty['values'])>1 && !isset($checkedPropties[$propty['key']]);
            });
        }

        $ids=collect($result['hits']['hits'])->pluck('_id')->all();
//        dd($ids);
//        whereIn查询出的结果会按照id升序查出所有数据，把$ids的顺序升序排列了，orderByRaw会按照$ids的顺序排序
        $products=Product::query()->byIds($ids)->get();
//        dd($products);
//        dd($propties);
        $paper=new LengthAwarePaginator($products,$result['hits']['total']['value'],$perPage,$page,[
            'path'=>route('search',false),
        ]);
//        dd($paper);
        return view('pages.search',[
            'products'=>$paper,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
             ],
            'category' =>$category??null,
            'propties'=>$propties,
            'checkPropties'=>$checkedPropties
        ]);
    }

}
