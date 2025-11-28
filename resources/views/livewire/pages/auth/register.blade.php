<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('abonament', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="space-y-6">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input wire:model="name" 
                         id="name" 
                         class="block w-full mt-1 text-white border-white/10 rounded-lg bg-black/30 backdrop-blur-sm focus:border-blue-500/50 focus:ring-blue-500/30"
                         type="text" 
                         name="name" 
                         required 
                         autofocus 
                         autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input wire:model="email" 
                         id="email" 
                         class="block w-full mt-1 text-white border-white/10 rounded-lg bg-black/30 backdrop-blur-sm focus:border-blue-500/50 focus:ring-blue-500/30"
                         type="email" 
                         name="email" 
                         required 
                         autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input wire:model="password" 
                         id="password" 
                         class="block w-full mt-1 text-white border-white/10 rounded-lg bg-black/30 backdrop-blur-sm focus:border-blue-500/50 focus:ring-blue-500/30"
                         type="password"
                         name="password"
                         required 
                         autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
            <x-text-input wire:model="password_confirmation" 
                         id="password_confirmation" 
                         class="block w-full mt-1 text-white border-white/10 rounded-lg bg-black/30 backdrop-blur-sm focus:border-blue-500/50 focus:ring-blue-500/30"
                         type="password"
                         name="password_confirmation" 
                         required 
                         autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <a class="text-sm text-blue-400 transition-colors duration-300 rounded-md hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800" 
               href="{{ route('login') }}" 
               wire:navigate>
                {{ __('Intră în cont') }}
            </a>

            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 text-gray-500 bg-transparent">sau</span>
            </div>
        </div>

        <!-- Google Login -->
        <div>
            <a href="{{ route('login.google') }}" 
               class="flex items-center justify-center w-full px-6 py-3 text-white transition-all duration-300 border border-white/10 rounded-lg bg-black/30 backdrop-blur-sm hover:bg-white/5 group">
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