<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Email Konsultasi | {{ config('app.name', 'EnterpreneurHub') }}</title>
    <meta property="og:image" content="{{ asset('favicon.ico') }}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap');
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .8); 
            mso-line-height-rule: exactly; 
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }


        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }
        }

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }
        }

        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }

        .email-container {
            max-width: 720px; 
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            width: 100%;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .email-content {
            display: block;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Open Sans', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }
        .mb-2 {
            margin-bottom: 0.5rem;
        }
        .mt-4 {
            margin-top: 1.5rem;
        }
        .identity {
            max-width: 100%;
            margin-left: 2rem;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .m-0 {
            margin: 0;
        }
        .mb-1 {
            margin-bottom: 0.25rem;
        }
        ul {
            margin: 0;
        }

    </style>


</head>

<body width="100%">
    <div class="email-container mt-6">
        <table role="presentation" border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="80%">
                                <div>
                                    <p class="mb-2"> Salam Wirausaha Sukses</p>
                                    <p class="mb-2"> Berikut kolom pertanyaan pengguna EnterpreneurHub kepada mentor terpilih </p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="email-content">
                                <div class="identity">
                                    <p class="mb-0">Identitas Penanya : </p>
                                    <ul>
                                        <li>Nama : {{ $user->fullname }}</li>
                                        <li>Email : {{ $user->email }}</li>
                                        <li>No. HP : {{ $user->phone }}</li>
                                    </ul>
                                </div>
                                <div class="identity">
                                    <p class="mb-0">Ditanyakan kepada :</p>
                                    <ul>
                                        <li>Nama mentor : {{ $mentor->fullname }}</li>
                                        <li>Profesi / Keahlian : {{ $mentor->expertise }}</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="email-content">
                                <div class="mt-4">
                                    <p class="">Judul pertanyaan : {{ $subject }}</p>
                                    <p class="">Isi pertanyaan : {{ $question }}</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="80%">
                                <div>
                                    <p class="m-0">Salam hangat</p>
                                    <p class="m-0">Tim EnterpreneurHub</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
