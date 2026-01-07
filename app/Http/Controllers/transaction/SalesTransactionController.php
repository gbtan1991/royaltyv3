<?php

namespace App\Http\Controllers\transaction;

use App\Models\AdminProfile;
use App\Models\CustomerProfile;
use Illuminate\Http\Request;
use App\Models\SalesTransaction;
use App\Http\Controllers\Controller;

class SalesTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SalesTransaction::with(['customer.user',  'admin.user'])->latest()->paginate(15);
        
        return view('transaction.sales.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = CustomerProfile::with('user')->get();

        return view('transaction.sales.create', compact('customers'));

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
