<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Traits\CommonTrait;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CommonTrait;
    protected UserService $userService;
    protected $genders = [
        'Male',
        'Female',
        'Other'
    ];

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = $this->userService->getUserList(null);
        return view('cms.user.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['genders'] = $this->genders;
        return view('cms.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request);
        return redirect()->route('users.list')->with('notice', ['success', 'Create user successfully!']);
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
        $data['user'] = $this->findOrFailAndReturn(User::class, $id);
        $data['genders'] = $this->genders;
        return view('cms.user.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = $this->userService->updateUser($id, $request);
        return redirect()->route('users.list')->with('notice', ['success', 'Update user successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->deleteUser($id);
        return json_encode([
            'statusCode' => 200,
            'message' => 'Delete user successfully!'
        ]);
    }
}
