@extends('admin.layouts.main')

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
                <h1>Outlet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item active">Outlet</li>
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
                    <h3 class="card-title">Data Outlet</h3>
                    
                    
                    {{-- Modal Input --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title-" id="exampleModalLabel">Outlet</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Input Outlet</h3>
                                    </div>
                                <form action="{{ route('outlet.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        @include('admin.outlet.form-control')
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                   

                    <div class="card-tools">
                        <a type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-sm btn-primary"><i class="far fa-plus-square"></i>
                            Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="outletTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Outlet</th>
                                <th>Number Phone</th>
                                <th>Address</th>
                                <th>View</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_outlet as $outlet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $outlet->nama }}</td>
                                    <td>{{ $outlet->telepon }}</td>
                                    <td>{{ $outlet->alamat }}</td>
                                    <td>
                                        <a href="/outlet/{{ $outlet->id }}" class="btn btn-success"><i
                                                class="fas fa-sign-in-alt mr-1"></i> <span>View Outlet</span>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-info" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                               <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('outlet.edit', $outlet->id) }}"
                                                    class="dropdown-item" data-toggle="modal" data-target="#editmodal{{ $loop->iteration }}"><i class="fas fa-edit"></i>
                                                    Edit Outlet</a>
                                                   
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editmodal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title-" id="exampleModalLabel">Outlet</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Edit Outlet</h3>
                                                </div>
                                                <form action="{{ route('outlet.update', $outlet->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        @include('admin.outlet.form-control')
                                                    </div>
                                                    <!-- /.card-body -->
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                            @endforeach
                        </tbody>
                    </table>
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
                    const deleteHandler = function(outletId) {
                        Swal.fire({
                            title: 'Are you Sure?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#FF8000',
                            cancelButtonColor: '#0AC519',
                            confirmButtonText: 'Yeah',
                        }).then((result) => {
                            if (!result.isConfirmed) return;
                            $.ajax({
                                url: `/admin/outlet/${outletId}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-token': "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: res.message
                                    });
                                },
                                error: function(err) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: err.responseJSON.message ?? 'Error'
                                    });
                                }
                            });
                        });
                    }
            
                    $(function() {
                        $('#outletTable').DataTable({
                            "paging": true,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        });
                    })
                </script>
@endpush
