<?php

namespace App\Http\Controllers;

use App\Models\Typelubrifiant;
use DateTime;
use Illuminate\Http\Request;

class TypelubrifiantController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view typelubrifiant', ['only' => ['index', 'show']]);
        $this->middleware('permission:create typelubrifiant', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit typelubrifiant', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete typelubrifiant', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $typelubrifiants = Typelubrifiant::orderBy('name', 'asc');
            if (request()->has('search'))
                $typelubrifiants = $typelubrifiants->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'typelubrifiants' => $typelubrifiants->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.typelubrifiants.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('configs.typelubrifiants.create');
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['name'] = $request->name;
        $request['description'] = $request->description;

        $request->validate([
            'name'          => ['required', 'unique:typelubrifiants', 'max:255'],
            'description'   => ['max:255'],
        ]);

        try {
            Typelubrifiant::create([
                'name'          => $request['name'],
                'description'   => $request['description']
            ]);
            return redirect()->route('typelubrifiants.index')->with('success', 'Type lubrifiant ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Typelubrifiant $typelubrifiant)
    {
        try {
            return View('configs.typelubrifiants.show', ['item' => $typelubrifiant]);
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typelubrifiant $typelubrifiant)
    {
        try {
            return View('configs.typelubrifiants.edit', ['typelubrifiant' => $typelubrifiant]);
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Typelubrifiant $typelubrifiant)
    {
        $request->validate([
            'name'          => ['required', 'unique:typelubrifiants,name,' . $typelubrifiant->id, 'max:255'],
            'description'   => ['max:255'],
        ]);
        try {
            $typelubrifiant->name = $request->input('name');
            $typelubrifiant->description = $request->input('description') ?? "";
            $typelubrifiant->updated_At = new DateTime(now());

            $typelubrifiant->save();
            return redirect()->route('typelubrifiants.index')->with('success', 'Type lubrifiant modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Typelubrifiant $typelubrifiant)
    {
        try {
            if (isset($request->name_delete) && $request->name_delete == $typelubrifiant->name) {
                Typelubrifiant::destroy($typelubrifiant->id);
                return redirect()->route('typelubrifiants.index')->with('success', 'typelubrifiant supprimé avec succès!');
            } else {
                return back()->with('error', "typelubrifiant n'a pas été supprimé, veuillez saisir le nom du typelubrifiant à supprimer");
            }
        } catch (\Throwable $th) {
            return redirect()->route('typelubrifiants.index')->with('error', "Cet enregistrement n'a pas pu être supprimer.");
        }
    }
}