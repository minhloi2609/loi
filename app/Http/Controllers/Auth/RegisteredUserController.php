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
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image_user' => 'nullable|image|max:2048', // Validation for avatar upload
        ]);
        // Handling avatar upload
        // Handling avatar upload
        if ($request->hasFile('image_user')) {
            // Tạo tên file với định dạng 'user' + thời gian + phần mở rộng
            $imageName = 'user' . time() . '.' . $request->file('image_user')->extension();

            // Lưu file vào thư mục 'image_users' với tên tùy chỉnh
            $image_userPath = $request->file('image_user')->storeAs('image_users', $imageName, 'public');
        } else {
            $image_userPath = null;
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image_user' => $image_userPath, // Store image_user path
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
