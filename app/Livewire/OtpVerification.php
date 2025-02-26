<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class OtpVerification extends Component
{
    public $otp;

    public function mount()
    {
        $this->sendOtp();
    }

    public function sendOtp()
    {
        $user = Auth::user();
        $otp = rand(100000, 999999);
        $expiry = Carbon::now('asia/aden')->addMinutes(5);

        OtpCode::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => $otp,
            'expires_at' => $expiry]
        );

        Mail::to($user->email)->send(new OtpMail($otp));
    }

    public function verifyOtp()
    {
        $user = Auth::user();
        $otpRecord = OtpCode::where('user_id', $user->id)->where('otp', $this->otp)->first();


        if ($otpRecord->otp === $this->otp && Carbon::now('asia/aden')->lt($otpRecord->expires_at)) {
            session()->flash('success', 'OTP Verified Successfully!');
            $user->update(['email_verified_at' => Carbon::now('asia/aden')]);
            $otpRecord->delete();
            redirect('typeaccount');
        } else {
            session()->flash('error', 'Invalid or expired OTP.');
        }
    }

    public function render()
    {
        return view('livewire.otp-verification');
    }
}
