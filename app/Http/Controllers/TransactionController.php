<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Approval Actions.
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval(TransactionRequest $request, $id)
    {
        Transaction::findOrFail($id)->update(['status' => $request->status]);

        return response()->json(true);
    }   
}
