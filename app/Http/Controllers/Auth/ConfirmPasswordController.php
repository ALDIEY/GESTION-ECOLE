<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmPasswordController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show the password confirmation form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showConfirmForm()
    {
        return view('auth.passwords.confirm');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            // Password confirmed successfully
            return redirect('/niveau');
        } else {
            return back()->withErrors([
                'password' => 'Le mot de passe ne correspond pas.',
            ]);
        }
    }
}
