<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Mis Compras') }}
            </h2>
            <div class="text-sm text-gray-500">
                Bienvenido de nuevo, {{ explode(' ', Auth::user()->name)[0] }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8">

                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-gray-800">Historial de Pedidos</h3>
                    <a href="{{ route('catalogo') }}" class="bg-[#5C7AA3] hover:bg-[#274472] text-white px-5 py-2.5 rounded-md text-sm font-semibold transition">
                        Seguir comprando
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pedido</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="pb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600">
                            @forelse($pedidos as $pedido)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        #{{ $pedido->folio }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $pedido->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        ${{ number_format($pedido->totalCompra, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Entregado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <button class="text-gray-400 hover:text-indigo-600">
                                            <x-heroicon-o-eye class="w-5 h-5"/>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        Aún no has realizado ninguna compra.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center text-sm text-gray-400">
                    <span>Mostrando 1 a 2 de 2 pedidos</span>
                    <div class="flex rounded-md shadow-sm">
                        <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            &laquo;
                        </button>
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-[#1e293b] text-sm font-medium text-white">
                            1
                        </button>
                        <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            &raquo;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
