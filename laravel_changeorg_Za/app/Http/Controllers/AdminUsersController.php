<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Peticione;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(Request $request){
        $categorias = Categoria::paginate(5);
        return view('adminusers.index', compact('categorias'));
    }

    public function show(Request $request, $id){
        try {
            $peticion = Peticione::findOrFail($id);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage()->withInput());
        }
        return view('adminusers.show', compact('peticion'));
    }

    public function create(Request $request){
        $peticion = new Peticione();
        return view('adminusers.edit-add', compact('peticion'));
    }

    public function edit(Request $request, $id){
        try {
            $peticion = Peticione::findOrFail($id);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage()->withInput());
        }
        return view('adminusers.edit-add', compact('peticion'));
    }

    public function update(Request $request, $id){
        try {
            $peticion = Peticione::findOrFail($id);
            $peticion->update($request->all());
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage()->withInput());
        }
        return redirect(route('adminusers.index'));
    }

    public function delete(Request $request, $id){
        try {
            $peticion = Peticione::findOrFail($id);
            $peticion->delete();
        }
        catch (\Exception $exception){
            return back()->withError($exception->getMessage()->withInput());
        }
        return redirect()->back();
    }
}