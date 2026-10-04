<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function track(Request $request)
{
    $search = $request->query('nota');
    $transaction = null;

    if ($search) {
        $transaction = Transaction::with(['customer', 'items.service'])
            ->where('invoice_number', $search)
            ->first();
    }

    return view('tracking', compact('transaction'));
}
}
