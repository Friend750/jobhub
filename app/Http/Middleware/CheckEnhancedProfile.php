<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEnhancedProfile
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تأكد أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to log in first.');
        }

        // تحقق من المعلومات الشخصية فقط
        $personal = Auth::user()->personal_details;

        // الشروط: إذا ما عبى البيانات الشخصية الأساسية، نحوله إلى EnhanceProfile
        if (
            (!$personal || 
            !$personal->first_name || 
            !$personal->last_name || 
            !$personal->specialist || 
            !$personal->phone || 
            !$personal->city || 
            !$personal->professional_summary)
            && !$request->is('EnhanceProfile')
        ) {
            return redirect('/EnhanceProfile')->with('error', 'You need to fill in your personal details first.');
        }

        return $next($request);
    }
}
