<?php

namespace App\Http\Controllers;

use App\Models\Organe;
use App\Models\Typeorgane;
use DateTime;
use Illuminate\Http\Request;

class OrganeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $organes = Organe::orderBy('name', 'asc');
            if (request()->has('search'))
                $organes = $organes->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'organes' => $organes->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.organes.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $typeorganes = Typeorgane::orderBy('name', 'asc')->get();
            return view('configs.organes.create', ['typeorganes' => $typeorganes]);
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['name'] = $request->name;
        $request['typeorgane_id'] = $request->typeorgane_id;
        $request['description'] = $request->description;

        $request->validate([
            'name'          => ['required', 'unique:organes', 'max:255'],
            'typeorgane_id'   => ['required'],
        ]);
        try {
            Organe::create([
                'name'          => $request['name'],
                'typeorgane_id'   => $request['typeorgane_id'],
                'description'   => $request['description']
            ]);
            return redirect()->route('organes.index')->with('success', 'organe ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('organes.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(organe $organe)
    {
        try {
            return View('configs.organes.show', ['item' => $organe]);
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(organe $organe)
    {
        try {
            $typeorganes = Typeorgane::orderBy('name', 'asc')->get();
            return View('configs.organes.edit', ['organe' => $organe, 'typeorganes' => $typeorganes]);
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, organe $organe)
    {
        $request->validate([
            'name'          => ['required', 'unique:organes,name,' . $organe->id, 'max:255'],
            'typeorgane_id'   => ['required'],
        ]);
        try {
            $organe->name = $request->input('name');
            $organe->typeorgane_id = $request->input('typeorgane_id');
            $organe->description = $request->input('description') ?? "";
            $organe->updated_At = new DateTime(now());

            $organe->save();
            return redirect()->route('organes.index')->with('success', 'organe modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Organe $organe)
    {
        try {
            if (isset($request->name_delete) && $request->name_delete == $organe->name) {
                organe::destroy($organe->id);
                return redirect()->route('organes.index')->with('success', 'organe supprimé avec succès!');
            } else {
                return back()->with('error', "organe n'a pas été supprimé, veuillez saisir le nom du organe à supprimer");
            }
        } catch (\Throwable $th) {
            return redirect()->route('organes.index')->with('error', "Cet enregistrement n'a pas pu être supprimer.");
        }
    }
}