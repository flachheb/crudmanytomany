<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::paginate(10);
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:modules,code|max:50',
            'title' => 'required|string|max:255',
            'MHP' => 'required|integer|min:0',
            'MHS' => 'required|integer|min:0',
        ]);

        Module::create($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:modules,code,' . $module->id,
            'title' => 'required|string|max:255',
            'MHP' => 'required|integer|min:0',
            'MHS' => 'required|integer|min:0',
        ]);

        $module->update($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index')
            ->with('success', 'Module supprimé avec succès.');
    }

    /**
     * Afficher le formulaire pour attacher des stagiaires à un module.
     */
    public function attachStagiaires(Module $module)
    {
        $stagiaires = \App\Models\Stagiaire::all();
        $attachedStagiaires = $module->stagiaires->pluck('id')->toArray();
        return view('modules.attach-stagiaires', compact('module', 'stagiaires', 'attachedStagiaires'));
    }

    /**
     * Enregistrer l'attachement des stagiaires.
     */
    public function storeStagiaires(Request $request, Module $module)
    {
        $validated = $request->validate([
            'stagiaires' => 'required|array',
            'stagiaires.*' => 'exists:stagiaires,id',
        ]);

        $module->stagiaires()->sync($validated['stagiaires']);

        return redirect()->route('modules.show', $module)
            ->with('success', 'Stagiaires attachés avec succès.');
    }
}