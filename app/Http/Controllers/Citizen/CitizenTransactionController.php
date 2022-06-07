<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Dues\DuesCategory;
use App\Models\Dues\DuesDetail;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CitizenTransactionController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): Factory|View|Application
    {
        $keys = [];

        $keys['categories'] = DuesCategory::all();
        $keys['months'] = generateMonths();
        $keys['years'] = generateYear(2020, date('Y'));

        return view("modules.citizen.transaction.transaction_grids", $keys);

    }

    /**
     * @throws Exception
     */
    public function datatable(): View|Factory|Application|JsonResponse
    {
        if (!request()->ajax()) return view('error.notfound');
        $request = request()->all();
        $values = DuesDetail::with(['duesCategory', 'user'])
            ->where("users_id", auth()->id())
            ->whereNotNull("id");

        if (!empty($request['category'])) $values = $values->where("dues_category_id", $request['category']);
        if (!empty($request['month'])) $values = $values->where("month", "=", $request['month']);
        if (!empty($request['year'])) $values = $values->where("year", "=", $request['year']);
        if (!empty($request['search'])) {
            $values = $values->where("amount", $request['search']);
        }

        $datatable = DataTables::of($values)
            ->addIndexColumn()
            ->addColumn("amount", function (DuesDetail $item) {
                return "Rp." . number_format($item->amount, 2, ',');
            })->addColumn("month", function (DuesDetail $item) {
                return date("F", mktime(hour: 0, month: $item->month));
            })->addColumn('status', function (DuesDetail $item) {
                if ($item->status == "paid_off") return "<span class=\"badge bg-success\">Lunas</span>";
                if ($item->status == "not_paid_off") return "<span class=\"badge bg-warning\">Belum Lunas</span>";
                return "<span class=\"badge bg-secondary\">None</span>";
            })
            ->rawColumns(['amount', 'month', 'status']);

        return $datatable->toJson();
    }
}
