<x-app-layout>
    <x-slot name="header">
        <p class="text-[11px] tracking-wide text-gray-400 uppercase mb-1">Oficina</p>
        <h1 class="text-xl font-medium text-gray-900">Ordem de Serviço #{{ $os->id }}</h1>
    </x-slot>

    <div class="max-w-3xl space-y-6">

        @if (session('sucesso'))
            <div class="p-4 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('sucesso') }}</div>
        @endif

        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <div class="flex justify-between items-start mb-5">
                <div class="text-sm text-gray-600 space-y-1">
                    <p>Cliente: <span class="text-gray-900 font-medium">{{ $os->cliente->nome }}</span></p>
                    <p>Veículo: <span class="text-gray-900 font-medium">{{ $os->veiculo->placa }} — {{ $os->veiculo->marca }} {{ $os->veiculo->modelo }}</span></p>
                    <p class="text-gray-400 text-xs">Aberta em {{ $os->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <p class="text-2xl font-medium text-gray-900">R$ {{ number_format($os->valor_total, 2, ',', '.') }}</p>
            </div>

            <form action="{{ route('os.update', $os) }}" method="POST" class="flex items-end gap-2">
                @csrf
                @method('PUT')
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="aberta" {{ $os->status == 'aberta' ? 'selected' : '' }}>Aberta</option>
                        <option value="em_andamento" {{ $os->status == 'em_andamento' ? 'selected' : '' }}>Em andamento</option>
                        <option value="concluida" {{ $os->status == 'concluida' ? 'selected' : '' }}>Concluída</option>
                        <option value="cancelada" {{ $os->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                <input type="hidden" name="observacoes" value="{{ $os->observacoes }}">
                <button type="submit" class="text-white text-sm font-medium px-4 py-2.5 rounded-lg" style="background:#0c1f33;">
                    Atualizar status
                </button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="text-sm font-medium text-gray-700 mb-4">Peças e serviços</p>

            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2.5 text-[11px] uppercase tracking-wide text-gray-400 font-normal">Item</th>
                            <th class="px-4 py-2.5 text-[11px] uppercase tracking-wide text-gray-400 font-normal text-right">Qtd</th>
                            <th class="px-4 py-2.5 text-[11px] uppercase tracking-wide text-gray-400 font-normal text-right">Valor unit.</th>
                            <th class="px-4 py-2.5 text-[11px] uppercase tracking-wide text-gray-400 font-normal text-right">Subtotal</th>
                            <th class="px-4 py-2.5 text-[11px] uppercase tracking-wide text-gray-400 font-normal">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($os->itens as $item)
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-3">
                                    {{ $item->nomeItem() }}
                                    <span class="text-xs text-gray-400">({{ $item->produto_id ? 'peça' : 'serviço' }})</span>
                                </td>
                                <td class="px-4 py-3 text-right text-gray-600">{{ $item->quantidade }}</td>
                                <td class="px-4 py-3 text-right text-gray-600">R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-gray-900">R$ {{ number_format($item->quantidade * $item->valor_unitario, 2, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('os.itens.destroy', $item) }}" method="POST" onsubmit="return confirm('Remover este item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs" style="color:#A32D2D;">Remover</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($os->itens->isEmpty())
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum item adicionado ainda.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="text-sm font-medium text-gray-700 mb-3">Adicionar peça</p>
            <form action="{{ route('os.itens.store', $os) }}" method="POST" class="flex gap-2 items-end">
                @csrf
                <input type="hidden" name="tipo" value="produto">
                <div class="flex-1">
                    <select name="produto_id" class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Selecione a peça --</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}">
                                {{ $produto->nome }} (estoque: {{ $produto->estoque_atual }}) — R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="number" name="quantidade" value="1" min="1" class="w-20 rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                <button type="submit" class="text-white text-sm font-medium px-4 py-2.5 rounded-lg" style="background:#3B6D11;">Adicionar</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <p class="text-sm font-medium text-gray-700 mb-3">Adicionar serviço</p>
            <form action="{{ route('os.itens.store', $os) }}" method="POST" class="flex gap-2 items-end">
                @csrf
                <input type="hidden" name="tipo" value="servico">
                <div class="flex-1">
                    <select name="servico_id" class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Selecione o serviço --</option>
                        @foreach ($servicos as $servico)
                            <option value="{{ $servico->id }}">{{ $servico->nome }} — R$ {{ number_format($servico->valor_padrao, 2, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="number" name="quantidade" value="1" min="1" class="w-20 rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                <button type="submit" class="text-white text-sm font-medium px-4 py-2.5 rounded-lg" style="background:#185FA5;">Adicionar</button>
            </form>
        </div>

    </div>
</x-app-layout>