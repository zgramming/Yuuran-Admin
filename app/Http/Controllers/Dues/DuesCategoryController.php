<?php

namespace App\Http\Controllers\Dues;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\Dues\DuesCategory;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloqBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class DuesCategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $keys = [];
        return view("modules.dues.category.grids.dues_category_grids", $keys);
    }

    /**
     * @return View|Factory|Application|JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function datatable(): View|Factory|Application|JsonResponse
    {
        if (!request()->ajax()) return view('error.notfound');

        $values = DuesCategory::whereNotNull("id");
        $datatable = DataTables::of($values)
            ->addIndexColumn()
            ->filter(function (EloqBuilder $query) {
                $search = request()->get('search');
                if (!empty($search)) {
                    $query->where('code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
                }
            })->addColumn("amount", function (DuesCategory $item) {
                return "Rp." . number_format($item->amount, 2, ',');
            })->addColumn('status', function (DuesCategory $item) {
                if ($item->status == "active") return "<span class=\"badge bg-success\">Aktif</span>";
                if ($item->status == "not_active") return "<span class=\"badge bg-danger\">Tidak Aktif</span>";
                return "<span class=\"badge bg-secondary\">None</span>";
            })->addColumn('action', function (DuesCategory $item) {
                $urlUpdate = url('dues/category/form_modal/' . $item->id);
                $urlDelete = url('dues/category/delete/' . $item->id);
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
            })->rawColumns(['amount', 'status', 'action']);

        return $datatable->toJson();
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function form_modal(int $id = 0): View|Factory|Application
    {

        $keys = [];
        $keys['category'] = DuesCategory::find($id);
        $keys['statuses'] = Constant::STATUSKEYVALUE;
        return \view("modules.dues.category.forms.form_modal", $keys);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function save(int $id = 0): JsonResponse
    {
        try {
            DB::beginTransaction();
            $category = DuesCategory::find($id);
            $post = request()->all();

            $rules = [
                "name" => ['required'],
                "code" => ['required', "unique:dues_category,code," . $category?->id ?? 0],
                "amount" => ['required'],
                "description" => ['required'],
                "status" => ['required'],
            ];

            $validator = Validator::make($post, $rules);
            if ($validator->fails()) return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
            ], 400);

            $data = [
                "name" => $post['name'],
                "code" => $post['code'],
                "description" => $post['description'],
                "amount" => fromCurrency($post['amount']),
                "status" => $post['status'],
            ];

            $result = DuesCategory::updateOrCreate(['id' => $category?->id], $data);
            if (!$result) throw new Exception("Terjadi kesalahan saat proses penyimpanan, lakukan beberapa saat lagi...", 400);

            /// Commit Transaction
            $message = empty($category) ? "Berhasil membuat kategori" : "Berhasil mengupdate kategori";
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
     * @param int $id
     * @return JsonResponse|Redirector|Application|RedirectResponse
     * @throws Throwable
     */
    public function delete(int $id = 0): JsonResponse|Redirector|Application|RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category = DuesCategory::find($id);
            $category->deleteOrFail();

            /// Commit Transaction
            DB::commit();

            return redirect('dues/category')->with('success', "Berhasil menghapus kategori $category->name");

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
