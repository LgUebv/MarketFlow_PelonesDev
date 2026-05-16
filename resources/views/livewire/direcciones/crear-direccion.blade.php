<div>
    <!-- Título Principal -->
    <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-8">
        Registrar Nueva Dirección
    </h5>

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl border border-brand-blue-100 overflow-hidden">
        <div class="bg-brand-blue-400 py-3 px-6">
            <p class="text-white font-title text-xs uppercase tracking-widest">Formulario de Domicilio</p>
        </div>

        <form wire:submit.prevent="guardar" class="p-8 space-y-6">

            <!-- Fila 1: Ciudad y Estado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Ciudad</label>
                    <input type="text" wire:model="ciudad"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Ej: Lagos de Moreno">
                    @error('ciudad')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Estado</label>
                    <input type="text" wire:model="estado"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Ej: Jalisco">
                    @error('estado')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Fila 2: Calle y Código Postal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Calle</label>
                    <input type="text" wire:model="calle"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Nombre de la vialidad">
                    @error('calle')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Código Postal</label>
                    <input type="text" wire:model="codigo_postal"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="C.P.">
                    @error('codigo_postal')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Fila 3: Colonia y Números -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Colonia</label>
                    <input type="text" wire:model="colonia"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Nombre del barrio o colonia">
                    @error('colonia')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Núm. Exterior</label>
                    <input type="text" wire:model="numero_exterior"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Ej: 123">
                    @error('numero_exterior')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-body text-brand-blue-300 font-bold mb-2">Núm. Interior (Opcional)</label>
                    <input type="text" wire:model="numero_interior"
                        class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                        placeholder="Ej: Depto 2B">
                    @error('numero_interior')
                        <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Fila 4: Referencias -->
            <div>
                <label class="block font-body text-brand-blue-300 font-bold mb-2">Referencias</label>
                <textarea wire:model="refencias" rows="3"
                    class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                    placeholder="Ej: Fachada color azul, entre calles X y Y..."></textarea>
                @error('refencias')
                    <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                @enderror
            </div>

            <hr class="border-brand-blue-50">

            <!-- Botones -->
            <div class="flex justify-end gap-4">
                <button type="button" wire:click="cancelar"
                    class="bg-btn-danger text-white px-6 py-2 rounded-lg font-body font-bold hover:opacity-90 transition-all active:scale-95 shadow-md">
                    Cancelar
                </button>

                <button type="submit"
                    class="bg-btn-success text-white px-10 py-2 rounded-lg font-body font-bold hover:opacity-90 transition-all active:scale-95 shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2001/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Guardar Dirección
                </button>
            </div>
        </form>
    </div>
</div>
