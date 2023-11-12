<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function one(Request $request)
    {
        $user_id = $request->input('user_id', 0);

        $data = User::find($user_id);

        if ($data) {
            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
