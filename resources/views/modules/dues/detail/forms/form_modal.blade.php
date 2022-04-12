<div class="modal-header-custom p-4" style="border-bottom: 1px solid #dee2e6;">
    <div class="d-flex flex-row justify-content-between align-items-end">
        <h4 class="modal-title" id="modal-default-label">{{ ($dues == null) ? "Form Tambah" : "Form Update" }}</h4>
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i
                class="fa fa-times"></i></button>
    </div>
</div>

<div class="modal-body">
    <form action="{{ url("dues/transaction/save",[$dues?->id ?? 0]) }}" method="POST" enctype="multipart/form-data"
          id="form_validation">

        <div class="row mb-3">
            <label for="dues_category_id" class="col-sm-12 col-md-12 col-form-label">Kategori</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="dues_category_id" id="dues_category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $key => $value)
                                <option
                                    value="{{$value->id}}" {{($dues?->dues_category_id == $value->id ? "selected" : "")}}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="users_id" class="col-sm-12 col-md-12 col-form-label">Warga</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="users_id" id="users_id">
                            <option value="">Pilih Warga</option>
                            @foreach($users as $key => $value)
                                <option
                                    value="{{$value->id}}" {{($dues?->users_id == $value->id ? "selected" : "")}}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="year" class="col-sm-12 col-md-12 col-form-label">Tahun</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="year" id="year">
                            <option value="">Pilih Tahun</option>
                            @foreach($years as $key => $value)
                                <option
                                    value="{{$key}}" {{($dues?->year == $key ? "selected" : "")}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="month" class="col-sm-12 col-md-12 col-form-label">Bulan</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="month" id="month">
                            <option value="">Pilih Bulan</option>
                            @foreach($months as $key => $value)
                                <option
                                    value="{{$key}}" {{($dues?->month == $key ? "selected" : "")}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="amount" class="col-sm-12 col-md-12 col-form-label">Jumlah Iuran</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="amount" class="form-control" id="amount"
                       value="{{toCurrency($dues?->amount ?? 0)}}" onkeyup="toCurrency(this)" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-sm-12 col-md-12 col-form-label">Deskripsi</label>
            <div class="col-sm-12 col-md-12">
                <textarea name="description" id="description" class="form-control"
                          rows="3">{{$dues?->description}}</textarea>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="status" class="col-sm-12 col-md-12 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10 ">
                <div class="d-flex flex-column">
                    <div class="radio-container">
                        @foreach(["paid_off"=>"Lunas","not_paid_off"=>"Belum Lunas"] as $key => $value)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_{{$key}}"
                                       value="{{$key}}" {{ ($dues?->status ?? 'paid_off') == $key ? "checked" : ""}}>
                                <label class="form-check-label" for="status_{{$key}}">{{$value}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="paid_by_someone_else" class="col-sm-12 col-md-12 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10 ">
                <div class="checkbox">
                    <input type="checkbox" name="paid_by_someone_else" id="paid_by_someone_else"
                           class='form-check-input'
                           value="1" {{ $dues?->paid_by_someone_else == 1 ? "checked" : "" }}>
                    <label for="paid_by_someone_else">Diwakilkan Orang Lain</label>
                </div>
            </div>
        </div>

        @csrf
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-sm-block d-none">Close</span>
    </button>
    <button type="submit" class="btn btn-primary" name="btn-submit" form="form_validation">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-sm-block d-none">Submit</span>
    </button>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#form_validation").validate({
            rules: {},
            messages: {}
        });

        $('#form_validation').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            if (!form.valid()) return false;

            let data = new FormData(form[0]);
            let url = `{{ url("dues/transaction/save",[$dues?->id ?? 0]) }}`;

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    let modal = $("#modal-default");
                    modal.modal('hide');
                    location.reload();
                }
            }).fail(function (xhr, textStatus) {
                console.log("XHR Fail Console", xhr);
                let errors = xhr.responseJSON?.errors ?? xhr.responseJSON?.message ?? "Terjadi masalah, coba beberapa saat lagi";
                showErrorsOnModal(errors);
            }).done(function (xhr, textStatus) {
                console.log("done : ", xhr);
            });
        })
    });
</script>
