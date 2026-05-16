<div>
    <div>
        @if (session()->has('mensaje'))
            <div
                class="mb-4 p-4 bg-btn-success/20 border border-btn-success rounded-lg text-btn-success font-bold text-center">
                {{ session('mensaje') }}
            </div>
        @endif

        <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-6">
            Mis Direcciones
        </h5>

        <div class="flex justify-end mb-8">
            <a href="{{ route('direcciones.create') }}"
                class="bg-brand-blue-400 text-white px-6 py-2 rounded-lg font-body font-bold hover:bg-brand-blue-300 transition-all active:scale-95 shadow-md flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2001/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Agregar Nueva Dirección
            </a>
        </div>

        <div class="mt-4">
            @if ($datos == null || $datos->isEmpty())
                <div
                    class="font-body text-center py-10 bg-brand-blue-50/20 rounded-xl border-2 border-dashed border-brand-blue-100 text-brand-blue-200">
                    <p class="text-xl">Aún no tienes direcciones registradas o no se encontraron resultados.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-xl shadow-xl border border-brand-blue-100">
                    <table class="w-full text-left bg-white border-collapse">
                        <thead class="bg-brand-blue-400 text-white font-title text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Ciudad</th>
                                <th class="px-6 py-4">Calle</th>
                                <th class="px-6 py-4">C.P.</th>
                                <th class="px-6 py-4 text-center">N° Int</th>
                                <th class="px-6 py-4 text-center">N° Ext</th>
                                <th class="px-6 py-4 text-center">Estado</th>
                                <th class="px-6 py-4 text-center">Colonia</th>
                                <th class="px-6 py-4 text-center">Referencias</th>
                                <th class="px-6 py-4 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="font-body text-[16px] text-main-black divide-y divide-gray-100">
                            @foreach ($datos as $item)
                                <tr class="hover:bg-brand-blue-50/30 transition-colors duration-200">
                                    <td class="px-6 py-4 font-semibold text-brand-blue-300">
                                        {{ $item->ciudad }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->calle }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->codigo_postal }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        {{ $item->numero_interior ?: 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        {{ $item->numero_exterior ?: 'S/N' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        {{ $item->estado }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        {{ $item->colonia }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        {{ $item->refencias ?: 'Sin referencias' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('direcciones.update', $item->id_direccion) }}"
                                                wire:navigate
                                                class="inline-block p-2 bg-btn-success text-white rounded-lg hover:scale-110 transition-transform shadow-sm focus:outline-none"
                                                title="Modificar Dirección">
                                                <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>

                                            <button wire:click="eliminar({{ $item->id_direccion }})"
                                                wire:confirm="¿Estás seguro que quieres eliminar esta dirección?"
                                                class="p-2 bg-btn-danger text-white rounded-lg hover:scale-110 transition-transform shadow-sm focus:outline-none"
                                                title="Eliminar Dirección">
                                                <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
