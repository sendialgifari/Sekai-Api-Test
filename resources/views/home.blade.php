@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan Transaksi Scan QR Barang</h1>



    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light py-3">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>
            @endif
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-gray-800">Barang</h6>
                </div>
            </div>
        </div>
        <div class="card-body bg-white-card">
            <div class="table-responsive">
                <table class="table table-bordered text-gray-600" id="dataTable_products" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Nama Toko</th>
                            <th>Nama Barang</th>
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

            $('#dataTable_products').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [3, 'desc'],
                ],
                ajax: '{{ url('/get/products') }}',
                columns: [
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'user_id', name: 'user_id' },
                    { data: 'name', name: 'name' },
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