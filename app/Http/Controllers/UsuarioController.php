<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    public function index(Request $request){
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        //Query del cliente
        $query = User::query();

        // Aplicar filtros de busqueda si existen
        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('name', 'LIKE', "%{$buscar}%")
                    ->orWhere('email', 'LIKE', "%{$buscar}%");
            });
        }

        // Aplicar filtro de estado
        $usuarios = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('usuarios/index', compact('usuarios', 'buscar', 'porPagina'));
    }

    public function create(){
        return view('usuarios/crear');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => 'string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index');
    }

    public function edit(User $usuario){
        return view('usuarios/editar', compact('usuario'));
    }

    public function update(Request $request, User $usuario){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rol' => 'string'
        ]);

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('mensaje', 'Actualizado satisfactoriamente');
    }

    public function destroy(User $usuario){
        if($usuario->id == Auth::user()->id){
            return redirect()->route('usuarios.index');
        }
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('mensaje', 'Eliminado satisfactoriamente');
    }
}
