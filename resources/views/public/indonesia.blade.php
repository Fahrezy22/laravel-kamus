@extends('layout.topnav')
@section('css')
<link rel="stylesheet" href="{{asset('template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
@endsection
@section('headtittle')
KAMUS | INDONESIA - KAILI
@endsection
@section('explaintitle')
Indonesia - Kaili
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukan Kata </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="indo" class="label-control"></label>
                            <select name="search" id="search" class="form-control select2">
                                <option value="" selected></option>
                                @foreach ($data as $d)
                                    <option value="{{$d->indonesia}}">{{$d->indonesia}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hasil terjemahan</h4>
            </div>
            <div class="card-body">
                <table class="table" style="border: none">
                    <thead>
                        <tr>
                            <th>Indonesia</th>
                        <th>Kaili</th>
                        <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><input id="translateIndo" type="text" style="border: none" readonly></td>
                        <td ><input id="translateDaerah" type="text" style="border: none" readonly></td>
                        <td ><input id="translateJenis" type="text" style="border: none" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hasil Serupa</h4>
            </div>
            <div class="card-body">
                <div class="result">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('template/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('template/assets/js/page/modules-toastr.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#search').select2();

        $("#search").change(function () {
            var search = $('#search').val();
            $.ajax({
                url: '{{route('search')}}',
                data: {
                    'search': search
                },
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#translateIndo').val(data[0].indonesia);
                    $('#translateDaerah').val(data[0].daerah);
                    $('#translateJenis').val(data[0].jenis);
                    var i = 0;
                    var table = '<table class="table style="border: none"" id="hasil-serupa"><thead><tr><th>Indonesia</th><th>Kaili</th><th>Jenis</th></tr></thead><tbody>';
                    $.each(data[1], function(i, item) {
                        table += ('<tr>');
                        table += ('<td>' + item.indonesia + '</td>');
                        table += ('<td>' + item.daerah + '</td>');
                        table += ('<td>' + item.jenis + '</td>');
                        table += ('</tr>');
                    });
                    table += '</tbody></table>';
                    $(".result").html(table);
                },
            });
        });
    });
</script>
@endsection