<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
   public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $user = auth()->user();

        if ($user->subscribed()) {
            $this->redirect(route('videoclipuri'));
        } else {
            $this->redirect(route('abonament'));
        }
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input wire:model="form.email" 
                         id="email" 
                         class="block w-full mt-1 text-white border-gray-600 rounded-lg bg-gray-700/50 focus:border-blue-500 focus:ring-blue-500" 
                         type="email" 
                         name="email" 
                         required 
                         autofocus 
                         autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input wire:model="form.password" 
                         id="password" 
                         class="block w-full mt-1 text-white border-gray-600 rounded-lg bg-gray-700/50 focus:border-blue-500 focus:ring-blue-500"
                         type="password"
                         name="password"
                         required 
                         autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" 
                       id="remember" 
                       type="checkbox" 
                       class="text-blue-500 border-gray-600 rounded bg-gray-700/50 focus:ring-blue-500 focus:ring-offset-gray-800"
                       name="remember">
                <span class="text-sm text-gray-300 ms-2">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-400 transition-colors duration-300 rounded-md hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800" 
                   href="{{ route('password.request') }}" 
                   wire:navigate>
                    {{ __('Ai uitat parola?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="justify-center w-full py-3 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 text-gray-400 bg-gray-800/50">sau</span>
            </div>
        </div>

        <!-- Google Login -->
        <div>
            <a href="{{ route('login.google') }}" 
               class="flex items-center justify-center w-full px-6 py-3 text-white transition-all duration-300 border border-gray-600 rounded-lg bg-gray-700/50 hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     width="20" 
                     height="20" 
                     fill="currentColor"
                     class="mr-3 text-gray-300 transition-colors duration-300 group-hover:text-white">
                    <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                </svg>
                <span class="text-sm font-medium text-gray-300 transition-colors duration-300 group-hover:text-white">
                    Sign in with Google
                </span>
            </a>
        </div>
    </form>
</div>