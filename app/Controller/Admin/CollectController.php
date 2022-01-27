<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\JsonRpc\CollectServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;
use Taoran\HyperfPackage\Core\Verify;

class CollectController extends AbstractController
{

    /**
     * @Inject()
     * @var CollectServiceInterface
     */
    protected $collectService;

    public function index()
    {
        $params = Verify::requestParam([
            ['title', ''],
            ['is_tree', 0],
            ['is_all', 0],
        ], $this->request);

        $list =  $this->collectService->getList($params);
        return $this->responseCore->success($list);
    }

    public function show($id)
    {
        $data =  $this->collectService->getOne((int)$id);
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
            ['tags', ''],
        ], $this->request);
        try {
            $this->collectService->add($params);
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
            ['tags', ''],
        ], $this->request);

        try {
            $this->collectService->update((int)$id, $params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->collectService->destroy((int)$id);
            return $this->responseCore->success('操作成功');
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }

    public function applyCheck($id)
    {
        try {
            $this->collectService->destroy((int)$id);
            return $this->responseCore->success('操作成功');
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
