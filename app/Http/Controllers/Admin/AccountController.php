<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('Account_ID', 'desc')->get();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserName' => 'required|max:50|unique:Account,UserName',
            'Password' => 'required|min:6|max:255',
            'FullName' => 'required|max:100',
            'Email' => 'nullable|email|max:100|unique:Account,Email',
            'PhoneNumber' => 'nullable|max:20',
            'Address' => 'nullable|max:255',
            'Avatar' => 'nullable|max:255',
            'Role' => 'required|in:Admin,Customer',
            'Status' => 'required|boolean',
        ]);

        Account::create([
            'UserName' => $request->UserName,
            'Password' => Hash::make($request->Password),
            'FullName' => $request->FullName,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Address' => $request->Address,
            'Avatar' => $request->Avatar,
            'Role' => $request->Role,
            'Status' => $request->Status,
        ]);

        return redirect()
            ->route('admin.accounts.index')
            ->with('success', 'Account created successfully.');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);

        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'UserName' => 'required|max:50|unique:Account,UserName,' . $id . ',Account_ID',
            'Password' => 'nullable|min:6|max:255',
            'FullName' => 'required|max:100',
            'Email' => 'nullable|email|max:100|unique:Account,Email,' . $id . ',Account_ID',
            'PhoneNumber' => 'nullable|max:20',
            'Address' => 'nullable|max:255',
            'Avatar' => 'nullable|max:255',
            'Role' => 'required|in:Admin,Customer',
            'Status' => 'required|boolean',
        ]);

        $data = [
            'UserName' => $request->UserName,
            'FullName' => $request->FullName,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Address' => $request->Address,
            'Avatar' => $request->Avatar,
            'Role' => $request->Role,
            'Status' => $request->Status,
        ];

        if ($request->filled('Password')) {
            $data['Password'] = Hash::make($request->Password);
        }

        $account->update($data);
return redirect()
            ->route('admin.accounts.index')
            ->with('success', 'Account updated successfully.');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);

        $account->delete();

        return redirect()
            ->route('admin.accounts.index')
            ->with('success', 'Account deleted successfully.');
    }
}