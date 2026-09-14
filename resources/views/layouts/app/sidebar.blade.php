<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('cafes.index') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('')" class="grid">
                    <flux:sidebar.item icon="chart-bar" :href="route('dashboard-cafe')" :current="request()->routeIs('dashboard-cafe')" wire:navigate>
                        {{ __('ダッシュボード') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="pencil-square" :href="route('cafes.index')" :current="request()->routeIs('cafes.index')" wire:navigate>
                        {{ __('カフェ一覧') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="pencil-square" :href="route('cafes.create')" :current="request()->routeIs('cafes.create')" wire:navigate>
                        {{ __('カフェ追加') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="pencil-square" :href="route('study-logs.index')" :current="request()->routeIs('study-logs.index')" wire:navigate>
                        {{ __('勉強記録一覧') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="pencil-square" :href="route('study-logs.create')" :current="request()->routeIs('study-logs.create')" wire:navigate>
                        {{ __('勉強記録追加') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @fluxScripts
    </body>
</html>
