<?php


namespace App\JsonRpc;


interface CollectCategoryServiceInterface
{
    public function getList(array $params);
    public function getOne(int $id);
    public function add($params);
    public function update(int $id, array $params);
    public function destroy(int $id);
}