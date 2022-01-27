<?php

declare(strict_types=1);

namespace App\Controller;


//use App\JsonRpc\ArticleCategoryServiceInterface;
use App\JsonRpc\ArticleCategoryServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class IndexController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }
}
