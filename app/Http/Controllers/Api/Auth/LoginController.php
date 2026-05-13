<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function authenticate(array $credentials): User | null
    {

        if (Auth::attempt($credentials))
            return User::where('email', $credentials['email'])->first();
        return null;
    }


    public function login(LoginRequest $request): UserResource | JsonResponse
    {
        try {
            $credentials = $request->validated();
            $user = $this->authenticate($credentials);
            if (!$user)
                throw new Exception("Dados inválidos!!");
            return new UserResource($user)
                ->additional(["message" => "Usuário logado via sessao"]);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao realizar login!!', $error);
        }
    }
}
