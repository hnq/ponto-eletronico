<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('manager_id', auth()->id())->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'cpf'         => 'required|cpf_valido|unique:users',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6',
            'position'    => 'required',
            'birth_date'  => 'required|date',
            'cep'         => 'required',
            'address'     => 'required',
        ]);

        User::create([
            'name'        => $request->name,
            'cpf'         => $request->cpf,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'position'    => $request->position,
            'birth_date'  => $request->birth_date,
            'cep'         => $request->cep,
            'address'     => $request->address,
            'manager_id'  => auth()->id(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Funcionário criado com sucesso.');
    }

    public function edit(User $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'cpf'         => 'required|cpf_valido|unique:users,cpf,' . $employee->id,
            'email'       => 'required|email|unique:users,email,' . $employee->id,
            'position'    => 'required',
            'birth_date'  => 'required|date',
            'cep'         => 'required',
            'address'     => 'required',
        ]);

        $employee->update($request->only([
            'name', 'cpf', 'email', 'position', 'birth_date', 'cep', 'address'
        ]));

        return redirect()->route('employees.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Funcionário removido com sucesso.');
    }
}
