<x-app-layout>
    <x-slot name="header">
        <p class="text-[11px] tracking-wide text-gray-400 uppercase mb-1">Estoque</p>
        <h1 class="text-xl font-medium text-gray-900">Entradas de estoque</h1>
    </x-slot>

    <div class="space-y-4">
        @if (session('sucesso'))
            <div class="p-4 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('sucesso') }}</div>
        @endif

        <div>
            <a href="{{ route('entradas.create') }}"
               class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors"
               style="background:#0c1f33;" onmouseover="this.style.background='#16324d'" onmouseout="this.style.background='#0c1f33'">
                <i class="ti ti-plus text-base"></i>
                Registrar entrada
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
                        <th class="px-5 py-3 text-[11.5px] uppercase tracking-wide text-gray-400 font-normal">Registrado por</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada)
                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3.5 text-gray-500">{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3.5 text-gray-900">{{ $entrada->produto->nome }}</td>
                            <td class="px-5 py-3.5 text-right font-medium" style="color:#3B6D11;">+{{ $entrada->quantidade }}</td>
                            <td class="px-5 py-3.5 text-gray-500">{{ $entrada->motivo }}</td>
                            <td class="px-5 py-3.5 text-gray-500">{{ $entrada->usuario?->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                    @if ($entradas->isEmpty())
                        <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Nenhuma entrada registrada ainda.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>