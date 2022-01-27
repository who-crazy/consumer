<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\JsonRpc\ArticleServiceInterface;
use App\JsonRpc\CollectServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;
use Taoran\HyperfPackage\Core\Verify;

class CollectTagController extends AbstractController
{

    /**
     * @Inject()
     * @var CollectServiceInterface
     */
    protected $collectService;

    public function index()
    {
        $params = Verify::requestParam([
            ['is_all', 0],
        ], $this->request);
        try {
            $list =  $this->collectService->getTags($params);
            return $this->responseCore->success($list);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
