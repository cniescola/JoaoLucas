<x-app-layout>
    <x-slot name="header">
        <p class="text-[11px] tracking-wide text-gray-400 uppercase mb-1">Estoque</p>
        <h1 class="text-xl font-medium text-gray-900">Registrar saída</h1>
    </x-slot>

    <div class="max-w-md">
        <div class="bg-white border border-gray-200 rounded-2xl p-6">
            <form action="{{ route('saidas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Produto</label>
                    <select name="produto_id" class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Selecione o produto --</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                                {{ $produto->codigo }} — {{ $produto->nome }} (estoque atual: {{ $produto->estoque_atual }})
                            </option>
                        @endforeach
                    </select>
                    @error('produto_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade retirada</label>
                    <input type="number" name="quantidade" min="1" value="{{ old('quantidade') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('quantidade') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motivo / Observação</label>
                    <input type="text" name="motivo" placeholder="Ex: Uso na OS 123" value="{{ old('motivo') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="e_venda" id="e_venda" value="1"
                        class="rounded border-gray-300 text-blue-900 focus:ring-blue-500">
                    <label for="e_venda" class="text-sm text-gray-700">
                        Essa saída é uma venda no balcão (gera faturamento)
                    </label>
                </div>
                                <div class="flex gap-2 pt-2">
                    <button type="submit"
                            class="text-white text-sm font-medium px-4 py-2.5 rounded-lg" style="background:#A32D2D;">
                        Registrar saída
                    </button>
                    <a href="{{ route('saidas.index') }}"
                       class="text-sm text-gray-600 px-4 py-2.5 rounded-lg border border-gray-300 hover:bg-gray-50">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>