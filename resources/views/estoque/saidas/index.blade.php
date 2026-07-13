<x-app-layout>
    <x-slot name="header">
        <p class="text-[11px] tracking-wide text-gray-400 uppercase mb-1">Estoque</p>
        <h1 class="text-xl font-medium text-gray-900">Saídas de estoque</h1>
    </x-slot>

    <div class="space-y-4">
        @if (session('sucesso'))
            <div class="p-4 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('sucesso') }}</div>
        @endif

        <div>
            <a href="{{ route('saidas.create') }}"
               class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors"
               style="background:#0c1f33;" onmouseover="this.style.background='#16324d'" onmouseout="this.style.background='#0c1f33'">
                <i class="ti ti-plus text-base"></i>
                Registrar saída
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Data</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Produto</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal text-right">Quantidade</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Motivo</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal text-right">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saidas as $saida)
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-500">{{ $saida->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3.5 text-gray-900">{{ $saida->produto->nome }}</td>
                            <td class="px-5 py-3.5 text-right font-medium" style="color:#A32D2D;">-{{ $saida->quantidade }}</td>
                            <td class="px-5 py-3.5 text-gray-500">{{ $saida->motivo ?? '—' }}</td>
                            <td class="px-5 py-3.5 text-right {{ $saida->e_venda ? 'font-medium' : 'text-gray-400' }}" style="{{ $saida->e_venda ? 'color:#3B6D11;' : '' }}">
                              {{ $saida->e_venda ? 'R$ ' . number_format($saida->valor_venda, 2, ',', '.') : '—' }}
                           </td>
                        </tr>
                    @endforeach
                    @if ($saidas->isEmpty())
                        <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Nenhuma saída registrada ainda.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>