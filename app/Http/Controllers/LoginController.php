<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return response(auth()->id, 200);
    }
    public function login(LoginRequest $request)
    {
        $creditionals = $request->getCreditionals();

        if(!Auth::validate($creditionals)) {
            return redirect()->to('login')->withErrors('trans.failed');
        }

        $user = Auth::getProvider()->retrieveByCredentials($creditionals);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    private function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
