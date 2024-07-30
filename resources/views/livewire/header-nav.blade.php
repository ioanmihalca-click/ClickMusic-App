<header class="bg-white shadow">
    <div class="container flex items-center justify-between px-4 py-6 mx-auto">
        <a href="/" class="flex items-center">
            <img src="/img/logo.png" alt="Logo Click Music" class="w-auto h-12">
        </a>
        
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" type="button" class="inline-flex items-center text-base font-semibold leading-6 text-gray-900 gap-x-1" aria-expanded="false">
                <span>Meniu</span>
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 flex w-screen px-4 mt-5 max-w-max">
               <div class="flex-auto w-screen max-w-md overflow-hidden text-sm leading-6 bg-white shadow-lg rounded-3xl ring-1 ring-gray-900/5">
      <div class="p-4">
        <div class="relative flex p-4 rounded-lg group gap-x-6 hover:bg-gray-50">
          <div class="flex items-center justify-center flex-none mt-1 rounded-lg h-11 w-11 bg-gray-50 group-hover:bg-white">
            <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />


            </svg>
          </div>
          <div>
            <a href="/" class="font-semibold text-gray-900">
              Acasă
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Mergi la prima pagină</p>
          </div>
        </div>
        <div class="relative flex p-4 rounded-lg group gap-x-6 hover:bg-gray-50">
          <div class="flex items-center justify-center flex-none mt-1 rounded-lg h-11 w-11 bg-gray-50 group-hover:bg-white">
            <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

            </svg>
          </div>
          <div>
            <a href="/magazin" class="font-semibold text-gray-900">
              Magazin
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Albume digitale si articole vestimentare</p>
          </div>
        </div>
        <div class="relative flex p-4 rounded-lg group gap-x-6 hover:bg-gray-50">
          <div class="flex items-center justify-center flex-none mt-1 rounded-lg h-11 w-11 bg-gray-50 group-hover:bg-white">
            <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />


            </svg>
          </div>
          <div>
            <a href="/blog" class="font-semibold text-gray-900">
              Blog
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Noutăți, articole și povești din viața mea</p>
          </div>
        </div>
        <div class="relative flex p-4 rounded-lg group gap-x-6 hover:bg-gray-50">
          <div class="flex items-center justify-center flex-none mt-1 rounded-lg h-11 w-11 bg-gray-50 group-hover:bg-white">
            <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round"  d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />


            </svg>
          </div>
          <div>
            <a href="/accespremium" class="font-semibold text-gray-900">
              Acces Premium
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Lansări, Downloaduri si PREMIERE exclusive.</p>
          </div>
        </div>
        </div>
     
      <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
        <a href="https://www.youtube.com/clickmusicromania" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
          <svg class="flex-none w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm6.39-2.908a.75.75 0 01.766.027l3.5 2.25a.75.75 0 010 1.262l-3.5 2.25A.75.75 0 018 12.25v-4.5a.75.75 0 01.39-.658z" clip-rule="evenodd" />
          </svg>
          Youtube
        </a>
        <a href="/contact" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
          <svg class="flex-none w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
          </svg>
          Contact
        </a>
                </div>
            </div>
        </div>
    </div>
</header>