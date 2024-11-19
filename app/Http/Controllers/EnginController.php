<?php

namespace App\Http\Controllers;

use App\Models\Engin;
use App\Models\Parc;
use App\Models\Typeparc;
use DateTime;
use Illuminate\Http\Request;

class EnginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $engins = Engin::orderBy('name', 'asc')->paginate(10);
            return view('configs.engins.index', ['engins' => $engins]);
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $typeparcs = Typeparc::orderBy('name', 'asc')->get();
            $parcs = Parc::orderBy('name', 'asc')->get();
            $data = [
                'typeparcs' => $typeparcs,
                'parcs' => $parcs,
            ];
            return view('configs.engins.create', $data);
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        } //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['name'] = $request->name;
        $request['typeparc_id'] = $request->typeparc_id;
        $request['description'] = $request->description;

        $request->validate([
            'name'          => ['required', 'unique:parcs', 'max:255'],
            'typeparc_id'   => ['required'],
        ]);
        try {
            Parc::create([
                'name'          => $request['name'],
                'typeparc_id'   => $request['typeparc_id'],
                'description'   => $request['description']
            ]);
            return redirect()->route('engins.index')->with('success', 'Parc ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('engins.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Engin $engin)
    {
        try {
            return View('configs.engins.show', ['engin' => $engin]);
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Engin $engin)
    {
        try {
            $typeparcs = Typeparc::orderBy('name', 'asc')->get();
            $data = ['engin' => $engin, 'typeparcs' => $typeparcs];
            return View('configs.engins.edit', $data);
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Engin $engin)
    {
        $request->validate([
            'name'          => ['required', 'unique:engins,name,' . $engin->id, 'max:255'],
            'typeparc_id'   => ['required'],
        ]);
        try {
            $engin->name = $request->input('name');
            $engin->description = $request->input('description') ?? "";
            $engin->updated_At = new DateTime(now());

            $engin->save();
            return redirect()->route('engins.index')->with('success', 'Engin modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Engin $engin)
    {
        try {
            Engin::destroy($engin->id);
            return redirect()->route('engins.index')->with('success', 'Engin supprimé avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('engins.index')->with('error', $th->getMessage());
        }
    }
}
