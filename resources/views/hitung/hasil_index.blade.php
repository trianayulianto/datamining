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
                    <h6 class="m-0 font-weight-bold text-primary">Hasil Uji</h6>
                </div>
                <div class="card-body">
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
