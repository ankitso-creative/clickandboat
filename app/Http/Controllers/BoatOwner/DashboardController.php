<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = 'dashboard'; 
        $userData = User::where('id', auth()->user()->id)->with(['profile', 'media', 'listingOrders'])->withCount(['listingOrders', 'listing'])->first();
        $listingCount = $userData->listing_count;
        $ordersCount = $userData->listing_orders_count;
        $totals = $userData->listingOrders()
        ->getQuery()
        ->selectRaw('
            SUM(amount_paid) as total_paid,
            SUM(pending_amount) as total_pending,
            SUM(total) as total_amount
        ')
        ->first();
        $amountPaidAmount = $totals->total_paid ?? 0;
        $pendingAmount = $totals->total_pending ?? 0;
        $totalAmount = $totals->total_amount ?? 0;

        return view('boatowner.dashboard',compact('active','userData','listingCount','ordersCount','amountPaidAmount','pendingAmount','totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
