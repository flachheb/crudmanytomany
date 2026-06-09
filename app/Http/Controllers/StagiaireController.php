<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StagiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stagiaires = Stagiaire::paginate(4);
        return view('stagiaires.index', compact('stagiaires'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('stagiaires.create');
    }

    /**
     * Enregistrer un nouveau stagiaire.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'cef'           => 'required|string|unique:stagiaires,cef|max:255',
            'email'         => 'required|email|unique:stagiaires,email|max:255',
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'city'          => 'nullable|string|max:100',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos_stagiaires', 'public');
        }

        Stagiaire::create($validated);

        return redirect()->route('stagiaires.index')
            ->with('success', 'Stagiaire créé avec succès.');
    }

    /**
     * Afficher les détails d'un stagiaire.
     */
    public function show(Stagiaire $stagiaire)
    {
        return view('stagiaires.show', compact('stagiaire'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(Stagiaire $stagiaire)
    {
        return view('stagiaires.edit', compact('stagiaire'));
    }

    /**
     * Mettre à jour les données du stagiaire.
     */
    public function update(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'cef'           => 'required|string|max:255|unique:stagiaires,cef,' . $stagiaire->id,
            'email'         => 'required|email|max:255|unique:stagiaires,email,' . $stagiaire->id,
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'city'          => 'nullable|string|max:100',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($stagiaire->photo) {
                Storage::disk('public')->delete($stagiaire->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos_stagiaires', 'public');
        }

        $stagiaire->update($validated);

        return redirect()->route('stagiaires.index')
            ->with('success', 'Stagiaire mis à jour avec succès.');
    }

    /**
     * Supprimer un stagiaire.
     */
    public function destroy(Stagiaire $stagiaire)
    {
        if ($stagiaire->photo) {
            Storage::disk('public')->delete($stagiaire->photo);
        }

        $stagiaire->delete();

        return redirect()->route('stagiaires.index')
            ->with('success', 'Stagiaire supprimé avec succès.');
    }

    /**
     * Afficher le formulaire pour attacher des modules à un stagiaire.
     */
    public function attachModules(Stagiaire $stagiaire)
    {
        $modules = \App\Models\Module::all();
        $attachedModules = $stagiaire->modules->pluck('id')->toArray();
        return view('stagiaires.attach-modules', compact('stagiaire', 'modules', 'attachedModules'));
    }

    /**
     * Enregistrer l'attachement des modules.
     */
    public function storeModules(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            'modules' => 'required|array',
            'modules.*' => 'exists:modules,id',
        ]);

        $stagiaire->modules()->sync($validated['modules']);

        return redirect()->route('stagiaires.show', $stagiaire)
            ->with('success', 'Modules attachés avec succès.');
    }
}
