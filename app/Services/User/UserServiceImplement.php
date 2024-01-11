<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getUserList($limit) {
      return $this->mainRepository->getUserList($limit);
    }

    public function updateUser($id, $request) {
      $data = $request->all();
      $currentData = $this->mainRepository->find($id);
      if(! is_null($data['avatar'])) {
        $data['avatar'] = checkIssetImage($request, [
          'image'=>'avatar',
          'prefixName'=>'',
          'folder'=>'uploads/users',
          'imageOld'=> $currentData->avatar
        ]);
      }
      return $this->mainRepository->update($id, $data);
    }
}
