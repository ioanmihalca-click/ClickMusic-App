<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Magazin') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <div class="p-6 text-center text-gray-900">
          {{ __('Sustine artistul prin achizitionarea albumelor digitale sau a articolelor vestimentare:') }}
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div class="flex items-center justify-center">
            <iframe style="border: 0; width: 350px; height: 470px;"
              src="https://bandcamp.com/EmbeddedPlayer/album=2761382938/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless>
              <a href="https://clickmusic.bandcamp.com/album/trup-si-suflet-lp">Cumpara Trup si Suflet LP by Click</a>
            </iframe>
            
           
          </div>
          <div class="flex items-center justify-center">
            <iframe style="border: 0; width: 350px; height: 470px;"
              src="https://bandcamp.com/EmbeddedPlayer/album=1697538526/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless>
              <a href="https://clickmusic.bandcamp.com/album/lume-draga">Lume draga by Click Music Romania</a>
            </iframe>
          </div>

          <div class="flex items-center justify-center">
            <iframe style="border: 0; width: 350px; height: 470px;"
              src="https://bandcamp.com/EmbeddedPlayer/album=3660710337/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless>
              <a href="https://clickmusic.bandcamp.com/album/culori-ep">Culori EP by Click Music Romania</a>
            </iframe>
          </div>
          <div class="flex items-center justify-center">
            <iframe style="border: 0; width: 350px; height: 470px;"
              src="https://bandcamp.com/EmbeddedPlayer/album=2872148168/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless>
              <a href="https://clickmusic.bandcamp.com/album/dulce-si-amar-ep">Dulce si amar EP by Click Music Romania</a>
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
