<div>
    <h5 class="font-title text-[25px] text-center text-brand-blue-400 uppercase tracking-widest mb-8">
        Registrar Nueva Categoría
    </h5>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-xl border border-brand-blue-100 overflow-hidden">
        <div class="bg-brand-blue-400 py-3 px-6">
            <p class="text-white font-title text-xs uppercase tracking-widest">Formulario de Registro</p>
        </div>

        <form wire:submit.prevent="Guardar" class="p-8 space-y-6">
            <div>
                <label class="block font-body text-brand-blue-300 font-bold mb-2">Nombre de la Categoría</label>
                <input type="text" wire:model="nombre"
                    class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                    placeholder="Ej: Electrónica, Ropa, Hogar...">

                @error('nombre')
                    <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-body text-brand-blue-300 font-bold mb-2">Descripción</label>
                <textarea wire:model="descripcion" rows="4"
                    class="font-body w-full border-2 border-brand-blue-100 rounded-lg px-4 py-3 focus:border-brand-blue-300 focus:ring-0 text-main-black transition-all"
                    placeholder="Breve descripción de lo que incluye esta categoría..."></textarea>

                @error('descripcion')
                    <span class="text-btn-danger text-xs font-body mt-1 italic">{{ $message }}</span>
                @enderror
            </div>

            <hr class="border-brand-blue-50">

            <div class="flex justify-end gap-4">
                <button type="button" wire:click="Cancelar"
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
                    Guardar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
