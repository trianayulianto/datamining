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
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Desicion Tree</h6>
                        <a id="exportExcel" href="{{ route('hitung.index') }}" class="m-0 font-weight-bold text-primary">
                            <i class="fas fas fa-arrow-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <h4><i class="fas fas fa-arrow-circle-right"></i> Data Uji perhitungan:</h4>
                    @for ($i = 0; $i < count($dataUjicoba['data']); $i++)
                        <span class="badge badge-success">{!! strtoupper($attributes[$i+1]).' <i class="fas fas fa-arrow-right"></i> "'.$dataUjicoba['data'][$i].'"' !!}</span>
                    @endfor
                    <hr>
                    <h4><i class="fas fa-check-circle"></i> {{ $hasilUjicoba }}</h4>
                    <hr>
                    <h5><i class="fas fa-code-branch"></i> Dengan Rule yang dihasilkan adalah:</h5>
                    <div id="printRules" class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var ruleUjicoba = '{!! $ruleUjicoba !!}';

        $(document).ready(function () {
            $(ruleUjicoba).appendTo('#printRules');

            var html = $('.c45').eq(0).clone();

            $('ul').eq(0).clone().appendTo('#printRules');

            $('.c45').first().remove();

            $('ul').show();

        });

    </script>
@endpush
