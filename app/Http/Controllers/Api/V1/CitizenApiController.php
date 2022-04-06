<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Throwable;

class CitizenApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $citizen = User::with("userGroup")->whereRelation("userGroup", "code", "warga")->get();

        return response()->json(['success' => true, 'data' => $citizen]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            $citizen = User::find($id);
            $request = request()->all();

            $rules = [
                "username" => ["required"],
                "name" => ['required'],
                "email" => ['required'],
                "password" => ['required', "confirmed"],
                "password_confirmation" => ["required"],
            ];

            request()->validate($rules);

            $data = [
                "app_group_user_id"=> UserGroup::where("code","=","warga")->value("id"),
                "username" => $request['username'],
                "name" => $request['name'],
                "email" => $request['email'],
                "password" => $request['password'],
            ];

            $result = User::updateOrCreate(['id' => $id], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);
            $message = !empty($id) ? "Mengupdate" : "Membuat";
            return response()->json([
                'success' => true,
                'message' => "Berhasil $message akun warga dengan nama $request[name]",
            ], 201);

        } catch (ValidationException $validationException) {
            return response()->json([
                'success' => false,
                'title' => $validationException->getMessage(),
                'message' => implode("\n", Arr::flatten($validationException->errors()))
            ], $validationException->status);
        } catch (QueryException $e) {
            $message = $e->getMessage();
//            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], 500);
        } catch (Throwable $e) {
            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], $code);
        }
    }
}
