<?php

/**
 * 微信配置
 */
return [
    //    'app_id'        => 'wxdf6fad64e87ae71b',
    //    'secret'        => '4ef3f73445d9e8ec4ad262e3d7d0f7cf',
    //    'response_type' => 'array',

    //    'app_id'        => 'wx4345ef78506a2093',
    //    'secret'        => '55887fa12f26f0c3f2fd780f45782f53',


    'app_id' => 'wxf42332e0a784872c',
//    'token'  => 'gaoyongtokentest',
    'secret' => '172657dfd300c312b460b808086c9887',

    'response_type' => 'array',


    /**
     * 日志配置
     *
     * level: 日志级别, 可选为：
     *         debug/info/notice/warning/error/critical/alert/emergency
     * path：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'default' => 'dev', // 默认使用的 channel，生产环境可以改为下面的 prod
        'channels' => [
            // 测试环境
            'dev' => [
                'driver' => 'single',
                'path' => '/tmp/easywechat.log',
                'level' => 'debug',
            ],
            // 生产环境
            'prod' => [
                'driver' => 'daily',
                'path' => '/tmp/easywechat.log',
                'level' => 'info',
            ],
        ],
    ],
];
