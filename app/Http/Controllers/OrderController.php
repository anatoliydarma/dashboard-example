<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\DayService;

class OrderController extends Controller
{
    public function store(OrderRequest $request, DayService $dayService)
    {
        try {
            if ($request->has('tc')) {
                $dayService->setTc($request->all());
            }
            Order::create($request->validated());

            return back()->with('success', 'Created');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('error', 'Not created');
        }
    }

    public function update(OrderRequest $request, Order $order, DayService $dayService)
    {
        try {
            if ($request->has('tc')) {
                $dayService->setTc($request->all());
            }
            $order->update($request->validated());

            return back()->with('success', 'Updated');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('error', 'Not updated');
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return back()->with('success', 'Deleted');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('error', 'Not deleted');
        }
    }
}
