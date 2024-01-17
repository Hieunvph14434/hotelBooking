<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Traits\CommonTrait;
use App\Models\Room;
use App\Services\Room\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    use CommonTrait;
    protected RoomService $roomService;
    protected $status = ['Unavailable', 'Available'];

    public function __construct(RoomService $roomService) {
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['rooms'] = $this->roomService->getListRoom([], null);
        return view('cms.room.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roomTypes'] = $this->getListRoomType();
        $data['status'] = $this->status;
        return view('cms.room.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        try {
            $room = $this->roomService->createRoom($request);
            $this->message = ['error', 'Create room successfully!']; 
        } catch (\Throwable $th) {
            Log::error('Error create room: ' . $th->getMessage());
            $this->message = ['error', 'Create room error!']; 
        }
        return redirect()->route('rooms.list')->with('notice', $this->message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['room'] = $this->findOrFailAndReturn(Room::class, $id);
        $data['roomTypes'] = $this->getListRoomType();
        $data['status'] = $this->status;
        return view('cms.room.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, string $id)
    {
        try {
            $room = $this->roomService->updateRoom($id, $request);
            $this->message = ['success', 'Update room successfully!'];
        } catch (\Throwable $th) {
            Log::error('Error update room: ' . $th->getMessage());
            $this->message = ['error', 'Update room error!']; 
        }
        return redirect()->route('rooms.list')->with('notice', $this->message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $room = $this->roomService->deleteRoom($id);
            $this->message = ['success', 'Delete room successfully!'];
        } catch (\Throwable $th) {
            Log::error('Error delete room: ' . $th->getMessage());
            $this->message = ['error', 'Delete room error!']; 
        }
        return redirect()->route('rooms.list')->with('notice', $this->message);
    }
}
