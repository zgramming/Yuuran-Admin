<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Arr;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;
use function request;

class AuthenticationApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        try {
            $post = request()->all();

            $rules = [
                "username" => "required",
                "password" => "required",
            ];

            request()->validate($rules);

            $data = [
                'username' => $post['username'],
                'password' => $post['password'],
            ];

            if (!Auth::attempt($data)) throw new Exception("Username atau Password yang dimasukkan tidak valid", 401);

            $user = User::where("username", $post['username'])->with(["userGroup"])->firstOrFail();
            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json(
                [
                    "success" => true,
                    "message" => "Berhasil login dengan username $post[username]",
                    "token" => $token,
                    "data" => $user,
                ], 200);

        } catch (ValidationException $validationException) {
            return response()->json([
                'success' => false,
                'title' => $validationException->getMessage(),
                'message' => implode("\n", Arr::flatten($validationException->errors()))
            ], $validationException->status);
        } catch (QueryException $e) {
            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], $code);
        } catch (Throwable $e) {
            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], $code);
        }
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['message' => "string"])]
    public function logout(): array
    {
//        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function users()
    {
        return response()->json(['data' => User::all()]);
    }
}
