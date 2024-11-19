<?php

namespace App\Http\Controllers;

use App\Models\Site;
use DateTime;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sites = Site::orderBy('name', 'asc')->paginate(10);
            return view('configs.sites.index', ['sites' => $sites]);
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('configs.sites.create');
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
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
            'name'          => ['required', 'unique:sites', 'max:255'],
            'description'   => ['max:255'],
        ]);

        try {
            Site::create([
                'name'          => $request['name'],
                'description'   => $request['description']
            ]);
            return redirect()->route('sites.index')->with('success', 'Site ajouté avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('sites.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        try {
            return View('configs.sites.show', ['site' => $site]);
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        try {
            return View('configs.sites.edit', ['site' => $site]);
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'name'          => ['required', 'unique:typeparcs,name,' . $site->id, 'max:255'],
            'description'   => ['max:255'],
        ]);
        try {
            $site->name = $request->input('name');
            $site->description = $request->input('description') ?? "";
            $site->updated_At = new DateTime();

            $site->save();
            return redirect()->route('sites.index')->with('success', 'Site modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        try {
            Site::destroy($site->id);
            return redirect()->route('sites.index')->with('success', 'Site supprimé avec succès!');
        } catch (\Throwable $th) {
            return redirect()->route('sites.index')->with('error', $th->getMessage());
        }
    }
}
