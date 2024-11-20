<?php

namespace App\Http\Controllers;

use App\Models\Parc;
use App\Models\Typeparc;
use DateTime;
use Illuminate\Http\Request;

class ParcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $parcs = Parc::orderBy('name', 'asc');
            if (request()->has('search'))
                $parcs = $parcs->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'parcs' => $parcs->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.parcs.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $typeparcs = Typeparc::orderBy('name', 'asc')->get();
            return view('configs.parcs.create', ['typeparcs' => $typeparcs]);
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
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
            return redirect()->route('parcs.index')->with('success', 'Parc ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('parcs.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Parc $parc)
    {
        try {
            return View('configs.parcs.show', ['item' => $parc]);
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parc $parc)
    {
        try {
            $typeparcs = Typeparc::orderBy('name', 'asc')->get();
            return View('configs.parcs.edit', ['parc' => $parc, 'typeparcs' => $typeparcs]);
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parc $parc)
    {
        $request->validate([
            'name'          => ['required', 'unique:parcs,name,' . $parc->id, 'max:255'],
            'typeparc_id'   => ['required'],
        ]);
        try {
            $parc->name = $request->input('name');
            $parc->typeparc_id = $request->input('typeparc_id');
            $parc->description = $request->input('description') ?? "";
            $parc->updated_At = new DateTime(now());

            $parc->save();
            return redirect()->route('parcs.index')->with('success', 'parc modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parc $parc)
    {
        try {
            Parc::destroy($parc->id);
            return redirect()->route('parcs.index')->with('success', 'parc supprimé avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('parcs.index')->with('error', $th->getMessage());
        }
    }
}