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
     * @param int|null $userId
     * @return JsonResponse
     */
    public function get(?int $userId = null): JsonResponse
    {

        if ($userId == null) {
            $citizen = User::with("userGroup")
                ->whereRelation("userGroup", "code", "warga")
                ->get();
        } else {
            $citizen = User::with(['userGroup'])
                ->whereRelation("userGroup", "code", "warga")
                ->where("id", "=", $userId)
                ->first();
        }

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
                "username" => ["required", "unique:users,username,$citizen?->id"],
                "name" => ['required'],
                "email" => ['required', "unique:users,email,$citizen?->id"],
            ];

            /// Jika mode [create], tambahkan validasi password & password_confirmation
            if (empty($citizen)) {
                $rules['password'] = ['required', "confirmed"];
                $rules['password_confirmation'] = ["required"];
            }

            request()->validate($rules);

            $data = [
                "app_group_user_id" => UserGroup::where("code", "=", "warga")->value("id"),
                "username" => $request['username'],
                "name" => $request['name'],
                "email" => $request['email'],
            ];

            /// Jika mode [create], tambahkan input password
            if (empty($citizen)) {
                $data['password'] = $request['password'];
            }

            $result = User::updateOrCreate(['id' => $id], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            $message = !empty($id) ? "Berhasil mengupdate warga dengan nama $citizen->name" : "Berhasil membuat warga dengan nama $request[name]";
            return response()->json([
                'success' => true,
                'message' => $message,
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
