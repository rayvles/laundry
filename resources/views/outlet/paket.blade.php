@extends('admin.layouts.outlet')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laundry Package - {{ $outlet->nama }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Outlet</a></li>
                    <li class="breadcrumb-item"><a href="/outlet/{{ $outlet->id }}">{{ $outlet->id }}</a></li>
                    <li class="breadcrumb-item active">Packet</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Laundry</h3>
                    <div class="card-tools">
                        <button onclick="createHandler('{{ route('paket.store', $outlet->id) }}')"
                            class="btn btn btn-primary">
                            <i class="far fa-plus-square mr-1"></i><span>Make Package</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tablePaket" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Packet</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Outlet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <div class="card card-primary">
                <form action="#" onsubmit="submitHandler()" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaPaket">Name</label>
                            <input type="text" name="nama_paket" class="form-control" id="namaPaket"
                                placeholder="Name Packet">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Type</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option selected disabled>Select Type</option>
                                <option value="kaos">Kaos</option>
                                <option value="selimut">Selimut</option>
                                <option value="bed_cover">Bed Cover</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Price</label>
                            <input type="number" min="0" name="harga" class="form-control" id="harga" placeholder="Rp">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary modal-submit-button">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Page Script -->
    <script>
        let table;
        $(function() {
            const tableOptions = {
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                autoWidth: false,
                responsive: true,
                ajax: {
                    url: '{{ route('paket.data', $outlet->id) }}',
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_paket'
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'nama_outlet'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    }
                ]
            }
            table = $('#tablePaket').DataTable(tableOptions);
        });

        const createHandler = function(url) {
            clearErrors();
            const modal = $('#modalForm');
            modal.modal('show');
            modal.find('.modal-title').text('Make New Package');
            modal.find('form')[0].reset();
            modal.find('form').attr('action', url);
            modal.find('[name=_method]').val('post');
            modal.on('shown.bs.modal', function() {
                modal.find('[name=nama_paket]').focus();
            });
        }

        const editHandler = (url) => {
            clearErrors();
            const modal = $('#modalForm');
            modal.modal('show');
            modal.find('.modal-title').text('Edit Paket');
            modal.find('form')[0].reset();
            modal.find('form').attr('action', url);
            modal.find('[name=_method]').val('put');
            modal.find('input').attr('disabled', true);
            modal.find('select').attr('disabled', true);
            modal.on('shown.bs.modal', function() {
                modal.find('[name=nama_paket]').focus();
            });
            $.get(url)
                .done((res) => {
                    const paket = res.paket;
                    modal.find('[name=nama_paket]').val(paket.nama_paket);
                    modal.find('[name=harga]').val(paket.harga);
                    modal.find('[name=jenis]').val(paket.jenis);
                })
                .fail((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Tidak dapat mengambil data'
                    });
                    return;
                }).always(() => {
                    modal.find('input').attr('disabled', false);
                    modal.find('select').attr('disabled', false);
                });
        }

        const submitHandler = function() {
            event.preventDefault();
            const url = $('#modalForm form').attr('action');
            const formData = $('#modalForm form').serialize();
            $.post(url, formData)
                .done((res) => {
                    $('#modalForm').modal('hide');
                    table.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                }).fail((err) => {
                    if (err.status === 422) validationErrorHandler(err.responseJSON.errors);
                    Toast.fire({
                        icon: 'error',
                        title: 'Data gagal disimpan'
                    });
                });
        }

        const deleteHandler = function(url) {
            Swal.fire({
                title: 'Are You Sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF8000',
                cancelButtonColor: '#0AC519',
                confirmButtonText: 'Yeah',
            }).then((result) => {
                if (!result.isConfirmed) return;
                $.post(url, {
                    '_token': $('[name=_token]').val(),
                    '_method': 'delete'
                }).then((res) => {
                    table.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    })
                }).catch((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseJSON.message ?? 'Error'
                    });
                });
            });
        }
    </script>
@endpush
