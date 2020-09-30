<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

class WeChatServerController extends Controller
{
    public function index()
    {
        $config = config('wechat');

        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            return "您好！欢迎使用 EasyWeChat!";
        });

        $response = $app->server->serve();

        info($response);

        return $response;
    }
}
