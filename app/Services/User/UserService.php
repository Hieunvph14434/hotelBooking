<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function getUserList($limit);

    public function createUser($request);

    public function updateUser($id, $request);

    public function deleteUser($id);
}
