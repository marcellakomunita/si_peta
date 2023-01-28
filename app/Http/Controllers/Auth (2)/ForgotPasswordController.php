<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showLinkRequestForm()
      {
         return view('auth.password.forgot-password');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
        //   $request->validate([
        //       'email' => 'required|email|exists:users',
        //   ]);
  
        //   $token = Str::random(64);
  
        //   DB::table('password_resets')->insert([
        //       'email' => $request->email, 
        //       'token' => $token, 
        //       'created_at' => Carbon::now()
        //     ]);
        
        // Mail::send('email.forgotPassword', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Reset Password');
        // });
        
        // if (Mail::failures() != 0) {
        //     back()->with('message', 'Email has been sent successfully.');
        // }
        // return back()->with('message', 'Oops! There was some error sending the email.');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
        //  return view('auth.password.reset', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
        // $email = DB::table('password_resets')->where('token', $request->token)->get();
        
        // if(count($email) > 0) {
        //     $request->validate([
        //         'password' => 'required|string|min:8|confirmed',
        //         'password_confirmation' => 'required'
        //     ]);
            
        //     $user = User::where('email', $email);
        //     $user->password = FacadesHash::make($request->password);
        //     $user->save();

        //     DB::table('password_resets')->where('email', $email)->delete();

        //     return redirect('/login')->with('message', 'Your password has been changed!');
        // } else {
        //     return back()->withInput()->with('error', 'Invalid token!');
        // }          
      }
}
