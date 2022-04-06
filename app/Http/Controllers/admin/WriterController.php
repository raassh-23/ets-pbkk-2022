<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WriterController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $writers = Writer::all();

        return view('admin.writer.index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $path = Storage::disk('s3')->put('writers', $request->image);
        $url = Storage::disk('s3')->url($path);

        $writer = Writer::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'image_url' => $url,
        ]);

        if ($writer) {
            return redirect()->route('admin.writers.index')->with([
                'success' => 'Writer added successfully.',
            ]);
        }

        return redirect()->back()->with([
            'error' => 'Writer creation failed',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function edit(Writer $writer)
    {
        return view('admin.writer.edit', compact('writer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Writer $writer)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $newData = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if ($request->hasFile('image')) {
            $path = Storage::disk('s3')->put('writers', $request->image);
            $url = Storage::disk('s3')->url($path);
            $newData['image_url'] = $url;
        }

        $writer->update($newData);

        return redirect()->route('admin.writers.index')->with([
            'success' => 'Writer updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();

        return redirect()->back()->with([
            'success' => 'Writer deleted successfully.',
        ]);
    }
}
