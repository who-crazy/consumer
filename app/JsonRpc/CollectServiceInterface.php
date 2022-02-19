<?php


namespace App\JsonRpc;


interface CollectServiceInterface
{
    public function getList(array $params);
    public function getOne(int $id);
    public function add($params);
    public function update(int $id, array $params);
    public function destroy(int $id);
    public function getTags($params);
    public function updateAction($params);
    public function comment($params);
    public function apply($params);
    public function applyCheck($params);
    public function test($params);
}