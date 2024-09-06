<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use Notifiable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('landing.login');
    }

    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->only(['email', 'password']),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email harus diisi dengan email yang valid!',
            'email.exists' => 'Email akun anda tidak terdaftar di sistem!',
            'password.required' => 'Password wajib diisi!',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $currentUser = User::find(Auth::user()->id);

            if (Auth::user()->hasRole('entrepreneur') && $currentUser->email_verified_at === NULL) {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email_verify' => 'Email akun anda belum terverifikasi!'
                ])->withInput()->with('email', $request->email);
            }

            $request->session()->regenerate();

            if (session()->has('url.intended')) {
                return redirect()->intended();
            }

            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'password' => 'Password yang anda masukkan salah!',
        ]);
    }

    public function register()
    {
        return view('landing.register');
    }

    public function doRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ], [
                'fullname.required' => 'Nama lengkap wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'email.unique' => 'Email yang anda masukkan telah terdaftar, silakan gunakan email lain!',
                'phone.required' => 'Nomor whatsapp wajib diisi!',
                'phone.unique' => 'Nomor whatsapp yang anda masukkan telah terdaftar, silakan gunakan nomor whatsapp lain!',
                'password.required' => 'Password wajib diisi!',
                'password.min' => 'Password minimal 6 karakter!',
                'confirm_password.required' => 'Ketik ulang password wajib diisi!',
                'confirm_password.same' => 'Ketik ulang password harus sama isinya dengan password!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $token = Str::random(64);
            $data = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'token' => $token,
            ];

            DB::beginTransaction();

            $user = User::create($data);
            $user->assignRole('entrepreneur');

            $url = route('email.verify', $token);
            Mail::send('landing.email-verification', ['token' => $token, 'url' => $url], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verifikasi Akun EnterpreneurHub');
            });

            DB::commit();

            Alert::success('Sukses', 'Pendaftaran akun berhasil dilakukan. Kami telah mengirimkan link verifikasi ke email akun terdaftar anda. Silakan cek email anda!');
            return redirect()->route('login');
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }

            dd($e->getMessage());

            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return redirect()->back();
        }
    }

    public function sendEmailVerify(Request $request)
    {
        try {
            $token = Str::random(64);
            $currentUser = User::where('email', $request->email)->first();

            DB::beginTransaction();

            $url = route('email.verify', $token);

            if ($currentUser->token) {
                $currentUser->update(['token' => null]);
            }

            Mail::send('landing.email-verification', ['token' => $token, 'url' => $url], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verifikasi Akun EnterpreneurHub');
            });

            if (count(Mail::failures()) > 0) {
                Alert::error('Error', 'Email gagal terkirim!');
                return redirect()->route('login');
            } else {
                $currentUser->update(['token' => $token]);
            }

            DB::commit();
            Alert::success('Sukses', 'Email verifikasi berhasil dikirimkan. Silakan cek email anda untuk melakukan verifikasi akun EntrepreneurHub anda.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            if (App::environment('production')) {
                errorLog(basename(__FILE__), __LINE__, $e->getMessage());
            }
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return back();
        }
    }

    public function verifyEmail($token)
    {
        try {
            $user = User::where('token', $token)->first();
            if ($user) {
                if (!$user->email_verified_at) {
                    $data['email_verified_at'] = now();
                    $user->update($data);
                    $message = 'Email anda berhasil diverifikasi';
                } else {
                    $message = 'Anda sudah melakukan verifikasi email';
                }
                return view('landing.verified-email', ['message' => $message]);
            } else {
                Alert::error('Oops', 'Akun tidak ditemukan');
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan teknis, silahkan kontak customer service kami');
            return redirect()->back();
        }
    }

    /**
     * Logout function
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }

    public function forgotPassword()
    {
        return view('landing.forgot-password');
    }

    protected function sendResetLinkEmails(array $input)
    {
        return Password::sendResetLink($input);
    }

    public function doForgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'Alamat email tidak terdaftar pada sistem']);
            }

            $token = Password::createToken($user);

            // Send the reset password notification
            $user->notify(new ResetPasswordNotification($token, $request->email));

            return redirect()->back()->with('email', 'Link reset email sudah berhasil dikirim, silakan cek email kamu!');
        } catch (\Throwable $th) {
            return back()->withErrors(['email' => 'Terjadi kesalahan teknis, silahkan kontak customer service kami']);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        $data['token'] = $token;
        $data['email'] = $request->input('email');

        return view('landing.reset-password', $data);
    }

    public function doResetPassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ], [
                'password.min' => 'Kata sandi minimal 6 karakter'
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                }
            );

            return back()->with('success', 'Kata sandi berhasil diganti');
        } catch (\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
