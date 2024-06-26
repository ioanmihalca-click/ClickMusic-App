<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

  <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
  @auth  @if (auth()->user()->subscribed('prod_QGao8eve2XHvzf'))
      <p class="mb-2 text-gray-600">Ai un abonament activ. <br> Pentru intrebari sau nelamuriri: contact@clickmusic.ro</p>
    @endif
  @endauth
  
<div class="my-4">
  Intra la <a href='/abonament' class="px-2 text-white bg-blue-500 rounded hover:bg-blue-600"> Abonament </a>
</div>

  <form action="{{ route('subscription.cancel') }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 font-bold text-white bg-red-600 rounded hover:bg-red-500">
      Anulează Abonamentul
    </button>
  </form>
</div>


            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>

        

          
        </div>
    </div>
</x-app-layout>
