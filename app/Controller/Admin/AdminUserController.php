<?php

declare(strict_types=1);

namespace App\Controller\Admin;



use App\JsonRpc\AdminUserServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Taoran\HyperfPackage\Core\Verify;
use function Package\HyperfPackage\Helpers\Password\eq_password;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;

class AdminUserController extends AbstractController
{
    /**
     * @Inject()
     * @var AdminUserServiceInterface
     */
    protected $adminUserService;

    /**
     * 登录
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function login()
    {
        //参数
        $params = Verify::requestParam([
            ['account', ''],
            ['password', ''],
        ], $this->request);

        //业务
        try {
            $result = $this->adminUserService->login($params);
            return $this->responseCore->success($result);
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::VALIDATE_ERROR, $e->getMessage());
        }
    }

    /**
     * logout
     */
    public function logout()
    {

    }
}
