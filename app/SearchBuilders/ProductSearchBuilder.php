<?php
namespace App\SearchBuilders;

class ProductSearchBuilder{
//    初始化查询
    protected $params=[
        'index'=>'products',//索引名称,即表名
        'type'=>'_doc',//类型文档，即表数据
        'body'=>[//主体
            'from'=>0,//开始页码
            'size'=>16,//页面大小
            'query'=>[//条件
                'bool'=>[//bool条件
                    'filter'=>[],//必须为真，不计入权重
                    'must'=>[],//必须为真，计入权重
                ],
            ],
        ],
    ];
//    分页查询 $page页码，$size页面大小
    public function pagination($page,$size)
    {
        $this->params['body']['from']=($page-1)*$size;
        $this->params['body']['size']=$size;
        return $this;
    }

//    查询上架的商品
    public function onSale()
    {
        $this->params['body']['query']['bool']['filter'][]=['term'=>['on_sale'=>true]];//term词项查询，查询字段确定值
        return $this;
    }

//    关键词查询
    public function keyword($keyword)
    {
//        数组
        $keyword=is_array($keyword)?$keyword:[$keyword];
        foreach($keyword as $k){
            $this->params['body']['query']['bool']['must'][]=[//必须匹配
                'multi_match'=>[//权重匹配查询
                    'query'=>$k,//条件参数
                    'fields'=>[//匹配字段
                        'title^3',//^后面跟的数字越大权重越高
                        'long_title^2',
                        'description',
                        'category^2',
                        'skus_title',
                        'skus_description',
                        'propties_value'

                    ],
                ],
            ];
        }
        return $this;
    }

//    分类查询
    public function category($category)
    {
//        如果是目录用prefix查询，相当于sql 的like
        if($category->is_directory){
            $this->params['body']['query']['bool']['filter'][]=[//这里不需要权重放到filter
                'prefix'=>['category_path'=>$category->path.$category->id.'-']
            ];
        }else{
//        如果不是目录，直接使用term精确查找
            $this->params['body']['query']['bool']['filter'][]=[
                'term'=>['category_id'=>$category->id]
            ];
        }
    }

//    排序 $field 排序字段 $direction 升降序
    public function orderBy($field,$direction)
    {
        if(!isset($this->params['body']['sort'])){
            $this->params['body']['sort']=[];
        }
        return $this->params['body']['sort'][]=[$field=>$direction];
    }

//    根据属性查询 $type是filter是正常查询，如果是should就是需要加入'minimum_should_match'参数至少匹配should里面的个数
    public function proptiesFilter($name,$value,$type='filter')
    {
        $this->params['body']['query']['bool'][$type][]=[
            'nested'=>[
                'path'=>'propties',
                'query'=>[
                    ['term'=>['propties.name'=>$name]],
                    ['term'=>['propties.value'=>$value]],
                ]
            ],
        ];
        return $this;
    }
//    设置minimum_should_match参数 $count 匹配的个数
    public function minShouldMatch($count)
    {
        $this->params['body']['query']['bool']['minimum_should_match']=(int)$count;
        return $this;
    }
//    分面聚合查询
    public function aggregatePropties()
    {
        $this->params['body']['aggs']=[ //aggs聚合查询
            'proptiess'=>[//最外层聚合字段名称
                'nested'=>[//复合对象
                    'path'=>'propties'//对应索引中的数据字段名称
                ],
                'aggs'=>[//第二层聚合查询
                    'name'=>[//第二层聚合字段名称
                        'terms'=>[//聚合
                            'field'=>'propties.name'//聚合字段
                        ],
                        'aggs'=>[
                            'value'=>[
                                'terms'=>[
                                    'field'=>'propties.value'
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $this;
    }
//    返回查询的所有参数
    public function getParams()
    {
        return $this->params;
    }
}
