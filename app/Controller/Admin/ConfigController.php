<?php

declare(strict_types=1);

namespace App\Controller\Admin;


use App\JsonRpc\ConfigServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Verify;
use Taoran\HyperfPackage\Upload\Upload;


class ConfigController extends AbstractController
{

    /**
     * @Inject()
     * @var ConfigServiceInterface
     */
    protected $configService;

    public function getAbout()
    {
        $data = $this->configService->getAbout();
        return $this->responseCore->success($data);
    }

    public function updateAbout()
    {
        $params = Verify::requestParam([
            ['value', '']
        ], $this->request);
        try {
            $this->configService->updateAbout($params);
            return $this->responseCore->success('操作成功！');
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
