<div x-data="{ 
    slideOverOpen: false 
}"
class="relative z-50 w-auto h-auto">

<button @click="slideOverOpen=true" 
    class="flex items-center px-4 py-2 text-sm font-medium tracking-wider text-white uppercase transition-all duration-300 bg-blue-500 rounded-l-lg shadow-lg hover:bg-blue-600 focus:outline-none font-roboto-condensed">
    <span class="mr-2">Ce e nou?</span>
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M9 5l7 7-7 7" />
    </svg>
</button>

<template x-teleport="body">
    <div 
        x-show="slideOverOpen"
        @keydown.window.escape="slideOverOpen=false"
        class="relative z-[99]">
        <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div 
                        x-show="slideOverOpen" 
                        @click.away="slideOverOpen = false"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                        x-transition:enter-start="translate-x-full" 
                        x-transition:enter-end="translate-x-0" 
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                        x-transition:leave-start="translate-x-0" 
                        x-transition:leave-end="translate-x-full" 
                        class="w-screen max-w-md">
                        <div class="flex flex-col h-full py-6 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-2xl font-semibold leading-6 text-gray-900 font-roboto-condensed" id="slide-over-title">Ce mai e nou?</h2>
                                    <div class="flex items-center ml-3 h-7">
                                        <button @click="slideOverOpen=false" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex-1 px-4 mt-6 sm:px-6">
                                <!-- Content -->
                                <div class="absolute inset-0 px-4 sm:px-6">
                                    <div class="h-full border-2 border-gray-200 border-dashed" aria-hidden="true">
                                        <div class="p-4">
                                            <h3 class="mb-8 text-xl tracking-widest text-center text-gray-700 uppercase font-roboto-condensed md:text-2xl">"Gânduri Bune"</h3>
                                            
                                            <div class="max-w-3xl mx-auto">
                                                <a href="https://clickmusic.ro/blog/lansare-in-premiera-click-ganduri-bune-prod-dj-twist" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer" 
                                                   @click.stop
                                                   class="block overflow-hidden transition-transform duration-300 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 relative z-[100]">
                                                    <img src="{{ asset('img/GanduriBune.jpg') }}" 
                                                         alt="Click - Gânduri Bune (Prod. DJ Twist)" 
                                                         class="w-full h-auto"
                                                         width="1200" 
                                                         height="630"
                                                         loading="lazy">          
                                                </a>
                                                
                                                <p class="mt-6 text-sm leading-relaxed text-gray-600 font-roboto-condensed md:text-base">
                                                    "Gânduri Bune" este o piesă care îmi este foarte dragă și care explorează puterea gândurilor pozitive și impactul lor asupra vieții noastre. <br><br>
                                                    Piesa a fost disponibila in premiera in sectiunea ACCES PREMIUM, iar acum poate fi ascultata pe Youtube si pe toate platformele de streaming. Linkul de Youtube il gasiti in articol. Click pe poza pentru a citi articolul complet.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /End Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
</div>