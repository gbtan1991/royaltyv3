<?php

namespace App\Http\Controllers\transaction;

use App\Models\PointsLedger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointsLedgerController extends Controller
{
 public function index()
{
    $ledgerEntries = PointsLedger::with(['customer.customerProfile', 'salesTransaction'])
        // Change ->latest() to this:
        ->orderBy('id', 'desc') 
        ->paginate(15);

    return view('transaction.ledger.index', compact('ledgerEntries'));
}
}
