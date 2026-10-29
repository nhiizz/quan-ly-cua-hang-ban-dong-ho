<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Orders;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order')
            ->orderBy('PaymentID', 'desc')
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Orders::orderBy('OrderID', 'desc')->get();

        return view('admin.payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'OrderID' => 'required|exists:Orders,OrderID',
            'PaymentMethod' => 'required|max:50',
            'TransactionCode' => 'nullable|max:100',
            'Amount' => 'required|numeric|min:0',
            'PaymentDate' => 'nullable|date',
            'PaymentStatus' => 'required|in:Pending,Paid,Failed',
        ]);

        $order = Orders::findOrFail($request->OrderID);

        $payment = Payment::create([
            'OrderID' => $order->OrderID,
            'PaymentMethod' => $request->PaymentMethod,
            'TransactionCode' => $request->TransactionCode,
            'Amount' => $request->Amount,
            'PaymentDate' => $request->PaymentDate,
            'PaymentStatus' => $request->PaymentStatus,
        ]);

        $order->update([
            'PaymentStatus' => $request->PaymentStatus,
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);

        $orders = Orders::orderBy('OrderID', 'desc')->get();

        return view('admin.payments.edit', compact(
            'payment',
            'orders'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'OrderID' => 'required|exists:Orders,OrderID',
            'PaymentMethod' => 'required|max:50',
            'TransactionCode' => 'nullable|max:100',
            'Amount' => 'required|numeric|min:0',
            'PaymentDate' => 'nullable|date',
            'PaymentStatus' => 'required|in:Pending,Paid,Failed',
        ]);

        $payment = Payment::findOrFail($id);

        $oldOrderID = $payment->OrderID;

        $payment->update([
            'OrderID' => $request->OrderID,
            'PaymentMethod' => $request->PaymentMethod,
            'TransactionCode' => $request->TransactionCode,
            'Amount' => $request->Amount,
            'PaymentDate' => $request->PaymentDate,
            'PaymentStatus' => $request->PaymentStatus,
        ]);

        $newOrder = Orders::findOrFail($request->OrderID);

        $newOrder->update([
            'PaymentStatus' => $request->PaymentStatus,
        ]);

        if ($oldOrderID != $request->OrderID) {
$oldOrder = Orders::find($oldOrderID);

            if ($oldOrder) {
                $oldOrder->update([
                    'PaymentStatus' => 'Pending',
                ]);
            }
        }

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        $orderID = $payment->OrderID;

        $payment->delete();

        $order = Orders::find($orderID);

        if ($order) {
            $order->update([
                'PaymentStatus' => 'Pending',
            ]);
        }

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
