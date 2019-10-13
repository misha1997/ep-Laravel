<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function getUsers() {
        $data = User::get();
        return response()->json($data);
    }

    function postUsers(Request $request) {
        $data = new User;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->role = $request->role;
        $data->department_id = $request->department_id;
        $data->password = Hash::make($request->password);
        $data->save();
    }

    function putUsers(Request $request, $id) {
        $data = User::find($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->role = $request->role;
        $data->password = Hash::make($request->newPassword);
        $data->save();
    }

    function deleteUsers($id) {
        User::find($id)->delete();
    }
}
