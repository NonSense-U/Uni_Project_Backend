<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255','unique:' . User::class],
            'fristName' =>['nullable','string','max:255'],
            'lastName' =>['nullable','string','max:255'],
            'phoneNumber' => ['required_without:email', 'string','unique:' . User::class], //! Must Update
            'email' => ['required_without:phoneNumber', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);
        event(new Registered($user));

        // //! For Testing
        if ($request->auth) {
            Auth::login($user);
        }
        return response()->noContent();
    }
}
