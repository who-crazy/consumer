<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\JsonRpc\CollectServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;
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
            ['tags', ''],   //根据标签查询,可多个，array
            ['is_tree', 0],
            ['is_all', 0],
        ], $this->request);

        try {
            $list =  $this->collectService->getList($params);
            return $this->responseCore->success($list);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data =  $this->collectService->getOne((int)$id);
            return $this->responseCore->success($data);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }

    /**
     * 用户点赞收藏
     *
     * @return array
     */
    public function updateAction()
    {
        //接收参数
        $params = Verify::requestParam([
            ['type', 1],    //1点赞；2收藏
            ['collect_id', ''],
        ], $this->request);

        try {
            $result = Context::get(ServerRequestInterface::class);
            $user_id = $result->getAttribute('user_id');
            $params['user_id'] = $user_id;
            $this->collectService->updateAction($params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    /**
     * 评论
     *
     * @param $params
     */
    public function comment()
    {
        //接收参数
        $params = Verify::requestParam([
            ['collect_id', ''],
            ['comment', ''],
        ], $this->request);

        try {
            $result = Context::get(ServerRequestInterface::class);
            $user_id = $result->getAttribute('user_id');
            $params['user_id'] = $user_id;
            $this->collectService->comment($params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }

    /**
     * 申请收录
     *
     * @param $params
     */
    public function apply($params)
    {
        //接收参数
        $params = Verify::requestParam([
            ['title', ''],  //标题
            ['desc', ''],   //简介
            ['cover', ''],  //封面
            ['content_html', ''],//详情
            ['tags', ''],       //标签
            ['link', ''],       //链接
        ], $this->request);

        try {
            $result = Context::get(ServerRequestInterface::class);
            $user_id = $result->getAttribute('user_id');
            $params['user_id'] = $user_id;
            $this->collectService->apply($params);
            return $this->responseCore->success("操作成功！");
        } catch (\Exception $e) {
            return $this->responseCore->error(Code::SAVE_DATA_ERROR, $e->getMessage());
        }
    }
}
