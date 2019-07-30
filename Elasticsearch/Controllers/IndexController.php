<?php
namespace App\Modules\Elasticsearch\Controllers;

require 'app/Modules/Elastic/vendor/autoload.php';

use Think\Controller\RestController;
use Elasticsearch\ClientBuilder;

class IndexController extends RestController
{
    public function __construct(){
        parent::__construct();
        $params['hosts'] = array(
            '127.0.0.1:9200'
        );
        $this->lastMaxGoodsId=20000;
        $this->client = ClientBuilder::create()->build();
    }
    public function actionCreateIndex()
    {
        set_time_limit(0);
        $length=10000;
        $start = microtime(true);
        $goods_count=M("goods")->where("goods_id >{$this->lastMaxGoodsId}")->count();
        for ($i=0;$i<1;$i++){
            $offset=$length*$i;
            $goods_list= M('goods')
                ->field('goods_id, goods_sn, goods_thumb, is_on_sale, market_price, goods_name, shop_price, cost_price, goods_brief, goods_value, price_type')
                ->order("goods_id asc")
                ->limit($offset,$length)
                ->select();
            foreach ($goods_list as $goods){
                $params = [
                    'index' => 'fygo',
                    'type' => 'goods',
                    'id' => $goods["goods_id"],
                    'body' => array(
                        "goods_id"=>$goods["goods_id"],
                        "goods_sn"=>$goods["goods_sn"],
                        "goods_thumb"=>$goods["goods_thumb"],
                        "is_on_sale"=>$goods["is_on_sale"],
                        "market_price"=>$goods["market_price"],
                        "goods_name"=>$goods["goods_name"],
                        "shop_price"=>$goods["shop_price"],
                        "cost_price"=>$goods["cost_price"],
                        "goods_brief"=>$goods["goods_brief"],
                        "goods_value"=>$goods["goods_value"],
                        "price_type"=>$goods["price_type"],
                    )
                ];
                $this->client->index($params);
                echo "成功插入一条商品索引！<br>";
            }
            $end = microtime(true);
            $time=$end-$start;
            $time=number_format($time, 3, '.', '');
            $lastID=$this->lastMaxGoodsId+$length;
            echo "成功导入{$length}条数据索引！共计耗时{$time}秒,最终ID为{$lastID}";
        }
    }

    public function actionGetItems(){
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => '2'
        ];
        $response = $this->client->get($params);
        dump($response);
    }

    public function search($keywords){
        $params = [
            'index' => 'fygo',
            'type' => 'goods',
            "body"=>array(
                "query"=>array(
                    "match"=>array(
                        "goods_name"=>$keywords,
                    )
                )
            )
        ];
        $response = $this->client->search($params);
        return $response;
    }

    public function actionSearch(){
        $params = [
            'index' => 'fygo',
            'type' => 'goods',
            'body' => [
                'query' => [
                    'match' => [ 'goods_name' => '特仑苏牛奶' ]  ,
                ]
            ]
        ];
        $response = $this->client->search($params);
        dump($response);
    }

    public function actionDelItems()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => '2'
        ];

        $response = $this->client->delete($params);
        dump($response);
    }


    public function actionDelIndex(){
        $deleteParams = [
            'index' => 'fygo'
        ];
        $response = $this->client->indices()->delete($deleteParams);
        dump($response);
    }
}