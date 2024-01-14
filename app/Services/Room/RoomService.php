<?php

namespace App\Services\Room;

use LaravelEasyRepository\BaseService;

interface RoomService extends BaseService{

    public function getListRoom($limit);

    public function createRoom($request);

    public function updateRoom($id, $request);
    
    public function deleteRoom($id);
}
