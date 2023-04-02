<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Models\Role;
use App\Models\Societie;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $req)
    {
        $validasi = Validator::make($req->all(), [
            'id_card_number' => ['required', 'min:8', 'max:8'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validasi->fails()) {
            return Response::json(403, 'Validate Error', $validasi->errors());
        }

        $id_card_number = $req->id_card_number;
        $password = $req->password;

        if (FacadesAuth::attempt([
            'id_card_number' => $id_card_number,
            'password' => $password
        ])) {
            $token = Token::generateToken($id_card_number, $password);

            return Response::json(200, 'Success Login', ['user' => FacadesAuth::user(), 'expired' => $token->expired, 'token' => $token->token]);
        }

        return Response::json(401, 'Unauthorized');
    }

    function register(Request $req)
    {
        try {
            $validasi = Validator::make($req->all(), [
                'name' => ['required'],
                'id_card_number' => ['required', 'min:8', 'max:8', 'unique:users,id_card_number'],
                'password' => ['required', 'min:8', 'same:password2'],
                'password2' => ['required']
            ]);

            if ($validasi->fails()) {
                return Response::json(403, 'Validate Error', $validasi->errors());
            }

            $name = $req->name;
            $id_card_number = $req->id_card_number;
            $password = $req->password;

            // mencari id card number
            $find_id_card_number = Societie::where('id_card_number', $id_card_number)->first();
            if ($find_id_card_number) {
                $user = User::create([
                    'name' => $name,
                    'id_card_number' => $id_card_number,
                    'password' => bcrypt($password)
                ]);

                $user_id = $user['id'];
                $find_id_card_number->update([
                    'user_id' => $user_id
                ]);

                Role::assignRole('society', $user_id);

                return Response::json(201, 'Success', $user);
            }

            return Response::json(401, 'You can\'t register. Because, you haven\'t consulted');
        } catch (Exception $e) {
            return Response::json(500, $e->getMessage(), $e);
        }
    }

    function logout()
    {
        $logout = Auth::logout();
        if ($logout) {
            return Response::json(200, 'Logout success');
        }

        return Response::json(401, 'Invalid Token');
    }

    function token(Request $req)
    {
        // return ['role' => Role::hasRole('doctor')];
        // return $req->header("Authorization");
        return response()->json(Auth::society());
    }
}
