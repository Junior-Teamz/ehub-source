<!DOCTYPE html>
<html>

<head>
    <title>Verifikasi Email {{ config('app.name', 'EnterpreneurHub') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta property="og:image" content="{{ asset('favicon.ico') }}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap');

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #fff;
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            color: #030303;
        }

        p {
            margin: 0;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        table td {
            background-color: #fff;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .table-header,
        .table-message {
            max-width: 600px;
        }

        .table-header td {
            padding: 60px 10px 0px 10px;
        }

        .header-logo {
            display: flex;
            justify-content: center;
        }

        .header-logo img:first-child {
            margin-right: 24px;
            width: 200px;
        }

        .header-logo img:last-child {
            width: 200px;
        }

        .table-message td {
            padding: 40px 20px 20px 20px;
            border-radius: 12px;
            color: #030303;
            font-size: 36px;
            font-weight: 400;
            line-height: 48px;
        }

        .table-message p {
            margin-bottom: 24px;
        }

        .table-content tr td {
            font-size: 18px;
            font-weight: 400;
            line-height: 25px;
        }

        .table-content tr td {
            padding: 10px 20px 10px 20px;
        }

        .table-link tr td {
            padding: 10px 20px 10px 20px !important;
        }

        .table-button td {
            border-radius: 12px;
        }

        .table-button a {
            font-size: 20px;
            background-color: rgb(30, 81, 99, 1);
            text-decoration: none;
            color: #ffffff;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 12px;
            display: inline-block;
        }

        .py-2\.5 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .px-2\.5 {
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body>
    <table cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" width="100%" class="table-header">
                    <tr>
                        <td valign="top">
                            <div class="header-logo">
                                <img src="{{ asset('images/logo-ehub-v2.png') }}">
                                <img class="w-20" src="{{ asset('images/logo-kemenkop-v2.png') }}">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="px-2.5">
                <table cellpadding="0" cellspacing="0" width="100%" class="table-message">
                    <tr>
                        <td valign="top">
                            <p>{{ $message ?? 'Email anda berhasil diverifikasi' }}</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path fill="#1E5163"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-.997-4L6.76 11.757l1.414-1.414 2.829 2.829 5.656-5.657 1.415 1.414L11.003 16z" />
                            </svg>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="px-2.5">
                <table cellpadding="0" cellspacing="0" width="100%" class="table-content">
                    <tr>
                        <td>
                            <p>Terima kasih, email anda telah terverifikasi.<br> Akun anda sekarang telah aktif. <br>
                                Silakan gunakan tombol berikut untuk menuju ke halaman login</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" class="table-link">
                                <tr>
                                    <td class="py-2.5">
                                        <table cellspacing="0" cellpadding="0" class="table-button">
                                            <tr>
                                                <td><a href="{{ route('login') }}">Masuk ke Akun</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td>
                            <p>Salam hangat, <br> Tim EnterpreneurHub</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
