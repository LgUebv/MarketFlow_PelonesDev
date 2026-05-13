<div class="min-h-screen bg-gray-100 p-6 md:p-12 font-['Inter']">
    <div class="max-w-[1400px] mx-auto">
        <header class="mb-10">
            <h1 class="text-4xl font-extrabold text-main-dark" style="font-family: 'Julius Sans One', sans-serif;">
                Tu Pedido
            </h1>
        </header>

        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <div class="w-full lg:w-[65%] bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" style="font-family: 'Julius Sans One', sans-serif;">
                <div class="p-8 md:p-5 space-y-8">
                    @foreach($productos as $item)
                    <div class="flex gap-6 items-center border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                        <div class="w-28 h-28 flex-shrink-0 bg-gray-50 rounded-2xl overflow-hidden border border-gray-200">
                            <img src="https://via.placeholder.com/150" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-grow space-y-4">
                            <h2 class="text-lg font-bold text-main-dark">{{ $item['nombre'] }}</h2>
                            <div class="flex flex-col space-y-1">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Cantidad</span>
                                <input type="number" value="{{ $item['cantidad'] }}" min="1"
                                    class="w-20 bg-gray-50 border border-gray-300 rounded-lg py-1 px-2 text-sm font-bold text-main-dark focus:ring-2 focus:ring-btn-buy outline-none transition-all">
                            </div>
                        </div>

                        <div class="text-right">
                            <span class="text-2xl font-black text-main-dark tracking-tighter">
                                ${{ number_format($item['precio'], 2) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="bg-gray-50 px-10 py-8 flex justify-between items-center border-t border-gray-100">
                    <span class="text-base font-bold text-gray-400 uppercase tracking-[0.2em]">Total</span>
                    <span class="text-4xl font-black text-main-dark" style="font-family: 'Julius Sans One', sans-serif;">
                        $ 3,400.00
                    </span>
                </div>
            </div>

            <div class="w-full lg:w-[35%] space-y-6">
                <div class="bg-main-dark rounded-4xl p-10 shadow-2xl text-black border border-white/5" style="font-family: 'Julius Sans One', sans-serif;">
                    <h3 class="text-xl font-bold mb-8 border-b border-white/10 pb-4">Checkout</h3>

                    <div class="space-y-8">
                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-black/70 uppercase tracking-widest ml-1">Dirección de Envío</label>
                            <div class="relative">
                                <select class="w-full bg-white/10 border border-white/20 rounded-2xl py-4 px-5 font-ligth text-sm text-black appearance-none outline-none focus:ring-2 focus:ring-btn-buy">
                                    <option class="text-black">Calle Morelos #123, Col. Centro</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[11px] font-black text-black/70 uppercase tracking-widest ml-1">Método de Pago</label>
                            <div class="grid gap-3">
                                <label class="flex items-center justify-between p-4 bg-white/10 border-2 border-btn-buy rounded-2xl cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="pago" class="w-5 h-5 text-btn-buy bg-transparent border-white/30 focus:ring-btn-buy" checked>
                                        <span class="text-sm font-bold">Tarjeta de Débito</span>
                                    </div>
                                    <span class="text-xs text-black/50 font-medium">**** 4242</span>
                                </label>

                                <label class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-2xl cursor-pointer hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="pago" class="w-5 h-5 text-btn-buy bg-transparent border-white/30 focus:ring-btn-buy">
                                        <span class="text-sm font-bold">PayPal</span>
                                    </div>
                                    <span class="text-xs text-black/50 font-medium">Paypal Account</span>
                                </label>

                                <label class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-2xl cursor-pointer hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="pago" class="w-5 h-5 text-btn-buy bg-transparent border-white/30 focus:ring-btn-buy">
                                        <span class="text-sm font-bold">Tarjeta de Crédito</span>
                                    </div>
                                    <span class="text-xs text-black/50 font-medium">**** 5467</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button class="w-full bg-btn-buy text-main-dark font-black py-6 rounded-2xl transition-all shadow-xl shadow-btn-buy/20 active:scale-95 text-base uppercase tracking-widest">
                                Confirmar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
