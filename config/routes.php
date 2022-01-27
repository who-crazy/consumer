<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

/**
 * admin
 */
//login
Router::post('/api/admin/login', 'App\Controller\Admin\AdminUserController@login');
Router::addGroup('/api/admin', function () {
    //文件上传
    Router::post('/uploads', 'App\Controller\Admin\UploadController@index');
    //config-about
    Router::get('/abouts', 'App\Controller\Admin\ConfigController@getAbout');
    Router::post('/abouts', 'App\Controller\Admin\ConfigController@updateAbout');
    //article-category
    Router::get('/article/categorys', 'App\Controller\Admin\ArticleCategoryController@index');
    Router::get('/article/categorys/{id}', 'App\Controller\Admin\ArticleCategoryController@show');
    Router::post('/article/categorys', 'App\Controller\Admin\ArticleCategoryController@store');
    Router::put('/article/categorys/{id}', 'App\Controller\Admin\ArticleCategoryController@update');
    Router::delete('/article/categorys/{id}', 'App\Controller\Admin\ArticleCategoryController@destroy');
    //article
    Router::get('/articles', 'App\Controller\Admin\ArticleController@index');
    Router::get('/articles/{id}', 'App\Controller\Admin\ArticleController@show');
    Router::post('/articles', 'App\Controller\Admin\ArticleController@store');
    Router::put('/articles/{id}', 'App\Controller\Admin\ArticleController@update');
    Router::delete('/articles/{id}', 'App\Controller\Admin\ArticleController@destroy');

    //collect-category
    Router::get('/collect/categorys', 'App\Controller\Admin\CollectCategoryController@index');
    Router::get('/collect/categorys/{id}', 'App\Controller\Admin\CollectCategoryController@show');
    Router::post('/collect/categorys', 'App\Controller\Admin\CollectCategoryController@store');
    Router::put('/collect/categorys/{id}', 'App\Controller\Admin\CollectCategoryController@update');
    Router::delete('/collect/categorys/{id}', 'App\Controller\Admin\CollectCategoryController@destroy');
    //collect
    Router::get('/collects', 'App\Controller\Admin\CollectController@index');
    Router::get('/collects/{id}', 'App\Controller\Admin\CollectController@show');
    Router::post('/collects', 'App\Controller\Admin\CollectController@store');
    Router::put('/collects/{id}', 'App\Controller\Admin\CollectController@update');
    Router::delete('/collects/{id}', 'App\Controller\Admin\CollectController@destroy');
    //申请收录审核
    Router::get('/collect/apply/check', 'App\Controller\Admin\CollectController@applyCheck');
}, ['middleware' => [\App\Middleware\AdminAuthMiddleware::class]]);


/**
 * Api
 */
Router::addGroup('/api/v1', function () {
    //login
    Router::post('/login', 'App\Controller\Api\UserController@login');
    //register
    Router::post('/register', 'App\Controller\Api\UserController@register');

    Router::addGroup('', function () {
        //tag
        Router::get('/collect/tags', 'App\Controller\Api\CollectTagController@index');
        //list
        Router::get('/collects', 'App\Controller\Api\CollectController@index');
        //detail
        Router::get('/collects/{id}', 'App\Controller\Api\CollectController@show');

        //praise，enshrine
        Router::put('/collect/actions', 'App\Controller\Api\CollectController@updateAction');
        //评论
        Router::post('/collect/comments', 'App\Controller\Api\CollectController@comment');
        //申请收录
        Router::post('/collect/apply', 'App\Controller\Api\CollectController@apply');

    }, ['middleware' => [\App\Middleware\UserAuthMiddleware::class]]);
});

/**
 * 公共
 */
Router::addGroup('/api', function () {
    //访问日志
});




//二期：提交收录申请，评论；
//修改个人资料： 头像，性别，生日，注册时设置随机头像
//活跃度：注册+1； 每日上线+1； 点赞+1上限5；收藏+1上限5；评论+1上限5；（总活跃，周活跃）