<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Dues\DuesCategory;
use App\Models\Dues\DuesDetail;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PHPUnit\Util\Exception;
use Throwable;

class DuesApiController extends Controller
{
    /**
     * @param string $idDuesDetail
     * @return JsonResponse
     */
    public function get(string $idDuesDetail = ""): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => DuesDetail::with(['user', 'user.userGroup', "duesCategory"])->find($idDuesDetail)
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function statistics(): JsonResponse
    {
        $request = request()->all();
        $month = $request['month'] ?? date('m');
        $year = $request['year'] ?? date('Y');

        /// Get User where code usergroup == "warga"
        $totalCitizen = User::with(["userGroup"])->whereRelation("userGroup", "code", "warga")->count("id");
        $statistics = DuesCategory::with([
            "duesDetail" => function (Builder $q) use ($month, $year) {
                $q->where("month", "=", $month)
                    ->where("year", "=", $year);
            },
            "duesDetail.user",
            "duesDetail.duesCategory"
        ])->get();

        return response()->json([
            'success' => true,
            'data' => [
                "total_citizen" => $totalCitizen,
                "dues_category" => $statistics,
            ],
        ], 200);
    }

    /**
     * @return JsonResponse
     */
    public function recentActivity(): JsonResponse
    {
        $request = request()->all();
        $month = $request['month'] ?? date('m');
        $year = $request['year'] ?? date('Y');

        $limit = $request['limit'] ?? null;
        $recentActivity = DuesDetail::with(
            [
                "user",
                "duesCategory"
            ])
            ->whereMonth("created_at", "=", $month)
            ->whereYear("created_at", "=", $year)
            ->orderBy("created_at", "DESC");

        if ($limit != null) $recentActivity = $recentActivity->limit($limit);

        return response()->json([
            'success' => true,
            'data' => $recentActivity->get(),
        ], 200);
    }

    /**
     * @param string $username
     * @return JsonResponse
     */
    public function duesByUsername(string $username): JsonResponse
    {
        $request = request()->all();
        $month = $request['month'] ?? date('m');
        $year = $request['year'] ?? date('Y');
        $category = $request['duesCategory'] ?? null;

        $dues = DuesDetail::with([
            "duesCategory",
            "user"
        ])->whereRelation("user", "username", "=", $username)
            ->where("month", "=", $month)
            ->where("year", "=", $year);

        if ($category != null) $dues = $dues->whereRelation("duesCategory", "id", "=", $category);

        $dues = $dues->get();
        $citizen = User::with(["userGroup"])->where("username", "=", $username)->first();
        return response()->json(['success' => true,
            'data' => [
                "citizen" => $citizen,
                "dues" => $dues,
            ]
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function calendar(): JsonResponse
    {
        $request = request()->all();
        $month = $request['month'] ?? date('m');
        $year = $request['year'] ?? date('Y');

        $dues = DuesDetail::with([
            "duesCategory",
            "user"
        ])->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->get();

        return response()->json(['success' => true, 'data' => $dues]);
    }

    /**
     * @return JsonResponse
     */
    public function calendarDetail(): JsonResponse
    {
        $request = request()->all();

        $year = $request['year'] ?? date('Y');
        $month = $request['month'] ?? date('m');
        $day = $request['day'] ?? date('d');

        $dues = DuesDetail::with([
            "duesCategory",
            "user"
        ])
            ->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->whereDay("created_at", "=", $day)
            ->get();

        return response()->json(['success' => true, 'data' => $dues]);
    }

    /**
     * @param string $idDuesDetail
     * @return JsonResponse
     * @throws Throwable
     */
    public function save(string $idDuesDetail = ""): JsonResponse
    {
        try {
            /// Begin Transaction
            DB::beginTransaction();

            $duesDetail = DuesDetail::find($idDuesDetail);
            $request = request()->all();

            $rules = [
                "dues_category_id" => ['required', 'integer'],
                "users_id" => ['required', 'integer'],
                "month" => ['required', 'integer'],
                "year" => ['required', 'integer'],
                "amount" => ['required', 'integer'],
                "status" => ['required'],
            ];

            request()->validate($rules);

            /// Check if dues is exists in database [users_id, month, year, dues_category_id]
            $citizenDues = DuesDetail::with(['user', 'duesCategory'])
                ->where("users_id", $request['users_id'])
                ->where("month", $request['month'])
                ->where("year", $request['year'])
                ->where("dues_category_id", $request['dues_category_id']);

            /// Jika mode update, abaikan iuran dengan ID [$duesDetail->id]
            /// Ini untuk mengakomodir jika kita mengupdate iuran yang sama
            /// Tetapi hanya ingin mengupdate beberapa item, misalnya [amount, description, dll)
            if (!empty($duesDetail)) $citizenDues = $citizenDues->where("id", "!=", $duesDetail->id);
            $citizenDues = $citizenDues->first();

            /// Jika Iuran sudah ada dengan [nama, bulan, tahun] yang difilter
            /// Tampilkan pesan error "Iuran Zeffry Reynando untuk Bulan April 2022 sudah ada"
            if ($citizenDues != null) {
                $name = $citizenDues->user->name;
                $category = $citizenDues->duesCategory->name;
                $monthName = date("F", mktime(0, 0, 0, $request['month'], 10));
                throw new Exception("$category $name untuk bulan $monthName $request[year] sudah ada.", 400);
            }
            $data = [
                "dues_category_id" => $request['dues_category_id'],
                "users_id" => $request['users_id'],
                "month" => $request['month'],
                "year" => $request['year'],
                "amount" => $request['amount'],
                "status" => $request['status'],
                "paid_by_someone_else" => $request['paid_by_someone_else'],
                "description" => $request['description'] ?? null,
                "created_by" => $request['created_by'] ?? null,
            ];

            $result = DuesDetail::updateOrCreate(['id' => $idDuesDetail], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            DB::commit();

            return response()->json([
                "success" => true,
                "message" => empty($duesDetail) ? "Berhasil membuat Iuran" : "Berhasil mengupdate Iuran",
            ], 200);
        } catch (ValidationException $validationException) {
            /// Rollback Transaction
            DB::rollBack();

            return response()->json([
                'success' => false,
                'title' => $validationException->getMessage(),
                'message' => implode("\n", Arr::flatten($validationException->errors()))
            ], $validationException->status);
        } catch (QueryException $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
//            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], 500);
        } catch (Throwable $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            $code = $e->getCode() ?: 500;

            return response()->json([
                "success" => false,
                "message" => $message,
            ], $code);
        }
    }
}
