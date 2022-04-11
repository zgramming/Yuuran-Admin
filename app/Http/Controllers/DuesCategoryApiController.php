<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Throwable;

class DuesCategoryApiController extends Controller
{
    /**
     * @param int|null $duesCategoryId
     * @return JsonResponse
     */
    public function get(?int $duesCategoryId = null): JsonResponse
    {
        if ($duesCategoryId == null) $result = DuesCategory::all();
        else $result = DuesCategory::find($duesCategoryId);

        return response()->json(['success' => true, 'data' => $result]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            $duesCategory = DuesCategory::find($id);
            $request = request()->all();

            $rules = [
                'code' => ["required", "unique:dues_category,code,$duesCategory?->id" ],
                'name' => "required",
                'amount' => ["required", 'integer']
            ];

            request()->validate($rules);

            $data = [
                "code" => $request['code'],
                "name" => $request['name'],
                'amount' => $request['amount'],
                "description" => $request['description'],
            ];

            $result = DuesCategory::updateOrCreate(['id' => $id], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            $message = !empty($id) ? "Berhasil mengupdate kategori $duesCategory->name" : "Berhasil membuat kategori dengan nama $request[name]";

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
