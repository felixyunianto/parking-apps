@extends('layouts.app')

@section('title')
    Parkir
@endsection

@section('content')
    <div class="container-parking">
        <div class="row-parking">
            <div class="col-parking">
                <div class="card-box">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Parkir
                    </div>
                    <div class="card-box-body">
                        <div class="">
                            <h3 style="font-weight: 500; font-size:2rem">77</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Booking
                    </div>
                    <div class="card-box-body">
                        <div class="">
                            <h3 style="font-weight: 500; font-size:2rem">4</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Parkir tersedia
                    </div>
                    <div class="card-box-body">
                        <div class="">
                            <h3 style="font-weight: 500; font-size:2rem">51</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Parkir Keluar
                    </div>
                    <div class="card-box-body">
                        <div class="" style="display:flex;align-items:center;gap:10px;padding:0.2rem 0">
                            <div class="input-group" style="flex:1">
                                <div class="input-field">
                                    <input type="text" placeholder="Kode parkir">
                                </div>
                            </div>
                            <button class="btn btn-main" style="padding: 0.7rem 1rem">Cari</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card-box-header">
                <span class="card-box-title">Semua Parkir</span>
                <a href="{{ route('parking.create') }}" class="btn btn-main" style="font-size: 0.8rem">Tambah Parkir</a>

            </div>
            <div class="card-box-body">
                <table id="parking-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Plat Nomor</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Bayar</th>
                            <th style="text-align: right">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($parkings as $parking)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $parking->barcode }}</td>
                                <td>{{ $parking->motorcycle_plate }}</td>
                                <td>{{ date('d m Y h:i:s', strtotime($parking->clockin)) }}</td>
                                <td>{{ $parking->clockout ? date('d m Y h:i:s', strtotime($parking->clockout)) : '-' }}
                                </td>
                                <td>{{ $parking->amount ? 'Rp.' . number_format($parking->amount, 0, '', '.') : '-' }}
                                </td>

                                <td
                                    style="display: flex; gap : 1rem; justify-content:flex-end; align-items : center; text-align: right">
                                    {{-- <form action="{{ route('parking.destroy', $parking->id) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="_method" value="DELETE">
                                        <button style="display: none" type="submit"
                                            id="form-delete-parking-{{ $parking->id }}"></button>
                                    </form> --}}

                                    {{-- <button class="btn btn-edit" onclick="return window.location.href='{{ route('parking.edit', $parking->id) }}'">Edit</button> --}}
                                    <i
                                        class='bx bx-barcode icon-btn icon-btn-main'onclick="window.location.href='{{ route('parking.show', $parking->id)}}'"></i>

                                    <i
                                        class='bx bx-log-out-circle icon-btn icon-btn-primary'onclick="showAlertConfirmation('form-delete-parking-{{ $parking->id }}', 'Peringatan', 'Data akan dihapus secara permanen')"></i>
                                    <i
                                        class='bx bx-edit-alt icon-btn icon-btn-edit'onclick="showAlertConfirmation('form-delete-parking-{{ $parking->id }}', 'Peringatan', 'Data akan dihapus secara permanen')"></i>
                                        
                                    <i
                                        class='bx bx-trash icon-btn icon-btn-trash'onclick="showAlertConfirmation('form-delete-parking-{{ $parking->id }}', 'Peringatan', 'Data akan dihapus secara permanen')"></i>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#parking-table').DataTable();
        });
    </script>
@endsection
