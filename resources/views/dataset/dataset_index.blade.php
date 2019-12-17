@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dataset</h1>
        <div class="button-group">
            <a href="#" class="btn btn-primary pull-right addDataset">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <a id="importExcel" href="#" class="btn btn-success pull-right">
                <i class="fas fa-file-import"></i> Import
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dataset</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="text-dark">
                                        <tr>
                                            <th width="1%">No</th>
                                            <th width="40%">Dataset</th>
                                            <th class="text-center">created_at</th>
                                            <th class="text-center">updated_at</th>
                                            <th class="text-center" width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    @foreach ($item->data as $value)
                                                        [{{ $value }}]
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</td>
                                                <td class="text-center">{{ !empty($item->updated_at) ? \Carbon\Carbon::createFromTimeStamp(strtotime($item->updated_at))->diffForHumans() : '-+-' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning editDataset" data-id="{{ $item->id }}">
                                                        <i class="fas fa-edit fa-sm fa-fw"></i>
                                                    </a>
                                                    <a href="{{ route('dataset.delete', ['id' => $item->id]) }}" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-eraser fa-sm fa-fw"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="modaldetail" tabindex="-1">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="submit_input" method="post">
                    @csrf
                    <div class="modal-body form-dataset">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // var $ = jQuery.noConflict();
        $(document).ready(function () {

            $('.addDataset').click(function (e) {
                e.preventDefault();
                $('#modaldetail').modal('show');
                $('#modaldetail').find('.modal-title').html('Tambah dataset').addClass('text-white');
                $('#modaldetail').find('form').attr('action', '{{ route('dataset.store') }}');
                $.ajax({
                    type: "get",
                    url: "{{ route('atribut.json.all') }}",
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        $.map(response, function (value, key) {
                            // console.log(value);

                            html = '<div class="form-group">';
                            html += '<label for="data[]" class="form-control-label">Nilai '+value.name+'</label>';
                            html += '<select class="form-control col-12" name="data[]" id="data['+key+']">';
                            html += '<option value="">Pilih nilai '+value.name+'</option>';
                            $.map(value.nilai, function (item, index) {
                                html += '<option value="'+item.name+'">'+item.name+'</option>';
                            });
                            html += '</select>';
                            html += '</div>';

                            $('.form-dataset').append(html);
                        });
                    }
                });
            });

            $('.editDataset').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                $('#modaldetail').modal('show');
                $('#modaldetail').find('.modal-title').html('Edit dataset').addClass('text-white');
                var url = '{{ route('dataset.update', ['id' => ':id']) }}';
                url = url.replace(':id', id);
                $('#modaldetail').find('form').attr('action', url);
                $('#modaldetail').find('form').prepend('{{ method_field('PUT') }}');
                $.ajax({
                    type: "get",
                    url: "{{ route('atribut.json.all') }}",
                    dataType: "json",
                    success: function (response) {
                        var html = '';
                        $.map(response, function (value, key) {
                            // console.log(value);

                            html = '<div class="form-group">';
                            html += '<label for="data[]" class="form-control-label">Nilai '+value.name+'</label>';
                            html += '<select class="form-control col-12" name="data[]" id="data['+key+']">';
                            html += '<option value="">Pilih nilai '+value.name+'</option>';
                            $.map(value.nilai, function (item, index) {
                                html += '<option value="'+item.name+'">'+item.name+'</option>';
                            });
                            html += '</select>';
                            html += '</div>';

                            $('.form-dataset').append(html);
                        });
                        getValueDataset();
                    }
                });
                function getValueDataset() {
                    $.ajax({
                        type: "get",
                        url: "{{ route('dataset.json.id') }}",
                        data: {id: id},
                        dataType: "json",
                        success: function (response) {
                            $.map(response.data, function (value, key) {
                                $('#modaldetail').find('select[id="data['+key+']"]').val(value);
                            });
                        }
                    });
                }
            });

            $('#importExcel').click(function (e) {
                e.preventDefault();
                $('#modaldetail').modal('show');

                $('#modaldetail').find('.modal-title').html('Import Dataset dari Excel').addClass('text-white');
                $('#modaldetail').find('form').attr('action', '{{ route('import.excel') }}');
                $('#modaldetail').find('form').attr('enctype', 'multipart/form-data');

                var html = '<div class="form-group"><input type="file" class="form-control col-12" name="excel" id="excel"></div>';
                $(html).appendTo('.form-dataset');
            });

            $('#modaldetail').on('hide.bs.modal', function(){
                $('.form-group').remove();
            });

        });
    </script>
@endpush
