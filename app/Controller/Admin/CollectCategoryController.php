<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\JsonRpc\CollectCategoryServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Core\Code;
use Taoran\HyperfPackage\Core\Verify;
use function Swoole\Coroutine\Http\request;

class CollectCategoryController extends AbstractController
{
    /**
     * @Inject()
     * @var CollectCategoryServiceInterface
     */
    protected $collectCategoryService;

    public function index()
    {
        $params = Verify::requestParam([
            ['name', ''],
            ['is_tree', 0],
            ['is_all', 0],
        ], $this->request);

        $list =  $this->collectCategoryService->getList($params);
        return $this->responseCore->success($list);
    }

    public function show($id)
    {
        $data =  $this->collectCategoryService->getOne((int)$id);
        return $this->responseCore->success($data);
    }

    public function store()
    {
        //接收参数
        $params = Verify::requestParam([
            ['name', ''],
            ['parent_id', 0],
            ['sort', 0],
        ], $this->request);

        try {
            $this->collectCategoryService->add($params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    public function update($id)
    {
        //接收参数
        $params = Verify::requestParam([
            ['name', ''],
            ['parent_id', 0],
            ['sort', 0],
        ], $this->request);

        try {
            $this->collectCategoryService->update((int)$id, $params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->collectCategoryService->destroy((int)$id);
            return $this->responseCore->success('操作成功');
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }

}
