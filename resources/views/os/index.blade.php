<x-app-layout>
    <x-slot name="header">
        <p class="text-[11px] tracking-wide text-gray-400 uppercase mb-1">Oficina</p>
        <h1 class="text-xl font-medium text-gray-900">Ordens de serviço</h1>
    </x-slot>

    <div class="space-y-4">
        @if (session('sucesso'))
            <div class="p-4 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('sucesso') }}</div>
        @endif

        <div>
            <a href="{{ route('os.create') }}"
               class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors"
               style="background:#0c1f33;" onmouseover="this.style.background='#16324d'" onmouseout="this.style.background='#0c1f33'">
                <i class="ti ti-plus text-base"></i>
                Abrir OS
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Cliente</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Veículo</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Status</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal text-right">Valor total</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Aberta em</th>
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cores = ['aberta' => '#185FA5', 'em_andamento' => '#5f5e5a', 'concluida' => '#3B6D11', 'cancelada' => '#A32D2D'];
                    @endphp
                    @foreach ($ordens as $ordem)
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-900">{{ $ordem->cliente->nome }}</td>
                            <td class="px-5 py-3.5 text-gray-500">{{ $ordem->veiculo->placa }} — {{ $ordem->veiculo->modelo }}</td>
                            <td class="px-5 py-3.5">
                                <span style="color: {{ $cores[$ordem->status] }}">● {{ str_replace('_', ' ', $ordem->status) }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-right text-gray-700">R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</td>
                            <td class="px-5 py-3.5 text-gray-500">{{ $ordem->created_at->format('d/m/Y') }}</td>
                            <td class="px-5 py-3.5">
                                <a href="{{ route('os.show', $ordem) }}" class="text-sm" style="color:#185FA5;">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($ordens->isEmpty())
                        <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Nenhuma Ordem de Serviço registrada ainda.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>