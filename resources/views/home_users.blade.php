@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan Data Toko</h1>



    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light py-3">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>
            @endif
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-gray-800">Toko</h6>
                </div>
            </div>
        </div>
        <div class="card-body bg-white-card">
            <div class="table-responsive">
                <table class="table table-bordered text-gray-600" id="dataTable_users" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    @endsection

    @section('js')
    @parent
    <script type="text/javascript">

        $(document).ready(function () {

            $('#dataTable_users').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [4, 'desc'],
                ],
                ajax: '{{ url('/get/users') }}',
                columns: [
                    { data: 'shop_name', name: 'shop_name' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'email', name: 'email' },
                    { data: 'shop_address', name: 'shop_address' },
                    { data: 'created_at', name: 'created_at' },
                ],
                "fnDrawCallback": function (oSettings) {
                    if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                        $(oSettings.nTableWrapper).find('.dataTables_length').hide();
                        $(oSettings.nTableWrapper).find('.dataTables_info').hide();
                    }
                }
            });




        });
    </script>
    @endsection {{-- ENDSECTION JS --}}