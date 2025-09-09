<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ __('Forgot your password?') }}</h1>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Enter your email and we will send you a reset link.') }}</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="mt-6 space-y-5">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">{{ __('Back to login') }}</a>
            <x-primary-button>
                {{ __('Send reset link') }}
            </x-primary-button>
        </div>
    </form>
</div>
