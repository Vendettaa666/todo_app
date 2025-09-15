@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Pengaturan Profil
            </h1>
        </div>

        <div class="space-y-6">
            {{-- Bagian Informasi Profil --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 md:p-8">
                <div class="max-w-2xl mx-auto">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            {{-- Bagian Update Password --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 md:p-8">
                <div class="max-w-2xl mx-auto">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            {{-- Bagian Hapus Akun --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 md:p-8">
                <div class="max-w-2xl mx-auto">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
@endsection
