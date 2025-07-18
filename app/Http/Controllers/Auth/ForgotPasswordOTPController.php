<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ForgotPasswordOTPController extends Controller
{
    // Tampilkan form input email
    public function showForgotForm()
    {
        return view('auth.forgot-password-otp');
    }

    // Kirim OTP ke email
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999); // OTP 6 digit
        $expiredAt = Carbon::now()->addMinutes(5); // Berlaku 5 menit

        // Simpan ke session
        Session::put('otp', $otp);
        Session::put('otp_email', $request->email);
        Session::put('otp_expired', $expiredAt);

        // Kirim OTP ke email
        Mail::raw("Kode verifikasi reset password Anda adalah: $otp\n\nBerlaku sampai: $expiredAt", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Kode Verifikasi Reset Password');
        });

        return redirect()->route('password.verify.form')
                         ->with('success', '✅ Kode OTP telah dikirim ke email Anda (berlaku 5 menit).');
    }

    // Form input OTP
    public function showVerifyOTPForm()
    {
        if (!Session::has('otp_email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Silakan minta OTP terlebih dahulu.']);
        }

        return view('auth.verify-otp');
    }

    // Verifikasi OTP
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $otpSession = Session::get('otp');
        $otpExpired = Session::get('otp_expired');

        if (!$otpSession || !$otpExpired) {
            return back()->withErrors(['otp' => 'OTP tidak ditemukan, silakan minta ulang.']);
        }

        if (Carbon::now()->gt(Carbon::parse($otpExpired))) {
            Session::forget(['otp', 'otp_email', 'otp_expired']);
            return back()->withErrors(['otp' => 'OTP sudah kadaluarsa, silakan minta ulang.']);
        }

        if ($request->otp != $otpSession) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        return redirect()->route('password.reset.form')->with('success', '✅ OTP benar, silakan reset password.');
    }

    // Form Reset Password
    public function showResetForm()
    {
        if (!Session::has('otp_email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Silakan minta OTP terlebih dahulu.']);
        }

        return view('auth.reset-password-custom');
    }

    // Simpan Password Baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Session::get('otp_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User tidak ditemukan']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus session OTP setelah reset password sukses
        Session::forget(['otp', 'otp_email', 'otp_expired']);

        return redirect()->route('login')->with('success', '✅ Password berhasil direset! Silakan login.');
    }
}
