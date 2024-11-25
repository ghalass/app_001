<?php

namespace App\Http\Controllers;

use App\Models\Lubrifiant;
use App\Models\Typelubrifiant;
use DateTime;
use Illuminate\Http\Request;

class LubrifiantController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view lubrifiant', ['only' => ['index', 'show']]);
        $this->middleware('permission:create lubrifiant', ['only' => ['create', 'store']]);
        $this->middleware('permission:update lubrifiant', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete lubrifiant', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lubrifiants = Lubrifiant::orderBy('name', 'asc');
            if (request()->has('search'))
                $lubrifiants = $lubrifiants->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'lubrifiants' => $lubrifiants->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.lubrifiants.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $typelubrifiants = Typelubrifiant::orderBy('name', 'asc')->get();
            return view('configs.lubrifiants.create', ['typelubrifiants' => $typelubrifiants]);
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['name'] = $request->name;
        $request['typelubrifiant_id'] = $request->typelubrifiant_id;
        $request['description'] = $request->description;

        $request->validate([
            'name'              => ['required', 'unique:lubrifiants', 'max:255'],
            'typelubrifiant_id' => ['required'],
        ]);
        try {
            Lubrifiant::create([
                'name'              => $request['name'],
                'typelubrifiant_id' => $request['typelubrifiant_id'],
                'description'       => $request['description']
            ]);
            return redirect()->route('lubrifiants.index')->with('success', 'Lubrifiant ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lubrifiant $lubrifiant)
    {
        try {
            return View('configs.lubrifiants.show', ['item' => $lubrifiant]);
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lubrifiant $lubrifiant)
    {
        try {
            $typelubrifiants = Typelubrifiant::orderBy('name', 'asc')->get();
            return View('configs.lubrifiants.edit', ['lubrifiant' => $lubrifiant, 'typelubrifiants' => $typelubrifiants]);
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lubrifiant $lubrifiant)
    {
        $request->validate([
            'name'              => ['required', 'unique:lubrifiants,name,' . $lubrifiant->id, 'max:255'],
            'typelubrifiant_id' => ['required'],
        ]);
        try {
            $lubrifiant->name = $request->input('name');
            $lubrifiant->typelubrifiant_id = $request->input('typelubrifiant_id');
            $lubrifiant->description = $request->input('description') ?? "";
            $lubrifiant->updated_At = new DateTime(now());

            $lubrifiant->save();
            return redirect()->route('lubrifiants.index')->with('success', 'Lubrifiant modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Lubrifiant $lubrifiant)
    {
        try {
            if (isset($request->name_delete) && $request->name_delete == $lubrifiant->name) {
                Lubrifiant::destroy($lubrifiant->id);
                return redirect()->route('lubrifiants.index')->with('success', 'lubrifiant supprimé avec succès!');
            } else {
                return back()->with('error', "lubrifiant n'a pas été supprimé, veuillez saisir le nom du lubrifiant à supprimer");
            }
        } catch (\Throwable $th) {
            return redirect()->route('lubrifiants.index')->with('error', "Cet enregistrement n'a pas pu être supprimer.");
        }
    }
}