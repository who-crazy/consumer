<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    //通过循环生成配置
    'consumers' => value(function () {
        $consumers = [];
        $services = [
            'AdminUserService' => \App\JsonRpc\AdminUserServiceInterface::class,
            'ArticleService' => \App\JsonRpc\ArticleServiceInterface::class,
            'ArticleCategoryService' => \App\JsonRpc\ArticleCategoryServiceInterface::class,
            'ConfigService' => \App\JsonRpc\ConfigServiceInterface::class,
            'CollectCategoryService' => \App\JsonRpc\CollectCategoryServiceInterface::class,
            'CollectService' => \App\JsonRpc\CollectServiceInterface::class,
            'UserService' => \App\JsonRpc\UserServiceInterface::class,
        ];

        foreach ($services as $name => $interface) {
            $consumers[] = [
                'name' => $name,
                'service' => $interface,
                'protocol' => 'jsonrpc-http',
                'registry' => [
                    'protocol' => 'consul',
                    'address' => env('CONSUL_URL', 'http://127.0.0.1:8500'),
                ]
            ];
        }
        return $consumers;
    }),
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => env('CONSUL_URL', 'http://127.0.0.1:8500'),
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '1s',
            ],
        ],
        'nacos' => [
            // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
            // 'url' => '',
            // The nacos host info
            'host' => '127.0.0.1',
            'port' => 8848,
            // The nacos account info
            'username' => null,
            'password' => null,
            'guzzle' => [
                'config' => null,
            ],
            'group_name' => 'api',
            'namespace_id' => 'namespace_id',
            'heartbeat' => 5,
        ],
    ],
];
