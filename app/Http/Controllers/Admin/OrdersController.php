<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Account;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::with('account')
            ->orderBy('OrderID', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $accounts = Account::where('Status', 1)->get();

        return view('admin.orders.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Account_ID' => 'required|exists:Account,Account_ID',
            'ReceiverName' => 'required|max:100',
            'Phone' => 'required|max:20',
            'ShippingAddress' => 'required|max:255',
            'TotalAmount' => 'required|numeric|min:0',
            'PaymentMethod' => 'required|max:50',
            'PaymentStatus' => 'required|in:Pending,Paid',
            'OrderStatus' => 'required|in:Pending,Processing,Shipping,Completed,Cancelled',
        ]);

        $order = Orders::create([
            'Account_ID' => $request->Account_ID,
            'ReceiverName' => $request->ReceiverName,
            'Phone' => $request->Phone,
            'ShippingAddress' => $request->ShippingAddress,
            'TotalAmount' => $request->TotalAmount,
            'PaymentMethod' => $request->PaymentMethod,
            'PaymentStatus' => $request->PaymentStatus,
            'OrderStatus' => $request->OrderStatus,
        ]);

        if ($request->PaymentStatus === 'Paid') {
            Payment::create([
                'OrderID' => $order->OrderID,
                'PaymentMethod' => $order->PaymentMethod,
                'TransactionCode' => null,
                'Amount' => $order->TotalAmount,
                'PaymentDate' => now(),
                'PaymentStatus' => 'Paid',
            ]);
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        $order = Orders::with('account')->findOrFail($id);

        $orderDetails = OrderDetail::with('product')
            ->where('OrderID', $order->OrderID)
            ->get();

        return view('admin.orders.show', compact(
            'order',
            'orderDetails'
        ));
    }

    public function edit($id)
    {
        $order = Orders::findOrFail($id);

        $accounts = Account::where('Status', 1)->get();

        return view('admin.orders.edit', compact(
            'order',
            'accounts'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Account_ID' => 'required|exists:Account,Account_ID',
            'ReceiverName' => 'required|max:100',
'Phone' => 'required|max:20',
            'ShippingAddress' => 'required|max:255',
            'TotalAmount' => 'required|numeric|min:0',
            'PaymentMethod' => 'required|max:50',
            'PaymentStatus' => 'required|in:Pending,Paid',
            'OrderStatus' => 'required|in:Pending,Processing,Shipping,Completed,Cancelled',
        ]);

        $order = Orders::findOrFail($id);

        $order->update([
            'Account_ID' => $request->Account_ID,
            'ReceiverName' => $request->ReceiverName,
            'Phone' => $request->Phone,
            'ShippingAddress' => $request->ShippingAddress,
            'TotalAmount' => $request->TotalAmount,
            'PaymentMethod' => $request->PaymentMethod,
            'PaymentStatus' => $request->PaymentStatus,
            'OrderStatus' => $request->OrderStatus,
        ]);

        $payment = Payment::where('OrderID', $order->OrderID)->first();

        if ($request->PaymentStatus === 'Paid') {

            if ($payment) {
                $payment->update([
                    'PaymentMethod' => $order->PaymentMethod,
                    'Amount' => $order->TotalAmount,
                    'PaymentStatus' => 'Paid',
                ]);
            } else {
                Payment::create([
                    'OrderID' => $order->OrderID,
                    'PaymentMethod' => $order->PaymentMethod,
                    'TransactionCode' => null,
                    'Amount' => $order->TotalAmount,
                    'PaymentDate' => now(),
                    'PaymentStatus' => 'Paid',
                ]);
            }

        } else {

            if ($payment) {
                $payment->update([
                    'PaymentStatus' => $request->PaymentStatus,
                ]);
            }
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        if ($order->OrderStatus === 'Delivered') {
            return back()->with(
                'error',
                'Cannot delete a delivered order.'
            );
        }

        OrderDetail::where('OrderID', $order->OrderID)->delete();

        Payment::where('OrderID', $order->OrderID)->delete();

        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Order deleted successfully.'
            );
    }
}
