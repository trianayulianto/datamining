@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Atribut</h1>
        <div class="button-group">
            <a href="#" class="btn btn-primary pull-right addAtribut">
                <i class="fas fa-plus"></i> Tambah
            </a>
            {{-- <a href="#" class="btn btn-success pull-right">
                <i class="fas fa-file-import"></i> Import
            </a> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Atribut</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="text-dark">
                                        <tr>
                                            <th width="1%">No</th>
                                            <th width="40%">Nama</th>
                                            <th class="text-left">Nilai Atribut</th>
                                            <th class="text-center">created_at</th>
                                            <th class="text-center">updated_at</th>
                                            <th class="text-center" width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-left">
                                                    @foreach ($item->nilai as $i => $row)
                                                        <div class="text-left"><a href="{{ route('nilai.delete', ['id' => $row->id]) }}"><i class="fas fa-eraser fa-sm text-danger mr-4"></i></a>{{ $row->name }}</div>
                                                    @endforeach
                                                    <a href="#" class="text-left addNilai" id="add_nilai" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class="fas fa-plus fa-sm text-primary mr-4"></i></a>Tambah
                                                </td>
                                                <td class="text-center">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</td>
                                                <td class="text-center">{{ !empty($item->updated_at) ? \Carbon\Carbon::createFromTimeStamp(strtotime($item->updated_at))->diffForHumans() : '-+-' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning editAtribut" data-id="{{ $item->id }}">
                                                        <i class="fas fa-edit fa-sm fa-fw"></i>
                                                    </a>
                                                    <a href="{{ route('atribut.delete', ['id' => $item->id]) }}" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-eraser fa-sm fa-fw"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nilai Atribut</label>
                            <input type="text" name="name" id="name" class="form-control col-12">
                        </div>
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
            $('.addNilai').click(function (e) {
                e.preventDefault();
                var id_atribut = $(this).attr('data-id');
                var name_atribut = $(this).attr('data-name');
                $('#modaldetail').modal('show');
                $('#modaldetail').find('.modal-title').html('Tambah nilai atribut '+name_atribut).addClass('text-white');
                $('#modaldetail').find('form').attr('action', '{{ route('nilai.store') }}');
                $('input[name="_token"]').after('<input type="hidden" name="atribut_id" value="'+id_atribut+'">');
            });

            $('.addAtribut').click(function (e) {
                e.preventDefault();
                $('#modaldetail').modal('show');
                $('#modaldetail').find('.modal-title').html('Tambah atribut baru').addClass('text-white');
                $('#modaldetail').find('form').attr('action', '{{ route('atribut.store') }}');
            });

            $('.editAtribut').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                $('#modaldetail').modal('show');
                $('#modaldetail').find('.modal-title').html('Edit atribut').addClass('text-white');
                $('#modaldetail').find('form').attr('action', '{{ route('atribut.store') }}');
                var url = '{{ route('atribut.update', ['id' => ':id']) }}';
                url = url.replace(':id', id);
                $('#modaldetail').find('form').attr('action', url);
                $('#modaldetail').find('form').prepend('{{ method_field('PUT') }}');
                $.ajax({
                    type: "get",
                    url: "{{ route('atribut.json') }}",
                    data: {id: id},
                    dataType: "json",
                    success: function (response) {
                        if (response != []) {
                            $('#modaldetail').find('input[name="name"]').val(response.name);
                        }
                    }
                });
            });
        });
    </script>
@endpush
