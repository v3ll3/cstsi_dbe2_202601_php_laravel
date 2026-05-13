<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;

class LoginTokensController extends LoginController
{

  public function login(LoginRequest $request): UserResource | JsonResponse
    {
        try {
            $credentials = $request->validated();
            $user = $this->authenticate($credentials);
            if (!$user)
                throw new Exception("Dados inválidos!!");
            $token = $user->createToken($user->email)->plainTextToken;
            return new UserResource($user)
                ->additional(
                    [
                        "message" => "Usuário logado via token",
                        "token" => $token
                ]);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao realizar login!!', $error);
        }
    }
}
