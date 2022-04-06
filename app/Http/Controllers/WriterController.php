<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?: '';
        $writers = Writer::whereRaw('LOWER(name) like ?', ['%'.strtolower($search).'%'])->get();
        
        return view('writer.index', compact('writers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function show(Writer $writer)
    {
        return view('writer.detail', compact('writer'));
    }
}
