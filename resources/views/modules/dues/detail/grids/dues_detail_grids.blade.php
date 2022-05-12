@extends('templates.template')
@section('title_header') Kategori Iuran @endsection

@section('extends-css')
@endsection

@section('content')
    <div class="d-flex flex-sm-column flex-md-row flex-lg-row justify-content-between my-3">
        <div>
            <h3>Detail Iuran</h3>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dues/transaction') }}">Iuran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi Iuran</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content mt-3">
                    <div class="card-body">

                        <div class="table-filter mb-3">
                            <div class="row">

                                <div class="col-sm-12 col-md-8">
                                    <div class="d-flex flex-row">

                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" id="search" class="form-control"
                                                   placeholder="Cari berdasarkan...">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>

                                        <div class="form-group mx-2">
                                            <select name="filter_category" id="filter_category"
                                                    class="form-select select2-custom">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mx-2">
                                            <select name="filter_month" id="filter_month"
                                                    class="form-select select2-custom">
                                                <option value="">Pilih Bulan</option>
                                                @foreach($months as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mx-2">
                                            <select name="filter_year" id="filter_year"
                                                    class="form-select select2-custom">
                                                <option value="">Pilih Tahun</option>
                                                @foreach($years as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 mb-sm-3">
                                    <div class="d-flex flex-row justify-content-md-end justify-content-sm-start ">
                                        <div class="form-group">
                                            <div class="buttons">
                                                <a href="#" class="btn btn-success"
                                                   onclick="openBox('{{url('dues/transaction/form_modal/0')}}')"><span
                                                        class="btn-label"><i class="fa fa-plus"></i></span> Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                @include('templates.components.messages.errors.witherrors',['errors' => $errors])
                                @include('templates.components.messages.success.withsuccess',['message' => $message = Session::get('success')])
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" style="width: 100%" id="table_datatable">
                                <thead>
                                <tr>
                                    <th style="min-width: 50px">No</th>
                                    <th style="min-width: 200px">Kategori</th>
                                    <th style="min-width: 200px">Warga</th>
                                    <th style="min-width: 200px">Bulan</th>
                                    <th style="min-width: 100px">Tahun</th>
                                    <th style="min-width: 200px">Jumlah</th>
                                    <th style="min-width: 200px">Status</th>
                                    <th style="min-width: 200px">Created At</th>
                                    <th style="min-width: 200px">Updated At</th>
                                    <th style="min-width: 50px">Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extends-js')
    <script type="text/javascript">
        $(document).ready(function () {
            const url = `{{url('dues/transaction/datatable')}}`;
            const jqueryDatatable = $("#table_datatable").DataTable({
                processing: true,
                serverSide: true,
                // [https://www.itsolutionstuff.com/post/laravel-datatables-filter-with-dropdown-exampleexample.html]
                ajax: {
                    url: url,
                    data: function (d) {
                        d.search = $('#search').val();
                        d.category = $("#filter_category").val();
                        d.month = $("#filter_month").val();
                        d.year = $("#filter_year").val();
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'dues_category.name', orderable: false},
                    {data: 'user.name', orderable: false},
                    {data: 'month', orderable: false},
                    {data: 'year', orderable: false},
                    {data: 'amount', orderable: false},
                    {data: 'status', orderable: false},
                    {data: 'created_at', orderable: false},
                    {data: 'updated_at', orderable: false},
                    {data: 'action', orderable: false},
                ],
                createdRow: function (row, data, dataIndex) {
                },

            });

            $("#filter_category, #filter_month, #filter_year").on('change', function () {
                jqueryDatatable.draw();
            });

            $("#search").keyup(debounce(function () {
                jqueryDatatable.draw();
            }, 500));
        });

    </script>
@endsection
