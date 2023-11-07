<?php

namespace App\Http\Controllers\Teg;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Teg;


class TegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Teg::all();

        return view('teg.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teg.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Teg::firstOrCreate($data);

        return redirect()->route('teg.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teg $teg)
    {
        return view('teg.show', compact('teg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teg $teg)
    {
        return view('teg.edit', compact('teg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Teg $teg)
    {
        $data = $request->validated();
        $teg->update($data);

        return view('teg.show', compact('teg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teg $teg)
    {
        $teg->delete();
        return redirect()->route('teg.index');
    }
}
