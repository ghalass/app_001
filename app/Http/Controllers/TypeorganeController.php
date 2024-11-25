<?php

namespace App\Http\Controllers;

use App\Models\Typeorgane;
use DateTime;
use Illuminate\Http\Request;

class TypeorganeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view typeorgane', ['only' => ['index', 'show']]);
        $this->middleware('permission:create typeorgane', ['only' => ['create', 'store']]);
        $this->middleware('permission:update typeorgane', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete typeorgane', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $typeorganes = Typeorgane::orderBy('name', 'asc');
            if (request()->has('search'))
                $typeorganes = $typeorganes->where('name', 'like', '%' . request()->get('search', '') . '%');

            $data = [
                'typeorganes' => $typeorganes->paginate(10),
                'search' => request()->get('search', '')
            ];

            return view('configs.typeorganes.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('configs.typeorganes.create');
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', $th->getMessage());
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
            'name'          => ['required', 'unique:typeorganes', 'max:255'],
            'description'   => ['max:255'],
        ]);

        try {
            Typeorgane::create([
                'name'          => $request['name'],
                'description'   => $request['description']
            ]);
            return redirect()->route('typeorganes.index')->with('success', 'Type organe ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Typeorgane $typeorgane)
    {
        try {
            return View('configs.typeorganes.show', ['item' => $typeorgane]);
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Typeorgane $typeorgane)
    {
        try {
            return View('configs.typeorganes.edit', ['typeorgane' => $typeorgane]);
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Typeorgane $typeorgane)
    {
        $request->validate([
            'name'          => ['required', 'unique:typeorganes,name,' . $typeorgane->id, 'max:255'],
            'description'   => ['max:255'],
        ]);
        try {
            $typeorgane->name = $request->input('name');
            $typeorgane->description = $request->input('description') ?? "";
            $typeorgane->updated_At = new DateTime();

            $typeorgane->save();
            return redirect()->route('typeorganes.index')->with('success', 'Type organe modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Typeorgane $typeorgane)
    {
        try {
            if (isset($request->name_delete) && $request->name_delete == $typeorgane->name) {
                Typeorgane::destroy($typeorgane->id);
                return redirect()->route('typeorganes.index')->with('success', 'typeorgane supprimé avec succès!');
            } else {
                return back()->with('error', "typeorgane n'a pas été supprimé, veuillez saisir le nom du typeorgane à supprimer");
            }
        } catch (\Throwable $th) {
            return redirect()->route('typeorganes.index')->with('error', "Cet enregistrement n'a pas pu être supprimer.");
        }
    }
}