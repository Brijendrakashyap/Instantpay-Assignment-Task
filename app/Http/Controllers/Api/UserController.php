<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        return User::all();
    }

    // Get single user
    public function show($id)
    {
        return User::findOrFail($id);
    }

}
