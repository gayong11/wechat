<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Http\Request;

class WeChatServerController extends Controller
{
    protected $app;

    public function __construct()
    {
        $config = config('wechat');
        $this->app = Factory::officialAccount($config);

        info(\request()->fullUrl());
        info(\request()->method());

    }

    public function index()
    {
        info(\request());
        $config = config('wechat');
        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            return "您好！欢迎使用 EasyWeChat!";
        });

        $app->server->push(function ($message) {
            return '收到其它消息';
        });
        $response = $app->server->serve();

        return $response;
    }

    public function server()
    {
        info('server');
        $config = config('wechat');
        $app = Factory::officialAccount($config);

        $app->server->push(function ($message) {
            // $message['FromUserName'] // 用户的 openid
            // $message['MsgType'] // 消息类型：event, text....
            switch ($message['MsgType']) {
                case 'event':
                     $info = self::eventMsg($message);
                     info($info);

                     return $info;
//                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });
        $response = $app->server->serve();
        return $response;
    }

    public function menuList()
    {
        $config = config('wechat');
        $app = Factory::officialAccount($config);

        $list = $app->menu->list();

//        $response = $this->app->server->serve();

        dd($list);
        return $list;
    }

    public function currentMenu()
    {
        $config = config('wechat');
        $app = Factory::officialAccount($config);

        $current = $app->menu->current();

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
        $config = config('wechat');
        $app = Factory::officialAccount($config);

        $res = $app->menu->create($buttons);

        dd($res);
    }

    public function eventMsg($msg)
    {
        if ($msg['Event'] == 'CLICK') {
            if ($msg['EventKey'] == 'V1001_GOOD') {
                return '感谢';
            } elseif ($msg['EventKey'] == 'V1001_TODAY_MUSIC') {
                return '这是一首音乐';
            } else {
                return '测试吗';
            }
        }

    }
}
