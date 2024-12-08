<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Receiver;


class CustomerController extends Controller
{
    //
    // public function index() {
    //     $customer = Customer::where('user_id', auth()->user()->id)->first();
    //     // return view('dashboard', compact('customer'));
    //     return view('auth.verify-email', compact('customer'));
    // }

    // public function index(Request $request)
    // {
    //     if (! $request->user()->hasVerifiedEmail()) {
    //         return view('auth.verify-email');
    //     }

    //     $customer = Customer::where('user_id', auth()->user()->id)->first();
    //     return view('dashboard', compact('customer'));
    // }
    public function index(Request $request)
    {
        if (! $request->user() || ! $request->user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }
        $user = $request->user();
        $customer = Customer::where('user_id', $request->user()->id)->first();

        return view('dashboard', compact('customer','user'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        $customer = Customer::where('user_id', Auth::id())->first(); 
        if ($customer) {
            $customer->update($validatedData);
            $message = 'Updated successfully!';
        } else {
            $customer = Customer::create([
                'user_id' => Auth::id(),
                'fullname' => $validatedData['fullname'],
                'birth' => $validatedData['birth'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ]);
            $message = 'Added successfully!';
        }

        return redirect()->route('dashboard')->with('success', 'Added successfully');
    }

}
