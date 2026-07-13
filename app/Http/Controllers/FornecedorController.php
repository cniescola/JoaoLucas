<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    // Lista todos os fornecedores, ordenados por nome
    public function index()
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();

        return view('fornecedores.index', compact('fornecedores'));
    }

    // Mostra o formulário de cadastro vazio
    public function create()
    {
        return view('fornecedores.create');
    }

    // Recebe os dados do formulário e salva no banco
    public function store(Request $request)
    {
        $validado = $request->validate([
            'nome'      => 'required|string|max:255',
            'cnpj'      => 'nullable|string|max:20|unique:fornecedores,cnpj',
            'telefone'  => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
        ]);

        Fornecedor::create($validado);

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor cadastrado com sucesso!');
    }

    // Mostra o formulário já preenchido para edição
    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    // Atualiza um fornecedor existente
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $validado = $request->validate([
            'nome'      => 'required|string|max:255',
            'cnpj'      => 'nullable|string|max:20|unique:fornecedores,cnpj,' . $fornecedor->id,
            'telefone'  => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
        ]);

        $fornecedor->update($validado);

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor atualizado com sucesso!');
    }

    // Remove um fornecedor do banco de dados
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor removido com sucesso!');
    }
}