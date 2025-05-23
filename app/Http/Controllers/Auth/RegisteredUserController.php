<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable','image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'cover_image' => ['nullable','image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'bio' => ['required', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],


        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio'=>$request->bio,
            'link'=>$request->link,
            'password' => Hash::make($request->password),
        ]);
        if($request->hasFile('profile_image')){
            $path=$request->file('profile_image')->store('profile_images','public');
            $user->image()->create([
                'url'=>$path,
                'type'=>'profile_image'
            ]);
            if($request->hasFile('cover_image')){
                $cover_path=$request->file('cover_image')->store('cover_images','public');
                $user->image()->create([
                    'url'=>$cover_path,
                    'type'=>'cover'
                ]);
            }
        }

        
        event(new Registered($user));

        Auth::login($user);

        return redirect('/tweet');
    }
}
