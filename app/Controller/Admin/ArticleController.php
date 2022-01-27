<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\JsonRpc\ArticleServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;
use Taoran\HyperfPackage\Core\Verify;

class ArticleController extends AbstractController
{

    /**
     * @Inject()
     * @var ArticleServiceInterface
     */
    protected $articleService;

    public function index()
    {
        $params = Verify::requestParam([
            ['title', ''],
            ['is_tree', 0],
            ['is_all', 0],
        ], $this->request);

        $list =  $this->articleService->getList($params);
        return $this->responseCore->success($list);
    }

    public function show($id)
    {
        $data =  $this->articleService->getOne((int)$id);
        return $this->responseCore->success($data);
    }

    public function store()
    {
        //接收参数
        $params = Verify::requestParam([
            ['title', ''],
            ['desc', ''],
            ['cover', ''],
            ['content', ''],
            ['content_html', ''],
            ['cat_id', ''],
            ['is_show', ''],
            ['type', 0],
        ], $this->request);
        try {
            $this->articleService->add($params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    public function update($id)
    {
        //接收参数
        $params = Verify::requestParam([
            ['title', ''],
            ['desc', ''],
            ['cover', ''],
            ['content', ''],
            ['content_html', ''],
            ['cat_id', ''],
            ['is_show', ''],
            ['type', 0],
        ], $this->request);

        try {
            $this->articleService->update((int)$id, $params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->articleService->destroy((int)$id);
            return $this->responseCore->success('操作成功');
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
