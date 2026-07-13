<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\OsItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OsItemController extends Controller
{
    // Adiciona um item (peça ou serviço) a uma OS
    public function store(Request $request, OrdemServico $os)
    {
        $validado = $request->validate([
            'tipo'       => 'required|in:produto,servico',
            'produto_id' => 'required_if:tipo,produto|nullable|exists:produtos,id',
            'servico_id' => 'required_if:tipo,servico|nullable|exists:servicos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validado, $os) {

            if ($validado['tipo'] === 'produto') {
                $produto = Produto::find($validado['produto_id']);

                // Confere se tem estoque suficiente antes de adicionar
                if ($validado['quantidade'] > $produto->estoque_atual) {
                    abort(422, "Estoque insuficiente para {$produto->nome}. Disponível: {$produto->estoque_atual}.");
                }

                $os->itens()->create([
                    'produto_id'     => $produto->id,
                    'quantidade'     => $validado['quantidade'],
                    'valor_unitario' => $produto->preco_venda,
                ]);

                // Dá baixa no estoque, igual fizemos no módulo de Saída
                Produto::where('id', $produto->id)
                    ->decrement('estoque_atual', $validado['quantidade']);

            } else {
                $servico = \App\Models\Servico::find($validado['servico_id']);

                $os->itens()->create([
                    'servico_id'     => $servico->id,
                    'quantidade'     => $validado['quantidade'],
                    'valor_unitario' => $servico->valor_padrao,
                ]);
            }

            // Recalcula o total da OS depois de adicionar o item
            $os->recalcularTotal();
        });

        return redirect()->route('os.show', $os)
            ->with('sucesso', 'Item adicionado à Ordem de Serviço!');
    }

    // Remove um item da OS
    public function destroy(OsItem $item)
    {
        $os = $item->ordemServico;

        DB::transaction(function () use ($item, $os) {
            // Se o item era uma peça, devolve a quantidade para o estoque
            if ($item->produto_id) {
                \App\Models\Produto::where('id', $item->produto_id)
                    ->increment('estoque_atual', $item->quantidade);
            }

            $item->delete();
            $os->recalcularTotal();
        });

        return redirect()->route('os.show', $os)
            ->with('sucesso', 'Item removido da Ordem de Serviço.');
    }
}