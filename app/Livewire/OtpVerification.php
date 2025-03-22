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
    private $otp;

    public $otp0;
    public $otp1;
    public $otp2;
    public $otp3;
    public $otp4;
    public $otp5;


    public function mount()
    {

        if (!is_null(Auth::user()->email_verified_at))
        {
            if (Auth::user()->type === null)
            {
                return redirect('typeaccount');
            }
            elseif (Auth::user()->interests === null)
            {
                return redirect('interests');
            }
        }


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
        $this->otp = $this->otp0 . $this->otp1 . $this->otp2 . $this->otp3 . $this->otp4 . $this->otp5;

        $user = Auth::user();
        $otpRecord = OtpCode::where('user_id', $user->id)->where('otp', $this->otp)->first();

        if ($otpRecord && Carbon::now('asia/aden')->lt($otpRecord->expires_at)) {
            session()->flash('success', 'OTP Verified Successfully!');
            $user->update(['email_verified_at' => Carbon::now('asia/aden')]);
            $otpRecord->delete();
            return redirect('typeaccount'); // Ensure the redirection stops execution
        } else {
            session()->flash('error', 'Invalid or expired OTP.');
        }
    }


    public function render()
    {
        return view('livewire.otp-verification');
    }
}
