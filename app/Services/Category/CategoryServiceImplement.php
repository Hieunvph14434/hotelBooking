<?php

namespace App\Services\Category;

use LaravelEasyRepository\Service;
use App\Repositories\Category\CategoryRepository;

class CategoryServiceImplement extends Service implements CategoryService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CategoryRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getListRoomType($limit) {
      return $this->mainRepository->getListRoomType($limit);
    }

    public function createRoomType($request)
    {
      $data = $request->all();
      return $this->mainRepository->create($data);
    }

    public function updateRoomType($id, $request)
    {
      $data = $request->all();
      return $this->mainRepository->update($id, $data);
    }

    public function deleteRoomType($id)
    {
      $roomType = $this->mainRepository->findOrFail($id);
      return $roomType->delete();
    }
}
