<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cascavel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/2.44.0/iconfont/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">

        {{-- Lado esquerdo: marca --}}
        <div class="hidden lg:flex w-1/2 flex-col justify-between p-12" style="background:#0c1f33;">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background:#16324d; border:0.5px solid #234a6b;">
                    <i class="ti ti-bolt text-xl" style="color:#85B7EB;"></i>
                </div>
                <div>
                    <p class="text-base font-medium text-white">Cascavel</p>
                    <p class="text-xs" style="color:#7a93ab;">Oficina e auto elétrica</p>
                </div>
            </div>

            <div>
                <p class="text-2xl font-medium text-white leading-snug max-w-sm">
                    Gestão completa de estoque, clientes e ordens de serviço, tudo em um só lugar.
                </p>
                <p class="text-sm mt-4" style="color:#7a93ab;">
                    Controle peças, veículos e o financeiro da sua oficina sem complicação.
                </p>
            </div>

            <p class="text-xs" style="color:#4a637a;">© {{ date('Y') }} Cascavel Oficina e Auto Elétrica</p>
        </div>

        {{-- Lado direito: formulário --}}
        <div class="flex-1 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-sm">
                <div class="lg:hidden flex items-center gap-3 mb-8">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background:#0c1f33;">
                        <i class="ti ti-bolt text-xl" style="color:#85B7EB;"></i>
                    </div>
                    <p class="text-base font-medium text-gray-900">Cascavel</p>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>