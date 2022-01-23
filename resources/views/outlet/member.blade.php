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
                <h1>Member</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Outlet</a></li>
                    <li class="breadcrumb-item"><a href="/outlet/{{ $outlet->id }}">{{ $outlet->id }}</a></li>
                    <li class="breadcrumb-item active">Member</li>
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
                    <h3 class="card-title">Data Member</h3>
                    <div class="card-tools">
                        <button onclick="createHandler('{{ route('member.store', $outlet->id) }}')"
                            class="btn btn-primary">
                            <i class="far fa-plus-square mr-1"></i>
                            <span>Add</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableMember" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Number Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
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
                        <label for="nama">Name</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Customer Name">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="telepon">Number Phone</label>
                            <input type="tel" maxlength="15" name="telepon" class="form-control" id="telepon"
                                placeholder="+62">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Gender</label>
                        <div class="d-flex align-items-center" style="gap: 15px">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="JKLakiLaki"
                                    value="L">
                                <label class="form-check-label" for="JKLakiLaki">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="JKPerempuan"
                                    value="P">
                                <label class="form-check-label" for="JKPerempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Address</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3"
                            placeholder="Address"></textarea>
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

    <script>
        let table;
        $(function() {
            const tableOptions = {
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                ajax: {
                    url: '{{ route('member.data', $outlet->id) }}',
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'jenis_kelamin'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    }
                ]
            };
            table = $('#tableMember').DataTable(tableOptions);
        });


        const createHandler = function(url) {
            clearErrors();
            const modal = $('#modalForm');
            modal.modal('show');
            modal.find('.modal-title').text('Input Member');
            modal.find('form')[0].reset();
            modal.find('form').attr('action', url);
            modal.find('[name=_method]').val('post');
            modal.on('shown.bs.modal', function() {
                modal.find('[name=nama]').focus();
            });
        }

        const editHandler = (url) => {
            clearErrors();
            const modal = $('#modalForm');
            modal.modal('show');
            modal.find('.modal-title').text('Edit Member');
            modal.find('form')[0].reset();
            modal.find('form').attr('action', url);
            modal.find('[name=_method]').val('put');
            modal.find('input').attr('disabled', true);
            modal.find('select').attr('disabled', true);
            modal.on('shown.bs.modal', function() {
                modal.find('[name=nama]').focus();
            });
            $.get(url)
                .done((res) => {
                    const member = res.member;
                    modal.find('[name=nama]').val(member.nama);
                    modal.find('[name=email]').val(member.email);
                    modal.find('[name=telepon]').val(member.telepon);
                    modal.find(`[name=jenis_kelamin][value='${member.jenis_kelamin}']`).prop('checked', true);
                    modal.find('[name=alamat]').val(member.alamat);
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
