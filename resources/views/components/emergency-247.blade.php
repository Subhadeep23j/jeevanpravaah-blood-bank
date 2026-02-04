{{-- 24x7 Emergency Slide-out (Right Side) --}}

<div id="jpEmergencyOverlay"
    class="fixed inset-0 z-[1040] bg-black/30 opacity-0 pointer-events-none transition-opacity duration-200">
</div>

{{-- Container: button + panel in a row, slides left/right together --}}
<div id="jpEmergency247Root"
    class="fixed top-1/3 z-[1050] flex flex-row items-start transition-transform duration-300 ease-out"
    style="right: 0; transform: translateX(320px);">

    {{-- Toggle Button (left side of the container) --}}
    <button id="jpEmergencyToggle" type="button" aria-controls="jpEmergencyPanel" aria-expanded="false"
        class="flex-shrink-0 select-none bg-red-600 hover:bg-red-700 text-white shadow-xl px-2 py-4 rounded-l-xl cursor-pointer">
        <span class="jp-emergency-vertical font-semibold tracking-wide text-sm">
            24x7 Emergency
        </span>
    </button>

    {{-- Panel (right side of the container) --}}
    <aside id="jpEmergencyPanel" role="dialog" aria-label="24x7 Emergency" aria-hidden="true"
        class="w-80 max-w-[85vw] bg-white shadow-2xl border border-gray-200 border-l-0 overflow-hidden flex-shrink-0">
        <div
            class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-red-50 to-white border-b border-gray-200">
            <div>
                <div class="text-sm font-semibold text-gray-900">24x7 Emergency</div>
                <div class="text-xs text-gray-500">Quick help & contact numbers</div>
            </div>
            <button id="jpEmergencyClose" type="button" class="p-2 rounded-lg hover:bg-red-50 text-gray-600 cursor-pointer"
                aria-label="Close emergency panel">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-4 space-y-3">
            <a class="block rounded-xl border border-gray-200 p-3 hover:border-red-300 hover:bg-red-50 transition"
                href="tel:112">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.86.3 1.7.54 2.5a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.58-1.06a2 2 0 0 1 2.11-.45c.8.24 1.64.42 2.5.54A2 2 0 0 1 22 16.92z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-900">Call 112</div>
                        <div class="text-xs text-gray-600">National Emergency (India)</div>
                    </div>
                    <div class="text-sm font-bold text-red-600">112</div>
                </div>
            </a>

            <a class="block rounded-xl border border-gray-200 p-3 hover:border-red-300 hover:bg-red-50 transition"
                href="tel:108">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.5 13.5L9 15l-3-3 1.5-1.5m9 0L15 15l-3-3 1.5-1.5M12 21a9 9 0 1 0-9-9 9 9 0 0 0 9 9z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-900">Ambulance</div>
                        <div class="text-xs text-gray-600">Emergency medical help</div>
                    </div>
                    <div class="text-sm font-bold text-red-600">108</div>
                </div>
            </a>

            <div class="rounded-xl border border-gray-200 p-3">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-700">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21h18M5 21V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14M9 21v-6a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-900">Local Blood Bank / Hospital</div>
                        <div class="text-xs text-gray-600">Set your contact number here</div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <a href="tel:+919999999999"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-900 text-white text-xs hover:bg-black transition">
                                Call
                            </a>
                            <span class="text-xs text-gray-500">+91 99999 99999</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-[11px] text-gray-500 leading-snug">
                Tip: You can change these numbers in this component file.
            </div>
        </div>
    </aside>
</div>
