<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DuesCategory;
use App\Models\DuesDetail;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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
            'data' => DuesDetail::with(['user', "duesCategory"])->find($idDuesDetail)
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
        $totalCitizen = User::with("userGroup")->whereRelation("userGroup", "code", "warga")->count("id");
        $statistics = DuesCategory::with([
            "duesDetail" => function (Builder $q) use ($month, $year) {
                $q->where("month", "=", $month)
                    ->where("year", "=", $year);
            },
            "duesDetail.user"
        ])->get();

        return response()->json([
            'success' => true,
            'data' => [
                "total_citizen" => $totalCitizen,
                "statistic" => $statistics,
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

        return response()->json(['success' => true, 'data' => $dues]);
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
     * @throws Throwable
     */
    public function save(string $idDuesDetail = "")
    {
        /// Begin Transaction
        DB::beginTransaction();
        try {
            $duesDetail = DuesDetail::find($idDuesDetail);
            $rules = [
                ""
            ];
            DB::commit();

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
