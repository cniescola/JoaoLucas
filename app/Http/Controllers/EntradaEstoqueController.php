<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\MovimentacaoEstoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntradaEstoqueController extends Controller
{
    public function index()
    {
        $entradas = MovimentacaoEstoque::with('produto')
            ->where('tipo', 'entrada')
            ->latest()
            ->get();

        return view('estoque.entradas.index', compact('entradas'));
    }

    public function create()
    {
        $produtos = Produto::orderBy('nome')->get();

        return view('estoque.entradas.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'motivo'     => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validado) {

            MovimentacaoEstoque::create([
                'produto_id' => $validado['produto_id'],
                'tipo'       => 'entrada',
                'quantidade' => $validado['quantidade'],
                'motivo'     => $validado['motivo'] ?? 'Entrada manual',
                'user_id'    => auth()->id(),
            ]);

            Produto::where('id', $validado['produto_id'])
                ->increment('estoque_atual', $validado['quantidade']);
        });

        return redirect()->route('entradas.index')
            ->with('sucesso', 'Entrada de estoque registrada com sucesso!');
    }
}