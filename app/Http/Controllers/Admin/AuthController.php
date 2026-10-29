<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'UserName' => 'required',
            'Password' => 'required',
        ]);

        $account = Account::where('UserName', $request->UserName)
            ->where('Role', 'Admin')
            ->where('Status', 1)
            ->first();

        if (!$account) {
            return back()
                ->withErrors(['UserName' => 'Account does not exist or does not have admin permission.'])
                ->withInput();
        }

        if (!Hash::check($request->Password, $account->Password)) {
            return back()
                ->withErrors(['Password' => 'Incorrect password.'])
                ->withInput();
        }

        session([
            'admin_id' => $account->Account_ID,
            'admin_name' => $account->FullName,
            'admin_username' => $account->UserName,
            'admin_role' => $account->Role,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'admin_name',
            'admin_username',
            'admin_role',
        ]);

        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}

