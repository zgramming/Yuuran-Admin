<?php

namespace App\Http\Controllers\Dues;

use App\Http\Controllers\Controller;
use App\Models\Dues\DuesCategory;
use App\Models\Dues\DuesDetail;
use App\Models\User;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class DuesDetailController extends Controller
{
    /**
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(): View|Factory|Application
    {
        $keys = [];
        $keys['categories'] = DuesCategory::all();
        $keys['users'] = User::with(['userGroup'])
            ->whereRelation("userGroup", "code", "=", "warga")
            ->get();
        $keys['months'] = generateMonths();
        $keys['years'] = generateYear(2020, date('Y'));

        return view("modules.dues.detail.grids.dues_detail_grids", $keys);
    }

    /**
     * @return View|Factory|Application|JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function datatable(): Factory|View|JsonResponse|Application
    {
        if (!request()->ajax()) return view('error.notfound');

        $request = request()->all();
        $values = DuesDetail::with(['duesCategory', 'user'])
            ->whereNotNull("id");

        /// Filtering Manual
        if (!empty($request['category'])) $values = $values->whereRelation("duesCategory", "id", "=", $request['category']);
        if (!empty($request['month'])) $values = $values->where("month", "=", $request['month']);
        if (!empty($request['year'])) $values = $values->where("year", "=", $request['year']);
        if (!empty($request['search'])) {
            $values = $values
                ->whereRelation("user", "name", "like", "%$request[search]%");
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
            })->addColumn('action', function (DuesDetail $item) {
                $urlUpdate = url('dues/transaction/form_modal/' . $item->id);
                $urlDelete = url('dues/transaction/delete/' . $item->id);
                $field = csrf_field();
                $method = method_field('DELETE');
                return "
                <div class='d-flex flex-row'>
                    <a href=\"#\" class=\"btn btn-primary mx-1\" onclick=\"openBox('$urlUpdate')\"><i class='fa fa-edit'></i></a>
                    <form action=\"$urlDelete\" method=\"post\">
                        $field
                        $method
                        <button type=\"submit\" class=\"btn btn-danger mx-1\"><i class=\"fa fa-trash\"></i></button>
                    </form>
                </div>
            ";
            })->rawColumns(['amount', 'month', 'status', 'action']);

        return $datatable->make(true);
    }

    /**
     * @param string $id
     * @return Factory|View|Application
     * @throws Exception
     */
    public function form_modal(string $id = ""): Factory|View|Application
    {
        $keys = [];

        $keys['categories'] = DuesCategory::all();
        $keys['users'] = User::with(['userGroup'])->whereRelation("userGroup", "code", "warga")->get();
        $keys['months'] = generateMonths();
        $keys['years'] = generateYear(2020, date('Y'));

        $keys['dues'] = DuesDetail::with(["user", "user.userGroup", "duesCategory"])->where("id", $id)->first();

        return view("modules.dues.detail.forms.form_modal", $keys);
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function save(string $id = ""): JsonResponse
    {
        try {
            $dues = DuesDetail::find($id);

            $request = request()->all();

            $rules = [
                "dues_category_id" => ['required'],
                "users_id" => ['required'],
                "month" => ['required'],
                "year" => ['required'],
                "amount" => ['required'],
                "status" => ['required'],
            ];

            $validator = Validator::make($request, $rules);
            if ($validator->fails()) return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
            ], 400);

            /// Check if dues is exists in database [users_id, month, year, dues_category_id]
            $citizenDues = DuesDetail::with(['user', 'duesCategory'])
                ->where("users_id", $request['users_id'])
                ->where("month", $request['month'])
                ->where("year", $request['year'])
                ->where("dues_category_id", $request['dues_category_id']);

            /// Jika mode update, abaikan iuran dengan ID [$dues->id]
            /// Ini untuk mengakomodir jika kita mengupdate iuran yang sama
            /// Tetapi hanya ingin mengupdate beberapa item, misalnya [amount, description, dll)
            if (!empty($dues)) $citizenDues = $citizenDues->where("id", "!=", $dues->id);
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
                "amount" => fromCurrency($request['amount']),
                "status" => $request['status'],
                "description" => $request['description'],
            ];

            $result = DuesDetail::updateOrCreate(['id' => $dues?->id], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            /// Commit Transaction
            $message = empty($dues) ? "Berhasil membuat Iuran" : "Berhasil mengupdate Iuran";
            session()->flash('success', $message);
            DB::commit();

            return response()->json(['success' => true, 'message' => $message]);
        } catch (QueryException $e) {
            $message = $e->getMessage();

            /// Rollback Transaction
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => $message], 500);
        } catch (Throwable $e) {
            $message = $e->getMessage();
            $code = $e->getCode() ?: 400;

            /// Rollback Transaction
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => $message], $code);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse|Redirector|Application|RedirectResponse
     * @throws Throwable
     */
    public function delete(string $id = ""): JsonResponse|Redirector|Application|RedirectResponse
    {
        try {
            DB::beginTransaction();

            $dues = DuesDetail::find($id);
            $dues->deleteOrFail();

            /// Commit Transaction
            DB::commit();

            return redirect('dues/transaction')->with('success', "Berhasil menghapus Iuran dengan ID $dues->id");

        } catch (QueryException $e) {
            $message = $e->getMessage();

            /// Rollback Transaction
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => $message], 500);
        } catch (Throwable $e) {
            /// Rollback Transaction
            DB::rollBack();

            $message = $e->getMessage();
            return back()->withErrors($message)->withInput();
        }
    }
}
