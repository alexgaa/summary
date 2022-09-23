<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt([
            'email' =>$request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('main')->with('status', "you are logged in!" );
        }
        return redirect()->back()->withErrors(['errorForm' =>"Incorrect mail or password!"]);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('main');
    }
}
