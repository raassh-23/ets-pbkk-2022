<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?: '';

        $publishers = Publisher::whereRaw('LOWER(name) like ?', ['%'.strtolower($search).'%']);
        $publishers = $publishers->get();

        return view('publisher.index', compact('publishers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        return view('publisher.detail', compact('publisher'));
    }
}
