<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Resources\SocietyResource;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthFacades;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $req)
    {
        $validasi = Validator::make($req->all(), [
            'id_card_number' => ['required', 'min:8', 'max:8'],
            'password' => ['required']
        ]);

        if ($validasi->fails()) {
            return Response::json(401, 'ID Card Number or Password incorrect', $validasi->errors());
        }

        $idCardNumber = $req['id_card_number'];
        $password = $req['password'];

        if (AuthFacades::attempt([
            'id_card_number' => $idCardNumber,
            'password' => $password
        ])) {
            $token =  Token::generateToken($idCardNumber, $password);
            $userId = AuthFacades::user()->id;
            $user = User::with('society.regional')->where('id', $userId)->first();
            $user['token'] = $token;
            $result = SocietyResource::collection(collect([$user]))->first();
            return Response::json(200, 'Success Login', $result);
        }

        return Response::json(401, 'Unauthorized', [], "ID card number or password incorrect");
    }

    function logout(Request $req)
    {
        $token = $req->header('Authorization');
        if ($token) {
            $find_token = Token::where('token', $token)->first();
            if ($find_token) {
                if ($find_token->delete()) {
                    return Response::json(200, 'Logout success');
                };
            }
        }

        return Response::json(401, 'Invalid token');
    }
}
