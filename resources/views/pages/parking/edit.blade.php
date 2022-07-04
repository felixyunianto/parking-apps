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
                        <div class="" style="display:flex; gap: 1rem; align-items:center">
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $space }}
                            </h3>
                            <form action="{{ route('slot.update', 1) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" style="">
                                <div class="" style="display:flex; gap: 0.7rem; align-items:center">
                                    <div class="input-group" style="flex:1;display: none;padding: 0.5rem"
                                        id="input-change-slot">
                                        <div class="input-field @error('capasity') error @enderror">
                                            <input type="number" placeholder="Total" name="capasity">
                                            <div class="error-mark @error('capasity') error-mark-show @enderror">
                                                <i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-main" type="submit" style="padding: 0.7rem 1rem;display: none"
                                        id="change-slot">Ubah</button>
                                </div>
                                @role("admin")
                                    <a href="" style="color:blue" id="first-change-slot">Ubah</a>
                                @endrole
                            </form>
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
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $ongoing }}
                            </h3>
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
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $empty }}
                            </h3>
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
                        <form action="{{ route('parking.checkout') }}" method="GET">
                            @csrf
                            <div class="" style="display:flex;align-items:center;gap:10px;padding:0.2rem 0">
                                <div class="input-group" style="flex:1">
                                    <div class="input-field">
                                        <input type="text" placeholder="Kode parkir" name="barcode" required>
                                    </div>
                                </div>
                                <button class="btn btn-main" style="padding: 0.7rem 1rem">Cari</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-box">
            <div class="card-box-header">
                Ubah Data Parkir
            </div>
            <div class="card-box-body">
                <div class="user-container">
                    <form action="{{ route('parking.update', $parking->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="input-group" style="width: 40%">
                            <label for="">Plat Nomor <span>*</span></label>
                            <div class="input-field @error('motorcycle_plate') error @enderror">
                                <input type="text" placeholder="Plat Nomor" name="motorcycle_plate"
                                    value="{{ $parking->motorcycle_plate }}">
                                <div class="error-mark @error('motorcycle_plate') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('motorcycle_plate')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Nama Pengemudi <span>*</span></label>
                            <div class="input-field @error('driver_name') error @enderror">
                                <input type="text" placeholder="Nama Pengemudi" name="driver_name" value="{{ $parking->driver_name }}">
                                <div class="error-mark @error('driver_name') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('driver_name')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Nomor Handphone <span>*</span></label>
                            <div class="input-field @error('phone_number') error @enderror">
                                <input type="number" placeholder="Nomor Handphone" name="phone_number" value="{{ $parking->phone_number }}">
                                <div class="error-mark @error('phone_number') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('phone_number')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-main" style="padding : 0.8rem 2rem">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
