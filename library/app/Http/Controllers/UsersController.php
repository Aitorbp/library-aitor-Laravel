<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function generarToken(Request $request, $id)
    {
        if($id ==null || empty($id)){
            $response = array('error_code' => 404, 'error_msg' => 'Null value');
            return response()->json($response);
        }
        else{
            $user = User::find($id);
            $token = $request->api_token;
            $user->api_token = hash('sha256', $token);
            $user->save();
            return $user;
        }
       
    }
}
