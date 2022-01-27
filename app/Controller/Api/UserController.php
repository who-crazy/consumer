<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\JsonRpc\UserServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;
use Taoran\HyperfPackage\Core\Verify;

class UserController extends AbstractController
{

    /**
     * @Inject()
     * @var UserServiceInterface
     */
    protected $userService;

    public function login()
    {
        $params = Verify::requestParam([
            ['email', ''],
            ['password', 0],
        ], $this->request);

        try {
            $data =  $this->userService->login($params);
            return $this->responseCore->success($data);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }

    public function register()
    {
        $params = Verify::requestParam([
            ['email', ''],
            ['nickname', ''],
            ['password', 0],
            ['password_confirmation', 0],
        ], $this->request);

        try {
            $user_id = Context::get(ServerRequestInterface::class, 'user_id');
            $data = $this->userService->register($params);
            return $this->responseCore->success($data ?? []);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
