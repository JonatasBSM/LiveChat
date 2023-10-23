<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UsersInterface;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected UserService $userService)
    {

    }

    public function index()
    {
       return response()->json([
           'status' => 200,
           'users' => $this->usersRepository->all()->paginate(40)
       ]);
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
    public function show(Request $request)
    {
         $result = $this->userService->search(
             'name', $request->query('name'), $request->query('auth_id')
         );

         return response()->json([
             'status' => 200,
             'usersList' => $result
         ]);
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
