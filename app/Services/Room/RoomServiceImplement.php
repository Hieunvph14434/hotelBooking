<?php

namespace App\Services\Room;

use LaravelEasyRepository\Service;
use App\Repositories\Room\RoomRepository;

class RoomServiceImplement extends Service implements RoomService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(RoomRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getListRoom($searchData, $limit)
    {
      return $this->mainRepository->getListRoom($searchData, $limit);
    }

    public function createRoom($request)
    {
      $data = $request->all();
      if($request->hasFile('image')) {
        $data['image'] = checkIssetImage($request, [
          'image'=>'image',
          'prefixName'=>'',
          'folder'=>'uploads/rooms',
          'imageOld'=> ''
        ]);
      }
      return $this->mainRepository->create($data);
    }

    public function updateRoom($id, $request)
    {
      $currentData = $this->mainRepository->findOrFail($id);
      $data = $request->all();
      $data['image'] = null;
      if($request->hasFile('image')) {
        $data['image'] = checkIssetImage($request, [
          'image'=>'image',
          'prefixName'=>'',
          'folder'=>'uploads/rooms',
          'imageOld'=> $currentData->image
        ]);
      }
      return $this->mainRepository->update($id, $data);
    }

    public function deleteRoom($id)
    {
      $room = $this->mainRepository->find($id);
      return $room->delete();
    }
}
