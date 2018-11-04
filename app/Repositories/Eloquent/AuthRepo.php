<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AuthInterface;
use App\Models\Board;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use Carbon\Carbon;

class AuthRepo implements AuthInterface
{
    public function register($request)
    {
        $board = Board::create(['name' => $request->name . "'s dashboard'"]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'detection_date' => $request->detection_date,
            'diabetes' => $request->diabetes,
            'board_id' => $board->id,
        ]);

        $role = Role::where('name', 'Administrator')->first();
        $user->assignRole($role);

        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);
    }

    public function login($request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Usuario o contraseña invalidos.'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout($request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Te has desconectado correctamente.']);
    }
}
