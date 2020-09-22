<?php

use Illuminate\Database\Seeder;

class PhoneProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productData=[
            [
                'title'=>'小米10',
                'long_title'=>'小米10 双模5G',
                'description'=>'<p><img src="https://img.alicdn.com/imgextra/i3/704392951/TB25akyqsuYBuNkSmRyXXcA3pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB288x6y25TBuNjSspmXXaDRVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB2ck46y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2_OV3y1uSBuNjSsziXXbq8pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2F9KZiP7nBKNjSZLeXXbxCFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2XQ06y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB20Tl7y4SYBuNjSspjXXX73VXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2QygAqDdYBeNkSmLyXXXfnVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2C6S5qyCYBuNkHFCcXXcHtVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2J_pByYGYBuNjy0FoXXciBFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2520Ny29TBuNjy1zbXXXpepXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2ozkLyFmWBuNjSspdXXbugXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2S9IFiOAnBKNjSZFvXXaTKXXa_!!704392951.jpg" /></p><p><img alt="" src="https://gdp.alicdn.com/imgextra/i4/704392951/TB2KpHwfviSBuNkSnhJXXbDcpXa_!!704392951.jpg" /></p>',
                'img'=>'images/mi10.jpg',
                'price'=>'3799',
                'skus'=>[
                    ["title" => "8GB+128GB 国风雅灰", "description" => "8GB+128GB 国风雅灰", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 钛阴黑", "description" => "8GB+128GB 钛阴黑", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 冰海蓝", "description" => "8GB+128GB 冰海蓝", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 蜜桃金", "description" => "8GB+128GB 蜜桃金", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "8GB+256GB 国风雅灰", "description" => "8GB+256GB 国风雅灰", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 钛阴黑", "description" => "8GB+256GB 钛阴黑", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 冰海蓝", "description" => "8GB+256GB 冰海蓝", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 蜜桃金", "description" => "8GB+256GB 蜜桃金", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "12GB+256GB 国风雅灰", "description" => "12GB+256GB 国风雅灰", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 钛阴黑", "description" => "12GB+256GB 钛阴黑", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 冰海蓝", "description" => "12GB+256GB 冰海蓝", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 蜜桃金", "description" => "12GB+256GB 蜜桃金", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                ],
                'productPropties'=>[
                    ['name'=>'品牌','value'=>'小米/mi'],
                    ['name'=>'机身颜色','value'=>'国风雅灰'],
                    ['name'=>'机身颜色','value'=>'钛阴黑'],
                    ['name'=>'机身颜色','value'=>'冰海蓝'],
                    ['name'=>'机身颜色','value'=>'蜜桃金'],
                    ['name'=>'运行内存','value'=>'8GB'],
                    ['name'=>'运行内存','value'=>'12GB'],
                    ['name'=>'机身存储','value'=>'128GB'],
                    ['name'=>'机身存储','value'=>'256GB'],
                    ['name'=>'处理器','value'=>'蛟龙865'],
                ],
                'summaries'=>'images/91934ab1ea131e38643628c9f4e7224a.jpg,images/57d7ba03e2e4883209437924e66320c6.jpg,images/63a4edf6c4e49fa602f8d22ef06c2b7a.jpg',
            ],
            [
                'title'=>'小米10-1',
                'long_title'=>'小米10 双模5G',
                'description'=>'<p><img src="https://img.alicdn.com/imgextra/i3/704392951/TB25akyqsuYBuNkSmRyXXcA3pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB288x6y25TBuNjSspmXXaDRVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB2ck46y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2_OV3y1uSBuNjSsziXXbq8pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2F9KZiP7nBKNjSZLeXXbxCFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2XQ06y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB20Tl7y4SYBuNjSspjXXX73VXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2QygAqDdYBeNkSmLyXXXfnVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2C6S5qyCYBuNkHFCcXXcHtVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2J_pByYGYBuNjy0FoXXciBFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2520Ny29TBuNjy1zbXXXpepXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2ozkLyFmWBuNjSspdXXbugXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2S9IFiOAnBKNjSZFvXXaTKXXa_!!704392951.jpg" /></p><p><img alt="" src="https://gdp.alicdn.com/imgextra/i4/704392951/TB2KpHwfviSBuNkSnhJXXbDcpXa_!!704392951.jpg" /></p>',
                'img'=>'images/mi10.jpg',
                'price'=>'3799',
                'skus'=>[
                    ["title" => "8GB+128GB 国风雅灰", "description" => "8GB+128GB 国风雅灰", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 钛阴黑", "description" => "8GB+128GB 钛阴黑", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 冰海蓝", "description" => "8GB+128GB 冰海蓝", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 蜜桃金", "description" => "8GB+128GB 蜜桃金", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "8GB+256GB 国风雅灰", "description" => "8GB+256GB 国风雅灰", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 钛阴黑", "description" => "8GB+256GB 钛阴黑", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 冰海蓝", "description" => "8GB+256GB 冰海蓝", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 蜜桃金", "description" => "8GB+256GB 蜜桃金", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "12GB+256GB 国风雅灰", "description" => "12GB+256GB 国风雅灰", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 钛阴黑", "description" => "12GB+256GB 钛阴黑", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 冰海蓝", "description" => "12GB+256GB 冰海蓝", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 蜜桃金", "description" => "12GB+256GB 蜜桃金", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                ],
                'productPropties'=>[
                    ['name'=>'品牌','value'=>'小米/mi'],
                    ['name'=>'机身颜色','value'=>'国风雅灰'],
                    ['name'=>'机身颜色','value'=>'钛阴黑'],
                    ['name'=>'机身颜色','value'=>'冰海蓝'],
                    ['name'=>'机身颜色','value'=>'蜜桃金'],
                    ['name'=>'运行内存','value'=>'8GB'],
                    ['name'=>'运行内存','value'=>'12GB'],
                    ['name'=>'机身存储','value'=>'128GB'],
                    ['name'=>'机身存储','value'=>'256GB'],
                    ['name'=>'处理器','value'=>'蛟龙865'],
                ],
                'summaries'=>'images/91934ab1ea131e38643628c9f4e7224a.jpg,images/57d7ba03e2e4883209437924e66320c6.jpg,images/63a4edf6c4e49fa602f8d22ef06c2b7a.jpg',
            ],
            [
                'title'=>'小米10-2',
                'long_title'=>'小米10 双模5G',
                'description'=>'<p><img src="https://img.alicdn.com/imgextra/i3/704392951/TB25akyqsuYBuNkSmRyXXcA3pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB288x6y25TBuNjSspmXXaDRVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB2ck46y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2_OV3y1uSBuNjSsziXXbq8pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2F9KZiP7nBKNjSZLeXXbxCFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2XQ06y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB20Tl7y4SYBuNjSspjXXX73VXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2QygAqDdYBeNkSmLyXXXfnVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2C6S5qyCYBuNkHFCcXXcHtVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2J_pByYGYBuNjy0FoXXciBFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2520Ny29TBuNjy1zbXXXpepXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2ozkLyFmWBuNjSspdXXbugXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2S9IFiOAnBKNjSZFvXXaTKXXa_!!704392951.jpg" /></p><p><img alt="" src="https://gdp.alicdn.com/imgextra/i4/704392951/TB2KpHwfviSBuNkSnhJXXbDcpXa_!!704392951.jpg" /></p>',
                'img'=>'images/mi10.jpg',
                'price'=>'3799',
                'skus'=>[
                    ["title" => "8GB+128GB 国风雅灰", "description" => "8GB+128GB 国风雅灰", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 钛阴黑", "description" => "8GB+128GB 钛阴黑", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 冰海蓝", "description" => "8GB+128GB 冰海蓝", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 蜜桃金", "description" => "8GB+128GB 蜜桃金", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "8GB+256GB 国风雅灰", "description" => "8GB+256GB 国风雅灰", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 钛阴黑", "description" => "8GB+256GB 钛阴黑", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 冰海蓝", "description" => "8GB+256GB 冰海蓝", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 蜜桃金", "description" => "8GB+256GB 蜜桃金", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "12GB+256GB 国风雅灰", "description" => "12GB+256GB 国风雅灰", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 钛阴黑", "description" => "12GB+256GB 钛阴黑", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 冰海蓝", "description" => "12GB+256GB 冰海蓝", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 蜜桃金", "description" => "12GB+256GB 蜜桃金", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                ],
                'productPropties'=>[
                    ['name'=>'品牌','value'=>'小米/mi'],
                    ['name'=>'机身颜色','value'=>'国风雅灰'],
                    ['name'=>'机身颜色','value'=>'钛阴黑'],
                    ['name'=>'机身颜色','value'=>'冰海蓝'],
                    ['name'=>'机身颜色','value'=>'蜜桃金'],
                    ['name'=>'运行内存','value'=>'8GB'],
                    ['name'=>'运行内存','value'=>'12GB'],
                    ['name'=>'机身存储','value'=>'128GB'],
                    ['name'=>'机身存储','value'=>'256GB'],
                    ['name'=>'处理器','value'=>'蛟龙865'],
                ],
                'summaries'=>'images/91934ab1ea131e38643628c9f4e7224a.jpg,images/57d7ba03e2e4883209437924e66320c6.jpg,images/63a4edf6c4e49fa602f8d22ef06c2b7a.jpg',
            ],
            [
                'title'=>'小米10-3',
                'long_title'=>'小米10 双模5G',
                'description'=>'<p><img src="https://img.alicdn.com/imgextra/i3/704392951/TB25akyqsuYBuNkSmRyXXcA3pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB288x6y25TBuNjSspmXXaDRVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB2ck46y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2_OV3y1uSBuNjSsziXXbq8pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2F9KZiP7nBKNjSZLeXXbxCFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2XQ06y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB20Tl7y4SYBuNjSspjXXX73VXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2QygAqDdYBeNkSmLyXXXfnVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2C6S5qyCYBuNkHFCcXXcHtVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2J_pByYGYBuNjy0FoXXciBFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2520Ny29TBuNjy1zbXXXpepXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2ozkLyFmWBuNjSspdXXbugXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2S9IFiOAnBKNjSZFvXXaTKXXa_!!704392951.jpg" /></p><p><img alt="" src="https://gdp.alicdn.com/imgextra/i4/704392951/TB2KpHwfviSBuNkSnhJXXbDcpXa_!!704392951.jpg" /></p>',
                'img'=>'images/mi10.jpg',
                'price'=>'3799',
                'skus'=>[
                    ["title" => "8GB+128GB 国风雅灰", "description" => "8GB+128GB 国风雅灰", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 钛阴黑", "description" => "8GB+128GB 钛阴黑", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 冰海蓝", "description" => "8GB+128GB 冰海蓝", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 蜜桃金", "description" => "8GB+128GB 蜜桃金", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "8GB+256GB 国风雅灰", "description" => "8GB+256GB 国风雅灰", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 钛阴黑", "description" => "8GB+256GB 钛阴黑", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 冰海蓝", "description" => "8GB+256GB 冰海蓝", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 蜜桃金", "description" => "8GB+256GB 蜜桃金", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "12GB+256GB 国风雅灰", "description" => "12GB+256GB 国风雅灰", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 钛阴黑", "description" => "12GB+256GB 钛阴黑", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 冰海蓝", "description" => "12GB+256GB 冰海蓝", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 蜜桃金", "description" => "12GB+256GB 蜜桃金", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                ],
                'productPropties'=>[
                    ['name'=>'品牌','value'=>'小米/mi'],
                    ['name'=>'机身颜色','value'=>'国风雅灰'],
                    ['name'=>'机身颜色','value'=>'钛阴黑'],
                    ['name'=>'机身颜色','value'=>'冰海蓝'],
                    ['name'=>'机身颜色','value'=>'蜜桃金'],
                    ['name'=>'运行内存','value'=>'8GB'],
                    ['name'=>'运行内存','value'=>'12GB'],
                    ['name'=>'机身存储','value'=>'128GB'],
                    ['name'=>'机身存储','value'=>'256GB'],
                    ['name'=>'处理器','value'=>'蛟龙865'],
                ],
                'summaries'=>'images/91934ab1ea131e38643628c9f4e7224a.jpg,images/57d7ba03e2e4883209437924e66320c6.jpg,images/63a4edf6c4e49fa602f8d22ef06c2b7a.jpg',
            ],
            [
                'title'=>'小米10-5',
                'long_title'=>'小米10 双模5G',
                'description'=>'<p><img src="https://img.alicdn.com/imgextra/i3/704392951/TB25akyqsuYBuNkSmRyXXcA3pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB288x6y25TBuNjSspmXXaDRVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i1/704392951/TB2ck46y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2_OV3y1uSBuNjSsziXXbq8pXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2F9KZiP7nBKNjSZLeXXbxCFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2XQ06y7CWBuNjy0FaXXXUlXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB20Tl7y4SYBuNjSspjXXX73VXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2QygAqDdYBeNkSmLyXXXfnVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i3/704392951/TB2C6S5qyCYBuNkHFCcXXcHtVXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2J_pByYGYBuNjy0FoXXciBFXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i2/704392951/TB2520Ny29TBuNjy1zbXXXpepXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2ozkLyFmWBuNjSspdXXbugXXa_!!704392951.jpg" /><img src="https://img.alicdn.com/imgextra/i4/704392951/TB2S9IFiOAnBKNjSZFvXXaTKXXa_!!704392951.jpg" /></p><p><img alt="" src="https://gdp.alicdn.com/imgextra/i4/704392951/TB2KpHwfviSBuNkSnhJXXbDcpXa_!!704392951.jpg" /></p>',
                'img'=>'images/mi10.jpg',
                'price'=>'3799',
                'skus'=>[
                    ["title" => "8GB+128GB 国风雅灰", "description" => "8GB+128GB 国风雅灰", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 钛阴黑", "description" => "8GB+128GB 钛阴黑", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 冰海蓝", "description" => "8GB+128GB 冰海蓝", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+128GB 蜜桃金", "description" => "8GB+128GB 蜜桃金", "price" => "3799.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "8GB+256GB 国风雅灰", "description" => "8GB+256GB 国风雅灰", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 钛阴黑", "description" => "8GB+256GB 钛阴黑", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 冰海蓝", "description" => "8GB+256GB 冰海蓝", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "8GB+256GB 蜜桃金", "description" => "8GB+256GB 蜜桃金", "price" => "3999.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],

                    ["title" => "12GB+256GB 国风雅灰", "description" => "12GB+256GB 国风雅灰", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 钛阴黑", "description" => "12GB+256GB 钛阴黑", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 冰海蓝", "description" => "12GB+256GB 冰海蓝", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                    ["title" => "12GB+256GB 蜜桃金", "description" => "12GB+256GB 蜜桃金", "price" => "4399.00","imgs"=>"images/8bcc59ef6aeece37786fadc75620a62c.jpg"],
                ],
                'productPropties'=>[
                    ['name'=>'品牌','value'=>'小米/mi'],
                    ['name'=>'机身颜色','value'=>'国风雅灰'],
                    ['name'=>'机身颜色','value'=>'钛阴黑'],
                    ['name'=>'机身颜色','value'=>'冰海蓝'],
                    ['name'=>'机身颜色','value'=>'蜜桃金'],
                    ['name'=>'运行内存','value'=>'8GB'],
                    ['name'=>'运行内存','value'=>'12GB'],
                    ['name'=>'机身存储','value'=>'128GB'],
                    ['name'=>'机身存储','value'=>'256GB'],
                    ['name'=>'处理器','value'=>'蛟龙865'],
                ],
                'summaries'=>'images/91934ab1ea131e38643628c9f4e7224a.jpg,images/57d7ba03e2e4883209437924e66320c6.jpg,images/63a4edf6c4e49fa602f8d22ef06c2b7a.jpg',
            ],
        ];

        $category=\App\Category::where('name','小米10')->first();

        foreach($productData as $data){
            $product=new \App\Product(array_merge(\Illuminate\Support\Arr::only($data,['title','long_title','description','img','price']),['on_sale'=>true,'rating'=>5]));
            $product->category()->associate($category);
            $product->save();

            // 遍历商品数据中的 SKU 字段
            foreach ($data['skus'] as $sku) {
                $product->skus()->create(array_merge($sku, ['stock' => 999]));
            }
            // 遍历商品数据中的 properties 字段
            foreach ($data['productPropties'] as $attribute) {
                $product->productPropties()->create($attribute);
            }
        }
    }
}
