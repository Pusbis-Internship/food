<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice UINSAFOOD</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        @if ($groupedOrders && $groupedOrders->count() > 0)
                            @foreach ($groupedOrders as $groupedOrder)
                                <tr class="top">
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td class="title">
                                                    <img src="{{ asset('frontend/images/logo_uinsa_food.png') }}"
                                                        alt="logo" class="img-responsive">
                                                </td>
                                                <td>
                                                    <strong>Nama Pemesan: {{ $groupedOrder->nama_lengkap }}</strong>
                                                    <br><strong>ID Pesanan: {{ $groupedOrder->id_pesanan }}</strong>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                PUSBIS<br />
                                (Pusat Bisnis UIN Sunan Ampel Surabaya)
                                <br />
                                Kantin Maqha lt 2 UIN Sunan Ampel Surabaya, Jl. Ahmad Yani No.117, Jemur Wonosari,
                                Wonocolo, Surabaya
                            </td>
                            <td>
                                <br>Nama Penerima: {{ $groupedOrder->nama_penerima }}
                                <br>Alamat Pengiriman: {{ $groupedOrder->alamat_pengiriman }}
                                <br>Fakultas: {{ $groupedOrder->fakultas }}
                                <br>Tanggal :{{ $groupedOrder->tanggal }} 
                                <br>Jam : {{ $groupedOrder->jam }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>

            @foreach($groupedOrders as $groupedOrder)
            @php
                $menus = explode(',', $groupedOrder->menu_names);
                $menu_prices = explode(',', $groupedOrder->menu_prices);
                $quantities = explode(',', $groupedOrder->quantities); // Menggunakan string quantities yang baru
                $subtotals = explode(',', $groupedOrder->subtotals);
                $count = count($menus);
            @endphp
        
            @for ($i = 0; $i < $count; $i++)
                <tr class="item">
                    <td>{{ isset($menus[$i]) ? $menus[$i] : '' }}</td>
                    <td>Rp.{{ isset($menu_prices[$i]) ? number_format($menu_prices[$i], 0, ',', '.') : '' }}</td>
                    <td>{{ isset($quantities[$i]) ? number_format($quantities[$i], 0, ',', '.') : '' }}</td>
                    <td>Rp.{{ isset($subtotals[$i]) ? number_format($subtotals[$i], 0, ',', '.') : '' }}</td>
                </tr>
            @endfor
        @endforeach
        
        <tr class="total">
            <td><strong>Total Rp.{{ number_format($groupedOrder->total, 0, ',', '.') }}</strong></td>
        </tr>        
        </table>
        @endforeach
        @endif
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.invoice-box');

            const options = {
                margin: 1,
                filename: 'invoice{id_pesanan}uinsafood.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 10
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            html2pdf()
                .from(element)
                .set(options)
                .save();
        }
    </script>
    <button onclick="downloadPDF()">Download Invoice</button>
</html>