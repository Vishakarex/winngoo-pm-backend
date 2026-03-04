  <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-40 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="https://winngoocrm.com/user-uploads/app-logo/bae4a0709276cc863aee3d0f9598400a.png" class="w-100" alt="">
                </div>
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <button onclick="openCommandPalette()" class="w-full flex items-center justify-between px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 text-sm">
                        <span><i class="fa-solid fa-magnifying-glass mr-2"></i>Quick search...</span>
                        <span class="kbd">⌘K</span>
                    </button>
                </div>
                <div class="flex items-center gap-1">
                    {{-- <button onclick="lockVault()" class="p-2 text-gray-500 hover:text-black dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg" title="Lock">
                        <i class="fa-solid fa-lock"></i>
                    </button> --}}
                    <button id="theme-toggle" onclick="toggleDarkMode()" class="p-2 text-gray-500 hover:text-black dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg" title="Dark Mode">
                        <i class="fa-solid fa-moon dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:inline"></i>
                    </button>
                    <button onclick="toggleActivityLog()" class="hidden p-2 text-gray-500 hover:text-black dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg" title="Activity">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </button>
                    <div class="relative">
                        <button onclick="toggleUserMenu()" class="flex items-center gap-2 p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                {{-- <span class="text-sm font-medium text-gray-600 dark:text-gray-300">JD</span> --}}
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
    {{ collect(explode(' ', Auth::guard('admin')->user()->name ?? ''))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('') }}
</span>

                            
                            </div>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-500 hidden sm:inline"></i>
                        </button>
                        <div id="userMenu" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl elegant-shadow border border-gray-100 dark:border-gray-700 hidden slide-down">
                            <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                                {{-- <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="font-medium text-gray-900 dark:text-white">John Doe</p>
                                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-sm text-gray-500">admin@winngoo.com</p> --}}
                            
                            
                            <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="font-medium text-gray-900 dark:text-white">
    {{ Auth::guard('admin')->user()->name ?? '' }}
</p>
<p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-sm text-gray-500">
    {{ Auth::guard('admin')->user()->email ?? '' }}
</p>
                            
                            
                            
                            
                            </div>
                            <div class="p-2">
                                <a href="#" onclick="openSettings()" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                    <i class="fa-solid fa-gear w-4"></i><span>Settings</span>
                                </a>
                                <a href="#" onclick="openShortcutsModal()" class="hidden flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                    <i class="fa-solid fa-keyboard w-4"></i><span>Shortcuts</span>
                                </a>
                            </div>
                            <div class="p-2 border-t border-gray-100 dark:border-gray-700">
                                {{-- <a href="#" onclick="lockVault()" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">
                                    <i class="fa-solid fa-right-from-bracket w-4"></i><span>Sign Out</span>
                                </a> --}}
<form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit"
        class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span>Sign Out</span>
    </button>
</form>              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>