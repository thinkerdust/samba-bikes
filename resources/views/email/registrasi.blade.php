<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <!-- Web Font / @font-face : BEGIN -->
    <!--[if mso]>
        <style>
            * {
                font-family: 'Roboto', sans-serif !important;
            }
        </style>
    <![endif]-->

    <!--[if !mso]>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    
    
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color:#555555;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        a {
            text-decoration: none;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
	<center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding-bottom:25px">
                                    <img style="height: 40px;" src="https://sambabikes.com/public/assets/images/logo-brand-side-yellow.png" alt="logo">
                                    <p style="font-size: 16px; padding-top: 12px;"><strong>Selamat Datang di {{ $data[0]->nama_event }}.</strong></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr></tr>

                                <td style="padding: 30px 30px 20px">
                                    <p style="margin-bottom: 10px;"><strong>Hi Bikers</strong>,</p>
                                    <p style="margin-bottom: 10px;">Terima kasih Anda telah melakukan pendaftaran {{ $data[0]->nama_event }}, untuk menyelesaikan pendaftaran silahkan melakukan pembayaran dalam waktu 24 Jam setelah email ini dikirimkan.                                    </p>
                                    <p style="margin-bottom: 10px;">Data registrasi akan otomatis dihapus oleh sistem setelah 24 jam jika tidak terdapat pembayaran / melakukan konfirmasi pembayaran dalam batas waktu tersebut.</p>
                                    <p style="margin-bottom: 15px;">Berikut data pendaftaran Anda :</p>
                                
                                    <table style="width:100%;max-width:620px;margin:0;background-color:#ffffff;border-collapse: collapse; border: 1px solid #ccc;">
                                        <thead>
                                            <tr style="background-color: #1e1e1e; color: white;">
                                                <th style="border: 1px solid #ccc; padding: 5px;">Nama</th>
                                                <th style="border: 1px solid #ccc; padding: 5px;">Ukuran Jersey</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $peserta)
                                                <tr>
                                                    <td style="border: 1px solid #ccc; padding: 5px; text-align: center;">{{ $peserta->nama_peserta }}</td>
                                                    <td style="border: 1px solid #ccc; padding: 5px; text-align: center;">{{ $peserta->size_jersey }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <p style="margin-bottom: 15px; margin-top: 15px;">Detail Tagihan :</p>                                    
                                    <table style="width:100%;max-width:620px;margin-left:0;background-color:#ffffff;border-collapse: collapse;border: 1px solid #555;">
                                        <tbody>
                                            @if ($data[0]->komunitas)
                                                <tr>
                                                    <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; font-weight: bold; width: 120px;">Komunitas</td>
                                                    <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; ">{{ $data[0]->komunitas }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; font-weight: bold; width: 120px;">No Tagihan</td>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; ">{{ $data[0]->nomor_order }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; font-weight: bold;">Paket</td>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px;">{{ $data[0]->nama_event }}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px; font-weight: bold;">Total</td>
                                                <td style="border: 1px solid #555; padding: 5px; padding-left: 10px;">Rp. {{ number_format($data[0]->total, 0, '.', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                                    <p style="margin-bottom: 15px; margin-top: 20px;">Harap melakukan pembayaran dengan nominal yang sesuai dengan tagihan (dengan angka unik). Pembayaran bisa dilakukan melalui rekening berikut :</p>
                                
                                    <p style="text-align: center;"><strong>Nama Bank : {{ $data[0]->bank }}</strong></p>
                                    <p style="text-align: center;"><strong>Nomor Rekening : {{ $data[0]->nomor_rekening }}</strong></p>
                                    <p style="text-align: center;"><strong>Atas Nama : {{ $data[0]->nama_rekening }}</strong></p>

                                    <p style="margin-bottom: 15px; margin-top: 15px;">Setelah melakukan pembayaran lakukan konfirmasi melalui whatsapp ke nomor {{ $data[0]->phone }}. Hanya menerima pesan Whatsapp (WA), tidak menerima SMS atau Telepon</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table style="width:100%;max-width:620px;margin:0 auto; background: #1e1e1e; color: white;" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td style="text-align:center; padding: 20px 0;">
                                <p style="font-size: 13px; font-family: Arial, sans-serif;">
                                    Copyright © 2025 Samba Bikes. All rights reserved.<br>
                                </p>
                                <p style="font-size: 13px; font-family: Arial, sans-serif;">
                                    Email ini dikirim secara otomatis oleh sistem sebagai bagian dari proses pendaftaran.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>