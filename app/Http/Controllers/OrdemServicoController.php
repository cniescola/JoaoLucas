<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\Cliente;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    // Lista todas as OS, mais recentes primeiro
    public function index()
    {
        $ordens = OrdemServico::with('cliente', 'veiculo')
            ->latest()
            ->get();

        return view('os.index', compact('ordens'));
    }

    // Formulário de abertura de uma nova OS
    public function create()
    {
        $clientes = Cliente::with('veiculos')->orderBy('nome')->get();

        return view('os.create', compact('clientes'));
    }

    // Cria a "capa" da OS (sem itens ainda -- os itens são
    // adicionados depois, na tela de detalhes)
    public function store(Request $request)
    {
        $validado = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'observacoes' => 'nullable|string',
        ]);

        $os = OrdemServico::create($validado);

        return redirect()->route('os.show', $os)
            ->with('sucesso', 'Ordem de Serviço aberta! Agora adicione as peças e serviços.');
    }

    // Tela de detalhes: mostra os itens, permite adicionar
    // peças/serviços, e mudar o status
    public function show(OrdemServico $os)
    {
        $os->load('cliente', 'veiculo', 'itens.produto', 'itens.servico');

        $produtos = \App\Models\Produto::orderBy('nome')->get();
        $servicos = \App\Models\Servico::orderBy('nome')->get();

        return view('os.show', compact('os', 'produtos', 'servicos'));
    }

    // Atualiza só o status e/ou observações da OS
    public function update(Request $request, OrdemServico $os)
    {
        $validado = $request->validate([
            'status' => 'required|in:aberta,em_andamento,concluida,cancelada',
            'observacoes' => 'nullable|string',
        ]);

        // Se o novo status for "concluida" e ainda não tiver
        // data de conclusão registrada, preenche automaticamente com agora
        if ($validado['status'] === 'concluida' && !$os->data_conclusao) {
            $validado['data_conclusao'] = now();
        }

        $os->update($validado);

        return redirect()->route('os.show', $os)
            ->with('sucesso', 'Ordem de Serviço atualizada!');
    }

    public function destroy(OrdemServico $os)
    {
        $os->delete();

        return redirect()->route('os.index')
            ->with('sucesso', 'Ordem de Serviço removida.');
    }
}