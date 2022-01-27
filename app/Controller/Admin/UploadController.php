<?php

declare(strict_types=1);

namespace App\Controller\Admin;


use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Taoran\HyperfPackage\Core\AbstractController;
use Taoran\HyperfPackage\Upload\Upload;


class UploadController extends AbstractController
{

    /**
     * @var 上传目录
     */
    protected $uploadDir = 'uploads/';

    /**
     * @var string 临时上传目录
     */
    protected $uploadTmpDir = 'uploads/tmp/';


    public function index(RequestInterface $request, ResponseInterface $response)
    {
        try {
            //接收参数
            $flag = $request->input('flag');

            $allowFlag = ['article/', 'user/avatar/'];
            $pre = 'bbx/';
            if (!$flag || !in_array($flag, $allowFlag)) {
                throw new \Exception('上传类型错误!');

            }
            $upload_remote_path = $pre . $flag;

            $upload = new Upload();

            $file = $upload->checkFile();
            $path = $upload->toAlioss($file, $upload_remote_path);
            //$path = $this->toLocal($file, 'uploads/');

            return $this->responseCore->success($path);
        } catch (\Exception $e) {
            return $this->responseCore->error($e->getMessage());
        }
    }
}
