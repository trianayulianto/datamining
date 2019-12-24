@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perhitungan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data yang diketahui</h6>
                </div>
                <div class="card-body">
                    <div class="col-mb-12">
                        <form class="formUji" action="{{ route('hasil.index') }}" method="get">
                            <button type="submit" class="btn btn-md btn-success btnSubmit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        function dataForm() {
            $.ajax({
                type: "get",
                url: "{{ route('atribut.json.all') }}",
                dataType: "json",
                success: function (response) {
                    var html = '';
                    for (let index = 0; index < (response.length - 1); index++) {
                        // const element = response[index].name;
                        html = '<div class="form-group">';
                        html += '<label for="data[]" class="form-control-label">Nilai '+response[index].name+'</label>';
                        html += '<select class="form-control col-12" name="data[]" id="data['+index+']">';
                        html += '<option value="">Pilih nilai '+response[index].name+'</option>';
                        $.map(response[index].nilai, function (item, index) {
                            html += '<option value="'+item.name+'">'+item.name+'</option>';
                        });
                        html += '</select>';
                        html += '</div>';

                        // $('.formUji').append(html);
                        $('.btnSubmit').before(html);
                    }
                    // $.map(response, function (value, key) {
                    // });
                }
            });
        }

        $(document).ready(function () {
            dataForm();
        });

    </script>
@endpush
