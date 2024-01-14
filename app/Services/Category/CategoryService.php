<?php

namespace App\Services\Category;

use LaravelEasyRepository\BaseService;

interface CategoryService extends BaseService{

    public function getListRoomType($limit);

    public function createRoomType($request);

    public function updateRoomType($id, $request);

    public function deleteRoomType($id);
}
