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
            $engins = Engin::orderBy('name', 'asc');
            if (request()->has('search'))
                $engins = $engins->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'engins' => $engins->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.engins.index', $data);
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
        $request['parc_id'] = $request->parc_id;
        $request['description'] = $request->description;

        $request->validate([
            'name'          => ['required', 'unique:engins', 'max:255'],
            'parc_id'       => ['required'],
        ]);
        try {
            Engin::create([
                'name'          => $request['name'],
                'parc_id'       => $request['parc_id'],
                'description'   => $request['description']
            ]);
            return redirect()->route('engins.index')->with('success', 'Engin ajouté avec succès!');
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
            $parcs = Parc::orderBy('name', 'asc')->get();
            $data = ['engin' => $engin, 'parcs' => $parcs];
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
            'parc_id'       => ['required'],
        ]);
        try {
            $engin->name = $request->input('name');
            $engin->parc_id = $request->input('parc_id');
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
