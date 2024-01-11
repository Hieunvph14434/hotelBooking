<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->$userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = $this->userService->getUserList(null);
        dd($data['users']?->toArray());
        return view('cms.user.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}