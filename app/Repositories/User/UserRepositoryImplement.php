<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

   public function getUserList($limit = 5) {
        return $this->model->query()
        ->select(["id", "name", "email", "phone", "gender"])
        ->whereNull("deleted_at")
        ->whereNotNull("email_verified_at")
        ->orderByDesc("created_at")
        ->paginate($limit);
   }
}
