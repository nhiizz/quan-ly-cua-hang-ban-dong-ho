<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'product'])
            ->orderBy('OrderDetailID', 'desc')
            ->get();

        return view('admin.order_details.index', compact('orderDetails'));
    }

public function create($order)
{
    $order = Orders::findOrFail($order);

    $products = Product::where('Status', 1)
        ->orderBy('ProductName')
        ->get();

    return view('admin.order_details.create', compact(
        'order',
        'products'
    ));
}

public function store(Request $request)
{
    $request->validate([
        'OrderID' => 'required|exists:Orders,OrderID',
        'Product_ID' => 'required|exists:Product,Product_ID',
        'Quantity' => 'required|integer|min:1',
    ]);

    $order = Orders::findOrFail($request->OrderID);

    if (in_array($order->OrderStatus, [
        'Shipped',
        'Delivered',
        'Cancelled'
    ])) {
        return back()
            ->withErrors([
                'OrderID' => 'Cannot add products to a completed order.'
            ])
            ->withInput();
    }

    $product = Product::findOrFail($request->Product_ID);

    $unitPrice = $product->Price;

    $subtotal = $request->Quantity * $unitPrice;

    OrderDetail::create([
        'OrderID' => $request->OrderID,
        'Product_ID' => $request->Product_ID,
        'Quantity' => $request->Quantity,
        'UnitPrice' => $unitPrice,
        'Subtotal' => $subtotal,
    ]);

    $this->updateOrderTotal($order);

    return redirect()
        ->route('admin.orders.show', $order->OrderID)
        ->with('success', 'Product added to order successfully.');
}
    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);

        $order = Orders::findOrFail($orderDetail->OrderID);

        $products = Product::where('Status', 1)
            ->orderBy('ProductName')
            ->get();

        return view('admin.order_details.edit', compact(
            'orderDetail',
            'order',
            'products'
));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Product_ID' => 'required|exists:Product,Product_ID',
            'Quantity' => 'required|integer|min:1',
        ]);

        $orderDetail = OrderDetail::findOrFail($id);

        $order = Orders::findOrFail($orderDetail->OrderID);

        if (in_array($order->OrderStatus, [
            'Shipped',
            'Delivered',
            'Cancelled'
        ])) {
            return back()
                ->withErrors([
                    'Product_ID' => 'Cannot edit products in a completed order.'
                ])
                ->withInput();
        }

        $product = Product::findOrFail($request->Product_ID);

        $unitPrice = $product->Price;

        $subtotal = $request->Quantity * $unitPrice;

        $orderDetail->update([
            'Product_ID' => $request->Product_ID,
            'Quantity' => $request->Quantity,
            'UnitPrice' => $unitPrice,
            'Subtotal' => $subtotal,
        ]);

        $this->updateOrderTotal($order);

        return redirect()
            ->route('admin.order-details.index')
            ->with('success', 'Order detail updated successfully.');
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);

        $order = Orders::findOrFail($orderDetail->OrderID);
        if (in_array($order->OrderStatus, [
            'Shipped',
            'Delivered',
            'Cancelled'
        ])) {
            return back()
                ->with('error', 'Cannot delete products from a completed order.');
        }

        $orderDetail->delete();

        $this->updateOrderTotal($order);

        return redirect()
            ->route('admin.order-details.index')
            ->with('success', 'Order detail deleted successfully.');
    }

    private function updateOrderTotal($order)
    {
        $total = OrderDetail::where('OrderID', $order->OrderID)
            ->sum('Subtotal');

        $order->update([
            'TotalAmount' => $total
        ]);
    }
    public function product()
{
    return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
}
}
