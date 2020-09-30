<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

class WeChatServerController extends Controller
{
    protected $app;

    public function __construct()
    {
        $config = config('wechat');

        $this->app = Factory::officialAccount($config);
    }

    public function index()
    {
        info(\request());

        $this->app->server->push(function ($message) {
            info($message);
            return "您好！欢迎使用 EasyWeChat!";
        });

        $response = $this->app->server->serve();

        return $response;
    }

    public function menuList()
    {
        $list = $this->app->menu->list();

//        $response = $this->app->server->serve();

        dd($list);
        return $list;
    }

    public function currentMenu()
    {
        $current = $this->app->menu->current();

//        $response = $this->app->server->serve();

        dd($current);

        return $current;
    }

    public function createMenu()
    {
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $res = $this->app->menu->create($buttons);

        dd($res);

    }
}
