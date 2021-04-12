<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    }   
}
