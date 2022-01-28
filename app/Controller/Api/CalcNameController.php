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

class CalcNameController extends AbstractController
{
    public function index()
    {
        return $this->responseCore->success('calc name!');
    }
}
