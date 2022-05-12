@extends('layout.master')
@section('title')
KAMUS | INDONESIA-KAILI
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
@endsection
@section('secHeader')Kamus Indonesia - Kaili @endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Kata</h4>
                <div class="card-header-action">
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary " href="javascript:void(0)" id="add">Tambah</a>
                        <a class="btn btn-secondary ml-1" href="javascript:void(0)" id="import">Import</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Index</th>
                                <th>Indonesia</th>
                                <th>Kaili</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
<div id="univModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelheader"></h4>
            </div>
            <form id="ItemForm" name="ItemForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Indonesia :</label>
                        <input type="text" name="indonesia" class="form-control" id="indonesia" placeholder="Isi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kaili :</label>
                        <input type="text" name="daerah" class="form-control" id="daerah" placeholder="Isi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Jenis :</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="" selected disabled>--Pilih--</option>
                            <option value="Kata Kerja">Kata Kerja</option>
                            <option value="Kata Benda">Kata Benda</option>
                            <option value="Kata Sifat">Kata Sifat</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="batal" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    <button type="submit" id="simpan" class="btn btn-primary">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelheader">Hapus Data</h4>
            </div>
            <div class="modal-body">
                <h3>Apakah anda yakin akan menghapus data <strong id="dt"></strong></h3>
            </div>
            <div class="modal-footer">
                <button type="button" id="batal" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <a id="deletebutton" href="" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>

<div id="import-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelheader">Import</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="form-label">Excel</label>
                        <input type="file" class="form-control" name="excel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="batal" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@section('js')
<script src="{{asset('template/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('template/assets/js/page/modules-toastr.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('kamus.index')}}",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'indonesia',
                    name: 'indonesia'
                },
                {
                    data: 'daerah',
                    name: 'daerah'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add').click(function() {
            $('#simpan').val("create-Item");
            $('#id').val('');
            $('#ItemForm').trigger("reset");
            $('#modelheader').html("Tambah Data Baru");
            $('#univModal').modal('show');
        });

        $('#import').click(function() {
            $('#import-modal').modal('show');
        });

        $('body').on('click', '.editItem', function() {
            var Item_id = $(this).data('id');
            $.get("{{ route('kamus.index') }}" + '/' + Item_id + '/edit', function(data) {
                $('#modelheader').html("Edit Data");
                $('#simpan').val("edit-user");
                $('#univModal').modal('show');
                $('#id').val(data.id);
                $('#indonesia').val(data.indonesia);
                $('#daerah').val(data.daerah);
                $('#jenis').val(data.jenis);
            })
        });

        $('#simpan').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#ItemForm').serialize(),
                url: "{{ route('kamus.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#ItemForm').trigger("reset");
                    $('#simpan').html("simpan");
                    $('#univModal').modal('hide');
                    var oTable = $('#example').DataTable();
                    iziToast.success({
                        title: 'Success',
                        message: 'Data Berhasil di Simpan',
                        position: 'topRight'
                    });
                    oTable.ajax.reload();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#simpan').html('Save Changes');
                }
            });
        });

        $('#batal').on('click', function() {
            location.reload();
        });

        $('body').on('click', '.deleteItem', function() {
            var Item_id = $(this).data("id");
            $.get("{{ route('kamus.index') }}" + '/' + Item_id + '/edit', function(data) {
                $('#deleteModal').modal('show');
                $('#dt').html(data.indonesia)
                $('#deletebutton').attr('href', '/kamus/destroy/' + data.id);
            });
        });
    });
</script>
@endsection