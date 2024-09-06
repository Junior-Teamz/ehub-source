<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

<head style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta charset="utf-8" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta name="viewport" content="width=device-width" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta name="x-apple-disable-message-reformatting" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <title style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Verifikasi Email | {{ config('app.name', 'EnterpreneurHub') }}</title>
    <meta property="og:image" content="{{ asset('favicon.ico') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta property="og:image:type" content="image/png" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta property="og:image:width" content="200" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <meta property="og:image:height" content="200" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
</head>

<body width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #f1f1f1;font-family: 'Inter', sans-serif;font-weight: 400;font-size: 14px;line-height: 1.8;color: rgba(0, 0, 0, .4);mso-line-height-rule: exactly;margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;">
    <div class="email-container" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 720px;margin: 0 auto;display: flex;flex-direction: column;width: 100%;justify-content: center;">
        <!-- BEGIN BODY -->
        <table role="presentation" cellspacing="0" cellpadding="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: auto;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
            <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <td valign="top" class="bg-white td-header" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #ffffff;padding: 2em 2.5em 0 2.5em;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: auto;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
                        <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <td style="text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 12px 0;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;" class="header-logo" width="100%">
                                <div style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: flex;justify-content: center;">
                                    <img src="{{ asset('images/logo-ehub-v2.png') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;width: 160px;margin-right: 24px;">
                                    <img src="{{ asset('images/logo-kemenkop-v2.png') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;width: 160px;">

                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <td valign="middle" class="bg-white td-content" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #ffffff;padding: 1.5em 0 4em 0;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: auto;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
                        <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <td class="email-content" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-align: center;color: #333333;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
                                <div class="content-message" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border: 1px solid rgba(0, 0, 0, .05);max-width: 80%;margin: 0 auto;padding: 2em;border-radius: 12px;">
                                    @if (isset($password))
                                        <p class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                            Selamat datang di <a href="{{ route('home.index') }}" class="font-bold text-link" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #9DA960;font-weight: 700;">EnterpreneurHub</a>,<br style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            Terima kasih telah bergabung dengan kami. Berikut ini adalah informasi
                                            password login akun anda :
                                        </p>
                                        <p style="margin-bottom: 12px;font-weight: 700;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            Password : {{ $password }}
                                        </p>
                                        <p style="margin-bottom: 12px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            Password ini digunakan untuk masuk ke dalam website EntrepnrenurHub.<br style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            Silahkan disimpan dengan baik dan hati-hati, jangan pernah membagikan /
                                            menunjukkan password anda kepada orang lain.
                                        </p>
                                        <p class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                            Dan juga klik tombol berikut ini untuk verifikasi akun anda.
                                        </p>
                                        <div class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                            <a href="{{ $url ?? route('email.verify', $token) }}" class="btn-verify" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #fff;background-color: rgb(30, 81, 99, 1);font-weight: 600;font-size: 16px;padding: 12px 24px;border-radius: 12px;">Verifikasi Email</a>
                                        </div>
                                    @else
                                        <p class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                            Selamat datang di <a href="{{ route('home.index') }}" class="font-bold text-link" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #9DA960;font-weight: 700;">EnterpreneurHub</a>,<br style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                            Terima kasih telah bergabung dengan kami. Silahkan klik tombol berikut ini
                                            untuk melakukan verifikasi akun anda.
                                        </p>
                                        <div class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                            <a href="{{ $url ?? route('email.verify', $token) }}" class="btn-verify" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #fff;background-color: rgb(30, 81, 99, 1);font-weight: 600;font-size: 16px;padding: 12px 24px;border-radius: 12px;">Verifikasi Email</a>
                                        </div>
                                    @endif
                                    <p class="mb-3" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 12px;">
                                        Jika anda tidak merasa membuat akun menggunakan email ini, maka anda tidak perlu
                                        melakukan tindakan apapun.
                                    </p>
                                    <p class="mb-4" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin-bottom: 16px;">
                                        Salam hangat dari kami,<br style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                        <span class="font-bold text-primary" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-weight: 700;color: rgb(30, 81, 99, 1);">Tim EnterpreneurHub</span>
                                    </p>
                                    <div class="note" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;border-top: 1px solid rgba(0, 0, 0, .05);padding-top: 0.5rem;">
                                        <p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-size: 13px;">
                                            Jika terdapat masalah saat menekan tombol "Verifikasi Email", copy dan paste
                                            link berikut ini ke dalam web browser anda :
                                            <a href="{{ $url ?? route('email.verify', $token) }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: rgb(30, 81, 99, 1);word-break: break-all;">{{ $url ?? route('email.verify', $token) }}</a>
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <td class="td-footer" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-align: left;padding-right: 12px;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
                    <h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: 'Open Sans', sans-serif;color: #333;margin-top: 20;font-weight: 600;font-size: 20px;text-align: center;">Tentang Kami</h3>
                    <p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-size: 13px;line-height: 1.5;text-align: center;">
                        EntrepreneurHub merupakan Platform Ekosistem Wirausaha Indonesia yang
                        mengintegrasikan berbagai kementrian Lembaga dan Pemangku Kepentingan
                        serta Pelaku UMKM. Dengan tujuan untuk memperkuat ekosistem
                        kewirausahaan seperti Pendataan, Pemetaan, Klasterisasi serta fitur
                        lainnya
                    </p>
                    <ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;font-size: 13px;line-height: 1.5;display: flex;justify-content: center;text-align: center;">
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('home.index') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Beranda </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('home.about-us') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Tentang Kami </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('courses.index') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Kelas </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('workshops.index') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Program </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('news.index') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Berita </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('umkm.index') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> UMKM </a></li>
                        <li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 3px;"><a href="{{ route('home.contact-us') }}" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #333333;margin-right: 10px;"> Kontak Kami </a></li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
