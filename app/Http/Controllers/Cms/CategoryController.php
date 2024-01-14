<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    use CommonTrait;
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roomTypes'] = $this->categoryService->getListRoomType(null);
        return view('cms.category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $roomType = $this->categoryService->createRoomType($request);
            $this->message = ['success', 'Create room type successfully!']; 
        } catch (\Throwable $th) {
            Log::error('Error creating room type: ' . $th->getMessage());
            $this->message = ['error', 'Create room type error!']; 
        }
        return redirect()->route('roomTypes.list')->with('notice', $this->message);
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
        $data['roomType'] = $this->findOrFailAndReturn(Category::class, $id);
        return view('cms.category.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roomType = $this->categoryService->updateRoomType($id, $request);
        return redirect()->route('roomTypes.list')->with('notice', ['success', 'Update room type successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomType = $this->categoryService->deleteRoomType($id);
        return json_encode([
            'statusCode' => 200,
            'message' => "Delete room type successfully!"
        ]);
    }
}
