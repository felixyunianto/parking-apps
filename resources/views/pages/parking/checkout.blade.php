@extends('layouts.app')

@section('title')
    Parkir
@endsection

@section('content')
    <div class="container-parking">
        <div class="card-box" style="width: 50%">
            <div class="card-box-header">
                <div class="card-box-title">Detail</div>
            </div>
            <form action="{{ route('parking.checkout.proses', $parking->id) }}" method="post">
                @csrf
                <div class="card-box-body">
                    <div class="" style="text-align:center;width: 100%">
                        <h1>IndePark</h1>
                    </div>
                    <div class="barcode-container">
                        <img src="data:images/png;base64,{{ DNS1D::getBarcodePNG($parking->barcode, 'C128') }}"
                            alt="Barcode" height="50px" width="60%" />
                    </div>
                    <table class="detail-table">
                        <tbody>
                            <tr>
                                <td class="detail-left">
                                    Plat Motor
                                </td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    {{ $parking->motorcycle_plate }}
                                </td>
                            </tr>
                            <tr>
                                <td class="detail-left">
                                    Nama
                                </td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">{{ $parking->driver_name }}</td>
                            </tr>

                            <tr>
                                <td class="detail-left">
                                    Nomor Handphone
                                </td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">{{ $parking->phone_number }}</td>
                            </tr>
                            <tr>
                                <td class="detail-left">Tanggal Masuk</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    {{ date('Y-m-d H:i:s', strtotime($parking->clockin)) }}</td>
                            </tr>
                            <tr>
                                <td class="detail-left">Tanggal Keluar</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    {{ date('Y-m-d H:i:s', strtotime($current)) }}
                                    <input type="hidden" name="clockout"
                                        value="{{ date('Y-m-d H:i:s', strtotime($current)) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="detail-left">Durasi</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    {{ $duration->d !== 0 ? $duration->d . ' Hari ' : '' }}
                                    {{ $duration->h !== 0 ? $duration->h . ' Jam ' : '' }}
                                    <input type="hidden" name="duration"
                                        value="{{ $duration->y . ':' . $duration->m . ':' . $duration->d . ':' . $duration->h . ':' . $duration->m . ':' . $duration->s }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="detail-left">Total</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    Rp. {{ number_format($price, 0, '', '.') }}
                                    <input type="hidden" name="amount" value="{{ $price }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="detail-left">Bayar</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    <div class="input-group">
                                        <div class="input-field @error('payment') error @enderror">
                                            <input type="text" placeholder="Jumlah Uang" name="payment"
                                                value="{{ old('payment') }}" data-type="currency" id="payment">
                                            <div class="error-mark @error('payment') error-mark-show @enderror">
                                                <i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="detail-left">Kembalian</td>
                                <td class="detail-right" style="padding: 1.1rem 2rem">
                                    <div class="input-group">
                                        <div class="input-field @error('change') error @enderror">
                                            <input type="text" placeholder="Jumlah kembalian" name="change"
                                                id="change" value="{{ old('change') }}" data-type="currency"
                                                readonly="true">
                                            <div class="error-mark @error('change') error-mark-show @enderror">
                                                <i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="" style="width: 100%">
                        <button type="submit" class="btn btn-main" style="width:100%; padding : .7rem">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            localStorage.removeItem('hasCodeRunBefore')
            if ($('#change').attr('readonly')) {
                $('#change').parent().css({
                    'background-color': '#e9e9e9',
                })
            }

            let total = `{!! json_encode($price) !!}`
            formatRupiah("-10000", "Rp. ")

            $('#payment').on({
                change: function() {
                    let payment = parseInt(($(this).val().replaceAll(".", "")).replace("Rp ", ""))
                    $('#change').val(formatRupiah((payment - parseInt(total)).toString(), "Rp. "));
                },
                keydown: function() {
                    let payment = parseInt(($(this).val().replaceAll(".", "")).replace("Rp ", ""))
                    $('#change').val(formatRupiah((payment - parseInt(total)).toString(), "Rp. "));
                },
                keyup: function() {
                    let payment = parseInt(($(this).val().replaceAll(".", "")).replace("Rp ", ""))
                    $('#change').val(formatRupiah((payment - parseInt(total)).toString(), "Rp. "));
                },
                blur: function() {
                    let payment = parseInt(($(this).val().replaceAll(".", "")).replace("Rp ", ""))
                    $('#change').val(formatRupiah((payment - parseInt(total)).toString(), "Rp. "));
                },
            })
        })
    </script>
@endsection
