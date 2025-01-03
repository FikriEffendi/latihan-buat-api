<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\ResponseFormatter;

class AuthenticationController extends Controller
{
    public function login()
    {
        $email = request()->email;
        $password = request()->password;

        $user = User::where("email", $email)->first();
        if (is_null($user)) {
            return ResponseFormatter::error(400, null, [
                'User tidak ditemukan'
            ]);
        }

        $userPassword = $user->password;
        if (Hash::check($password, $userPassword)) {
            $token = $user->createToken(config('app.name'))->plainTextToken;

            return ResponseFormatter::success([
                'token' => $token,
            ]);
            // dd($token); testing untuk jika password benar akan mengembalikan token
            // dd('Password betul'); testing untuk jika password benar akan mengambalikan string
        }

        return ResponseFormatter::error(400, null, [
            'password salah'
        ]);

        // dd('Password salah'); jika password salah

        // dd($user); debug user(untuk mengetahui user)

        // dd($email, $password); debug user dan password(untuk mengetahui user dan password)
    }
}
