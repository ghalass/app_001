<?php

namespace App\Http\Controllers;

use App\Models\Typeparc;
use DateTime;
use Illuminate\Http\Request;

class TypeparcController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view typeparc', ['only' => ['index', 'show']]);
        $this->middleware('permission:create typeparc', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit typeparc', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete typeparc', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $typeparcs = Typeparc::orderBy('name', 'asc');
            if (request()->has('search'))
                $typeparcs = $typeparcs->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'typeparcs' => $typeparcs->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.typeparcs.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('configs.typeparcs.create');
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', $th->getMessage());
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
            'name'          => ['required', 'unique:typeparcs', 'max:255'],
            'description'   => ['max:255'],
        ]);

        try {
            Typeparc::create([
                'name'          => $request['name'],
                'description'   => $request['description']
            ]);
            return redirect()->route('typeparcs.index')->with('success', 'Type parc ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Typeparc $typeparc)
    {
        try {
            return View('configs.typeparcs.show', ['item' => $typeparc]);
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typeparc $typeparc)
    {
        try {
            return View('configs.typeparcs.edit', ['typeparc' => $typeparc]);
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Typeparc $typeparc)
    {
        $request->validate([
            'name'          => ['required', 'unique:typeparcs,name,' . $typeparc->id, 'max:255'],
            'description'   => ['max:255'],
        ]);
        try {
            $typeparc->name = $request->input('name');
            $typeparc->description = $request->input('description') ?? "";
            $typeparc->updated_At = new DateTime();

            $typeparc->save();
            return redirect()->route('typeparcs.index')->with('success', 'Type parc modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Typeparc $typeparc)
    {
        try {
            if (isset($request->name_delete) && $request->name_delete == $typeparc->name) {
                Typeparc::destroy($typeparc->id);
                return redirect()->route('typeparcs.index')->with('success', 'typeparc supprimé avec succès!');
            } else {
                return back()->with('error', "typeparc n'a pas été supprimé, veuillez saisir le nom du typeparc à supprimer");
            }
        } catch (\Throwable $th) {
            return redirect()->route('typeparcs.index')->with('error', "Cet enregistrement n'a pas pu être supprimer.");
        }
    }
}
