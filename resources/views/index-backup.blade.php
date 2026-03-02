<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winngoo Management Pro</title>
    <link rel="icon" type="image/png" href="https://vishakarex.in/assets/img/vishaka-fav.webp">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { primary: '#000000', secondary: '#374151', accent: '#6b7280' } } }
        }
    </script>
    <style>
        * { font-family: 'Inter', system-ui, sans-serif; }
        body { transition: background-color 0.3s, color 0.3s; }
         body {visibility: hidden;}
        body.app-ready {visibility: visible;}
        .elegant-shadow { box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05); }
        .modal-shadow { box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .dark .elegant-shadow { box-shadow: 0 1px 3px rgba(0,0,0,0.3), 0 4px 12px rgba(0,0,0,0.2); }
        .fade-in { animation: fadeIn 0.2s ease-out; }
        .slide-down { animation: slideDown 0.2s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #000; box-shadow: 0 0 0 3px rgba(0,0,0,0.1); }
        .dark input:focus, .dark select:focus, .dark textarea:focus { border-color: #fff; box-shadow: 0 0 0 3px rgba(255,255,255,0.1); }
        .btn-primary { background: #000; color: #fff; transition: all 0.2s; }
        .btn-primary:hover { background: #1f2937; transform: translateY(-1px); }
        .dark .btn-primary { background: #fff; color: #000; }
        .dark .btn-primary:hover { background: #e5e7eb; }
        .btn-secondary { background: #fff; color: #000; border: 1px solid #e5e7eb; transition: all 0.2s; }
        .btn-secondary:hover { background: #f9fafb; border-color: #d1d5db; }
        .dark .btn-secondary { background: #374151; color: #fff; border-color: #4b5563; }
        .dark .btn-secondary:hover { background: #4b5563; }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .status-live { background: #22c55e; }
        .status-dev { background: #f59e0b; }
        .status-inactive { background: #9ca3af; }
        .tag { font-size: 11px; padding: 2px 8px; border-radius: 9999px; font-weight: 500; cursor: pointer; }
        .credential-badge { font-size: 10px; padding: 2px 8px; border-radius: 4px; font-weight: 600; text-transform: uppercase; }
        .kbd { display: inline-flex; align-items: center; padding: 2px 6px; font-size: 11px; background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 4px; color: #6b7280; }
        .dark .kbd { background: #374151; border-color: #4b5563; color: #9ca3af; }
        .favorite-star { cursor: pointer; transition: all 0.2s; }
        .favorite-star:hover { transform: scale(1.2); }
        .favorite-star.active { color: #fbbf24; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        .dark ::-webkit-scrollbar-track { background: #1f2937; }
        .dark ::-webkit-scrollbar-thumb { background: #4b5563; }
        .favicon-img { width: 36px; height: 36px; border-radius: 8px; object-fit: contain; background: #f3f4f6; padding: 4px; }
        .dark .favicon-img { background: #374151; }
        @media print { .no-print { display: none !important; } }
        ::view-transition-old(root),
        ::view-transition-new(root) {animation: none;mix-blend-mode: normal;}
        ::view-transition-old(root) {z-index: 1;}
        ::view-transition-new(root) {z-index: 9999;}
        .text-animate-segment {display: inline-block;white-space: pre;opacity: 0;}
        .text-animate-segment.line-segment {display: block;white-space: pre-wrap;}
        .text-animate-segment.animated {animation-fill-mode: forwards;}
        @keyframes ta-fadeIn {
        from {opacity: 0;transform: translateY(20px);} to {opacity: 1;transform: translateY(0);}}
        @keyframes ta-fadeIn-exit {
        from {opacity: 1;transform: translateY(0);} to {opacity: 0;transform: translateY(20px);}}
        @keyframes ta-blurIn {
        from {opacity: 0;filter: blur(10px);} to {opacity: 1;filter: blur(0px);}}
        @keyframes ta-blurInUp {
        from {opacity: 0;filter: blur(10px);transform: translateY(20px);} to {opacity: 1;filter: blur(0px);transform: translateY(0);}}
        @keyframes ta-blurInDown {
        from {opacity: 0;filter: blur(10px);transform: translateY(-20px);} to {opacity: 1;filter: blur(0px);transform: translateY(0);}}
        @keyframes ta-slideUp {
        from {opacity: 0;transform: translateY(20px);} to {opacity: 1;transform: translateY(0);}}
        @keyframes ta-slideDown {
        from {opacity: 0;transform: translateY(-20px);} to {opacity: 1;transform: translateY(0);}}
        @keyframes ta-slideLeft {
        from {opacity: 0;transform: translateX(20px);} to {opacity: 1;transform: translateX(0);}}
        @keyframes ta-slideRight {
        from {opacity: 0;transform: translateX(-20px);} to {opacity: 1;transform: translateX(0);}}
        @keyframes ta-scaleUp {
        0% {opacity: 0;transform: scale(0.5);} 60% {opacity: 1;transform: scale(1.05);} 80% {transform: scale(0.98);} 100% {opacity: 1;transform: scale(1);}}
        @keyframes ta-scaleDown {
        0% {opacity: 0;transform: scale(1.5);} 60% {opacity: 1;transform: scale(0.95);} 80% {transform: scale(1.02);} 100% {opacity: 1;transform: scale(1);}}
        .aurora-text-wrapper {position: relative;display: inline-block;}
        .aurora-text {position: relative;display: inline-block;background-clip: text;-webkit-background-clip: text;color: transparent;-webkit-text-fill-color: transparent;background-size: 200% auto;animation: aurora-shift 10s linear infinite;}
        @keyframes aurora-shift {
        0% {background-position: 0% center;} 50% {background-position: 100% center;} 100% {background-position: 0% center;}}
        .marquee-wrapper {overflow: hidden;position: relative;transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, padding 0.4s ease, margin 0.4s ease;max-height: 120px;opacity: 1;}
        .marquee-wrapper.collapsed {max-height: 0;opacity: 0;padding-top: 0 !important;padding-bottom: 0 !important;margin-bottom: 0 !important;}
        .marquee-wrapper::before,
        .marquee-wrapper::after {content: '';position: absolute;top: 0;bottom: 0;width: 60px;z-index: 2;pointer-events: none;}
        .marquee-wrapper::before {left: 0;background: linear-gradient(to right, rgb(243 244 246) 0%, transparent 100%);}
        .marquee-wrapper::after {right: 0;background: linear-gradient(to left, rgb(243 244 246) 0%, transparent 100%);}
        .dark .marquee-wrapper::before {background: linear-gradient(to right, rgb(17 24 39) 0%, transparent 100%);}
        .dark .marquee-wrapper::after {background: linear-gradient(to left, rgb(17 24 39) 0%, transparent 100%);}
        .marquee-track {display: flex;width: max-content;animation: marquee-scroll 35s linear infinite;}
        .marquee-track:hover {animation-play-state: paused;}
        @keyframes marquee-scroll {0% { transform: translateX(0); }100% { transform: translateX(-50%); }}
        .marquee-item {display: flex;align-items: center;gap: 5px;padding: 10px 5px;margin: 0 8px;border-radius: 12px;white-space: nowrap;transition: all 0.25s ease;cursor: default;flex-shrink: 0;}
        .marquee-item:hover {transform: translateY(-2px);box-shadow: 0 4px 16px rgba(0,0,0,0.08);border-color: #d1d5db;}
        .dark .marquee-item {background: #1f2937;border-color: #374151;}
        .dark .marquee-item:hover {box-shadow: 0 4px 16px rgba(0,0,0,0.3);border-color: #4b5563;}
        .marquee-item-icon {width: 100%;height: 100%;border-radius: 10px;display: flex;align-items: center;justify-content: center;flex-shrink: 0;}
        .marquee-item-icon img {width: 100%;height: 36px;object-fit: contain;}
        .marquee-item-icon i {font-size: 16px;}
        .marquee-toggle-btn {transition: all 0.2s ease;}
        .marquee-toggle-btn:hover {background-color: #f3f4f6;}
        .dark .marquee-toggle-btn:hover {background-color: #374151;}
        .marquee-toggle-btn .toggle-icon {transition: transform 0.3s ease;}
        .marquee-toggle-btn.collapsed .toggle-icon {transform: rotate(180deg);}

        /* ===== NEW: View Toggle & Card Grid Styles ===== */
        .view-toggle-group { display: inline-flex; align-items: center; background: #f3f4f6; border-radius: 8px; padding: 2px; gap: 2px; }
        .dark .view-toggle-group { background: #374151; }
        .view-toggle-btn { padding: 5px 10px; border-radius: 6px; font-size: 13px; color: #9ca3af; cursor: pointer; transition: all 0.2s; border: none; background: transparent; display: inline-flex; align-items: center; gap: 5px; }
        .view-toggle-btn:hover { color: #374151; }
        .dark .view-toggle-btn:hover { color: #d1d5db; }
        .view-toggle-btn.active { background: #fff; color: #111827; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .dark .view-toggle-btn.active { background: #1f2937; color: #f9fafb; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
        .country-tab { display: inline-flex; align-items: center; gap: 5px; padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; border: 1px solid #e5e7eb; color: #6b7280; cursor: pointer; transition: all 0.2s; background: #fff; white-space: nowrap; }
        .country-tab:hover { border-color: #d1d5db; color: #111827; background: #f9fafb; }
        .country-tab.active { background: #111827; color: #fff; border-color: #111827; }
        .dark .country-tab { background: #1f2937; border-color: #374151; color: #9ca3af; }
        .dark .country-tab:hover { border-color: #4b5563; color: #e5e7eb; background: #374151; }
        .dark .country-tab.active { background: #f9fafb; color: #111827; border-color: #f9fafb; }
        .project-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 20px; transition: all 0.25s ease; cursor: default; position: relative; cursor; pointer;}
        .project-card:hover { border-color: #d1d5db; box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-3px); cursor; pointer;}
        .dark .project-card { background: #1f2937; border-color: #374151; }
        .dark .project-card:hover { border-color: #4b5563; box-shadow: 0 8px 24px rgba(0,0,0,0.25); }
        .project-card .card-urls { display: flex; gap: 6px; flex-wrap: wrap; }
        .project-card .card-url-chip { display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; background: #f3f4f6; color: #6b7280; text-decoration: none; transition: all 0.15s; }
        .project-card .card-url-chip:hover { background: #e5e7eb; color: #111827; }
        .dark .project-card .card-url-chip { background: #374151; color: #9ca3af; }
        .dark .project-card .card-url-chip:hover { background: #4b5563; color: #e5e7eb; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        @keyframes cardFadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .project-card { animation: cardFadeIn 0.3s ease-out both; }
        .project-card:nth-child(1) { animation-delay: 0s; }
        .project-card:nth-child(2) { animation-delay: 0.04s; }
        .project-card:nth-child(3) { animation-delay: 0.08s; }
        .project-card:nth-child(4) { animation-delay: 0.12s; }
        .project-card:nth-child(5) { animation-delay: 0.16s; }
        .project-card:nth-child(6) { animation-delay: 0.2s; }
        .project-card:nth-child(7) { animation-delay: 0.24s; }
        .project-card:nth-child(8) { animation-delay: 0.28s; }
        .project-card:nth-child(9) { animation-delay: 0.32s; }
        /* ===== END NEW ===== */

        @keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%      { transform: translateX(-6px); }
    40%      { transform: translateX(6px); }
    60%      { transform: translateX(-4px); }
    80%      { transform: translateX(4px); }
}
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen transition-colors">

    <!-- Command Palette (Quick Search) -->
    <div id="commandPalette" class="fixed inset-0 z-[100] hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeCommandPalette()"></div>
        <div class="fixed inset-x-4 top-[20%] md:inset-x-auto md:left-1/2 md:-translate-x-1/2 md:w-full md:max-w-xl">
            <div class="bg-white dark:bg-gray-800 rounded-2xl modal-shadow overflow-hidden fade-in">
                <div class="p-2 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    <input type="text" id="commandInput" placeholder="Search projects or type '>' for commands..." 
                           class="flex-1 bg-transparent border-none outline-none p-3 rounded-2xl text-gray-900 dark:text-white" oninput="handleCommandInput(this.value)">
                    <span class="kbd">ESC</span>
                </div>
                <div id="commandResults" class="max-h-80 overflow-y-auto p-2"></div>
            </div>
        </div>
    </div>


    <!-- Header -->
@include('layouts.header')

    <!-- Activity Log Panel -->
    <div id="activityPanel" class="fixed right-4 top-20 w-80 bg-white dark:bg-gray-800 rounded-xl elegant-shadow border border-gray-100 dark:border-gray-700 hidden z-50 slide-down no-print">
        <div class="p-2 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 data-text-animate="blurInUp" data-animate-by="word" class="font-semibold text-gray-900 dark:text-white">Activity Log</h3>
            <button onclick="activityLog=[];renderActivityLog()" class="text-xs text-gray-500 hover:text-gray-700">Clear</button>
        </div>
        <div id="activityList" class="max-h-80 overflow-y-auto p-2"></div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Page Header with Actions -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-2 mb-4">
            <div>
                <h2 data-text-animate="blurInUp" data-animate-by="word" class="text-2xl font-bold text-black dark:text-white">Projects & Credentials</h2>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-gray-500 dark:text-gray-400 text-sm mt-1">Manage your Winngoo products and access credentials</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 no-print">
                <button onclick="window.print()" class="hidden btn-secondary px-3 py-2 rounded-lg text-sm font-medium">
                    <i class="fa-solid fa-print mr-1"></i>Print
                </button>
                <button onclick="exportData()" class="btn-secondary px-3 py-2 rounded-lg text-sm font-medium">
                    <i class="fa-solid fa-download mr-1"></i>Export
                </button>
                <button onclick="openImportModal()" class="hidden btn-secondary px-3 py-2 rounded-lg text-sm font-medium">
                    <i class="fa-solid fa-upload mr-1"></i>Import
                </button>
                <button onclick="openAddProjectModal()" class="btn-primary px-4 py-2 rounded-lg text-sm font-medium">
                    <i class="fa-solid fa-plus mr-1"></i>Add Project
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 md:gap-2 mb-4">
            <div class="bg-white dark:bg-gray-900 py-2 px-3 rounded-xl flex items-center gap-2.5 w-full border border-gray-200 dark:border-gray-800 shadow-sm">
                <i class="fa-solid fa-folder text-[10px] text-gray-500 dark:text-gray-400"></i>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-lg md:text-xl font-medium text-gray-900 dark:text-white" id="stat-total">0</p>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-[10px] md:text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-widest ml-auto">Projects</p>
            </div>
            <div class="bg-white dark:bg-gray-900 py-2 px-3 rounded-xl flex items-center gap-2.5 w-full border border-emerald-200 dark:border-emerald-800 shadow-sm">
                <i class="fa-solid fa-circle-check text-[10px] text-emerald-600"></i>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-lg md:text-xl font-medium text-emerald-700 dark:text-emerald-400" id="stat-live">0</p>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-[10px] md:text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-widest ml-auto">Live</p>
            </div>
            <div class="bg-white dark:bg-gray-900 py-2 px-3 rounded-xl flex items-center gap-2.5 w-full border border-amber-200 dark:border-amber-800 shadow-sm">
                <i class="fa-solid fa-code text-[10px] text-amber-600"></i>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-lg md:text-xl font-medium text-amber-700 dark:text-amber-400" id="stat-dev">0</p>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-[10px] md:text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-widest ml-auto">Dev</p>
            </div>
            <div class="bg-white dark:bg-gray-900 py-2 px-3 rounded-xl flex items-center gap-2.5 w-full border border-violet-200 dark:border-violet-800 shadow-sm">
                <i class="fa-solid fa-key text-[10px] text-violet-600"></i>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-lg md:text-xl font-medium text-violet-700 dark:text-violet-400" id="stat-creds">0</p>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-[10px] md:text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-widest ml-auto">Keys</p>
            </div>
        </div>

        <!-- ===== PRODUCT SHOWCASE MARQUEE ===== -->
        <div class="mb-4 no-print">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400 dark:text-gray-500">Our Products</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 pulse-dot"></span>
                </div>
                <button id="marqueeToggleBtn" onclick="toggleMarquee()" class="marquee-toggle-btn p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 flex items-center gap-1.5 text-xs" title="Toggle showcase">
                    <span class="hidden sm:inline text-gray-400">Hide</span>
                    <i class="fa-solid fa-chevron-up toggle-icon text-[10px]"></i>
                </button>
            </div>
            <div id="marqueeWrapper" class="marquee-wrapper rounded-xl">
                <div class="marquee-track">
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://vishakarex.in/assets/img/vishaka.png" alt="Winngoo Analytics" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngooinfini.com/in/img/infini-logo.png" alt="Winngoo CRM" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoolink.in/img/logo.png" alt="Winngoo Commerce" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoopages.my/assets/image/index/winngoo-logo-blue.png" alt="Winngoo API" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://vishakarex.in/assets/img/projects/giftcard.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoofame.in/frontend/images/logo-dark.png" alt="Winngoo Analytics" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoopagesbusiness.in/assets/image/index/logo2.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngooconsultancy.in/assets/images/Winngoo-consultancy-Logo.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoomatrimony.com/storage/siteConfig/1754743807.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://vishakarex.in/assets/img/vishaka.png" alt="Winngoo Analytics" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngooinfini.com/in/img/infini-logo.png" alt="Winngoo CRM" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoolink.in/img/logo.png" alt="Winngoo Commerce" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoopages.my/assets/image/index/winngoo-logo-blue.png" alt="Winngoo API" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://vishakarex.in/assets/img/projects/giftcard.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoofame.in/frontend/images/logo-dark.png" alt="Winngoo Analytics" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoopagesbusiness.in/assets/image/index/logo2.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngooconsultancy.in/assets/images/Winngoo-consultancy-Logo.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                    <div class="marquee-item"><div class="marquee-item-icon rounded-xl overflow-hidden"><img src="https://winngoomatrimony.com/storage/siteConfig/1754743807.png" alt="Winngoo Cloud" class="w-full h-full object-cover"></div></div>
                </div>
            </div>
        </div>

        <!-- Filters Row -->
        <div class="flex flex-wrap justify-between gap-2 mb-4 no-print">
            <button onclick="toggleFilter('favorites')" id="favFilterBtn" class="hidden px-3 py-1.5 rounded-lg text-sm border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:text-gray-100 hover:bg-gray-800 dark:hover:bg-gray-700">
                <i class="fa-solid fa-star mr-1"></i>Favorites
            </button>
            <button onclick="toggleFilter('archived')" id="archiveFilterBtn" class="hidden px-3 py-1.5 rounded-lg text-sm border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:text-gray-100 hover:bg-gray-800 dark:hover:bg-gray-700">
                <i class="fa-solid fa-box-archive mr-1"></i>Archived
            </button>
            <div class="hidden h-6 w-px bg-gray-200 dark:bg-gray-600"></div>

            <!-- Country Filter Tabs for Cards -->
            <div id="countryTabs" class="hidden w-1/3 overflow-scroll flex flex-nowrap overflow-y-hidden no-scrollbar items-center gap-2"></div>

            <div id="tagFilters" class="hidden flex w-[34.5%] flex-nowrap overflow-x-auto overflow-y-hidden whitespace-nowrap [&::-webkit-scrollbar]:hidden"></div>

            <!-- NEW: View Toggle Tabs -->
            <div class="w-100 overflow-scroll flex flex-nowrap overflow-y-hidden no-scrollbar items-center gap-2">
                <button onclick="switchView('grid')" id="viewGridBtn" class="view-toggle-btn active" title="Grid View">
                    <i class="fa-solid fa-grip text-xs"></i><span class="hidden sm:inline text-xs">Cards</span>
                </button>
                <button onclick="switchView('list')" id="viewListBtn" class="view-toggle-btn" title="List View">
                    <i class="fa-solid fa-list text-xs"></i><span class="hidden sm:inline text-xs">List</span>
                </button>
            </div>
            <!-- END NEW -->

            <!-- Search & Filter Toolbar -->
            <div class="w-100 place-self-end dark:bg-gray-800 rounded-xl no-print">
                <div class="flex flex-col lg:flex-row gap-3">
                    <div class=" flex-1 relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" oninput="renderProjects()" placeholder="Search projects, URLs, credentials..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <select id="filterStatus" onchange="renderProjects()" class="hidden px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">All Status</option>
                            <option value="live">Live</option>
                            <option value="development">Development</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <select id="filterCategory" onchange="renderProjects()" class="hidden px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">All Categories</option>
                            <option value="E-Commerce">E-Commerce</option>
                            <option value="CRM">CRM</option>
                            <option value="Analytics">Analytics</option>
                            <option value="API">API</option>
                            <option value="Website">Website</option>
                        </select>
                        <select id="filterCountry" onchange="renderProjects()" class="px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Country</option>
                            <option value="IN">🇮🇳 India</option>
                            <option value="UK">🇬🇧 United Kingdom</option>
                            <option value="MY">🇲🇾 Malaysia</option>
                            <option value="LK">🇱🇰 Sri Lanka</option>
                        </select>
                        <select id="sortBy" onchange="renderProjects()" class="hidden px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="name-asc">Name (A-Z)</option>
                            <option value="name-desc">Name (Z-A)</option>
                            <option value="date-desc">Newest First</option>
                            <option value="date-asc">Oldest First</option>
                            <option value="favorites">Favorites First</option>
                        </select>
                    </div>
                </div>
        
            </div>
        </div>

        <!-- Projects Table (List View) -->
        <div id="projectTableContainer" class="hidden bg-white dark:bg-gray-800 rounded-xl elegant-shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between no-print">
                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="w-4 h-4 rounded">
                    <span>Select All</span>
                </label>
                 <!-- Bulk Actions -->
                <div id="bulkActions" class="hidden  dark:border-gray-700 flex flex-wrap items-center justify-between gap-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400"><span id="selectedCount">0</span> selected</span>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="bulkArchive()" class="btn-secondary px-3 py-1 rounded text-xs">Archive</button>
                        <button onclick="bulkExport()" class="btn-secondary px-3 py-1 rounded text-xs">Export</button>
                        <button onclick="bulkDelete()" class="px-3 py-1 rounded text-xs bg-red-50 dark:bg-red-900/20 text-red-600">Delete</button>
                        <button onclick="clearSelection()" class="btn-secondary px-3 py-1 rounded text-xs">Clear</button>
                    </div>
                </div>
                <span class="text-sm text-gray-500"><span id="projectCount">0</span> projects</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="projectsTable">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="w-10 py-2 px-4"></th>
                            <th class="w-10 py-3 px-2"></th>
                            <th class="w-14 py-3 px-2 text-center font-semibold text-gray-600 dark:text-gray-400">SI.No</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600 dark:text-gray-400">Project</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600 dark:text-gray-400">Status</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600 dark:text-gray-400">Tags</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600 dark:text-gray-400">Updated</th>
                            <th class="text-right py-2 px-4 font-semibold text-gray-600 dark:text-gray-400 no-print">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="projectsBody"></tbody>
                </table>
            </div>
            <!-- Empty State -->
            <div id="emptyState" class="hidden py-12 text-center">
                <div class="w-14 h-14 bg-gray-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-folder-open text-xl text-gray-400"></i>
                </div>
                <h3 data-text-animate="blurInUp" data-animate-by="word" class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No projects found</h3>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-gray-500 dark:text-gray-400 mb-4">Get started by creating your first project</p>
                <button onclick="openAddProjectModal()" class="btn-primary px-4 py-2 rounded-lg text-sm">
                    <i class="fa-solid fa-plus mr-1"></i>Add Project
                </button>
            </div>
        </div>

        <!-- NEW: Card/Grid View Container -->
        <div id="projectCardsContainer" class="">
            <!-- Cards Grid -->
            <div id="projectCards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"></div>
            <!-- Empty State for Cards -->
            <div id="emptyStateCards" class="hidden py-16 text-center">
                <div class="w-14 h-14 bg-gray-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-folder-open text-xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No projects found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Try adjusting your filters or add a new project</p>
                <button onclick="openAddProjectModal()" class="btn-primary px-4 py-2 rounded-lg text-sm">
                    <i class="fa-solid fa-plus mr-1"></i>Add Project
                </button>
            </div>
        </div>
        <!-- END NEW -->

        <!-- Trash Section -->
        <div id="trashSection" class="hidden mt-6">
            <div class="flex items-center justify-between mb-3">
                <h3 data-text-animate="blurInUp" data-animate-by="word" class="font-semibold text-gray-900 dark:text-white"><i class="fa-solid fa-trash mr-2"></i>Trash</h3>
                <button onclick="emptyTrash()" class="text-sm text-red-600 hover:text-red-700">Empty Trash</button>
            </div>
            <div id="trashContainer" class="bg-white dark:bg-gray-800 rounded-xl elegant-shadow"></div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-700 py-4 mt-8 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-center gap-2 text-xs text-gray-500">
            <div class="flex items-center gap-3">
                <span>Copyright &copy; <span id="year"></span> Vishakarex | All rights reserved</span>
                <script>document.getElementById("year").textContent = new Date().getFullYear();</script>

                <button onclick="openShortcutsModal()" class="hidden hover:text-gray-900 dark:hover:text-white">Shortcuts</button>
            </div>
        </div>
    </footer>
   @foreach($project as $item)
    <img 
        src="{{ $item->logo_url ? $item->logo_url : $item->website_url . '/favicon.ico' }}" 
        alt="Logo"
        width="100">
@endforeach

    <!-- PROJECT MODAL (Add/Edit) -->
    <div id="projectModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('projectModal')"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl modal-shadow fade-in" onclick="event.stopPropagation()">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 data-text-animate="blurInUp" data-animate-by="word" id="projectModalTitle" class="text-lg font-bold text-black dark:text-white">Add New Project</h3>
                        <button onclick="closeModal('projectModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center">
                            <i class="fa-solid fa-xmark text-gray-500"></i>
                        </button>
                    </div>

                    {{-- <form id="projectForm" onsubmit="saveProject(event)" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                        <input type="hidden" id="projectId">
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-folder mr-2"></i>Project Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-2">
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project Name *</label><input type="text" id="projectName" required placeholder="e.g., Winngoo E-Commerce" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div class="hidden"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category *</label><select id="projectCategory" required class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="">Select category</option><option value="E-Commerce">E-Commerce</option><option value="CRM">CRM</option><option value="Analytics">Analytics</option><option value="API">API</option><option value="Website">Website</option></select></div>
                            </div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label><textarea id="projectDescription" rows="2" placeholder="Brief description..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo URL</label><input type="url" id="projectLogoUrl" placeholder="https://example.com/logo.png" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-xs text-gray-500 mt-1">Leave empty to auto-fetch favicon from website URL</p></div>
                        </div>
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-location-dot mr-2"></i>Address Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label><select id="projectCountry" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="">Select country</option>
                                    <option value="IN">🇮🇳 India</option>
                                    <option value="UK">🇬🇧 United Kingdom</option>
                                    <option value="MY">🇲🇾 Malaysia</option>
                                    <option value="LK">🇱🇰 Sri Lanka</option>
                                    <option value="OTHER">Other</option>
                                </select></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label><input type="tel" id="projectPhone" placeholder="Enter the phone number" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            </div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company/Organization Name</label><input type="text" id="projectCompanyName" placeholder="e.g., Winngoo Technologies Pvt Ltd" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label><textarea id="projectAddress" rows="2" placeholder="Enter the address" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                        </div>
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-link mr-2"></i>Project URLs</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="hidden"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Website Dev URL</label><input type="url" id="projectDevUrl" placeholder="https://dev.example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Website Live URL</label><input type="url" id="projectLiveUrl" placeholder="https://www.example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Android URL</label><input type="url" id="mobLiveUrl" placeholder="https://play.google.com/..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">iOS URL</label><input type="url" id="iosLiveUrl" placeholder="https://apps.apple.com/..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            </div>
                        </div>
                        <div>
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-gear mr-2"></i>Settings</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="hidden"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label><select id="projectStatus" required class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="development">Development</option><option value="live">Live</option><option value="inactive">Inactive</option></select></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon Letter</label><input type="text" id="projectIcon" maxlength="2" placeholder="W" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm uppercase bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Color</label><select id="projectColor" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="black">Black</option><option value="blue">Blue</option><option value="green">Green</option><option value="purple">Purple</option><option value="red">Red</option><option value="orange">Orange</option></select></div>
                            </div>
                            <div class="hidden mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tags (comma separated)</label><input type="text" id="projectTags" placeholder="priority, client-a" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label><textarea id="projectNotes" rows="2" placeholder="Additional notes..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                            <label class="flex items-center gap-2 cursor-pointer mt-4"><input type="checkbox" id="projectFavorite" class="w-4 h-4 rounded"><span class="text-sm text-gray-700 dark:text-gray-300">Mark as Favorite</span></label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <button type="button" onclick="closeModal('projectModal')" class="btn-secondary px-4 py-2 rounded-lg text-sm">Cancel</button>
                            <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm">Save Project</button>
                        </div>
                    </form> --}}





<form id="projectForm" action="{{ route('projects.store') }}" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
       {{-- <form id="projectForm" onsubmit="saveProject(event)" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
   @csrf --}}
        <input type="hidden" id="projectId">
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-folder mr-2"></i>Project Information</h4>
                            <div id="formSuccessMessage" class="hidden mb-4 p-3 rounded bg-green-100 text-green-700 text-sm"></div>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-2">
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project Name *</label><input type="text" id="projectName" name="project_name"  placeholder="e.g., Winngoo E-Commerce" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                
                                    @error('project_name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
                                </div>

                            </div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label><textarea id="projectDescription" name="description" rows="2" placeholder="Brief description..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo URL</label><input type="url" id="projectLogoUrl" name="logo_url" placeholder="https://example.com/logo.png" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-xs text-gray-500 mt-1">Leave empty to auto-fetch favicon from website URL</p></div>
                        </div>
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-location-dot mr-2"></i>Address Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label><select id="projectCountry" name="country" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="">Select country</option>
                                    <option value="IN">🇮🇳 India</option>
                                    <option value="UK">🇬🇧 United Kingdom</option>
                                    <option value="MY">🇲🇾 Malaysia</option>
                                    <option value="LK">🇱🇰 Sri Lanka</option>
                                    <option value="OTHER">Other</option>
                                </select></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label><input type="tel" id="projectPhone" name="phone_number" placeholder="Enter the phone number" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            </div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company/Organization Name</label><input type="text" id="projectCompanyName" name="company_name" placeholder="e.g., Winngoo Technologies Pvt Ltd" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label><textarea id="projectAddress" name="address" rows="2" placeholder="Enter the address" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                        </div>
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700">
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-link mr-2"></i>Project URLs</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="hidden"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Website Dev URL</label><input type="url" id="projectDevUrl" placeholder="https://dev.example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Website Live URL</label><input type="url" id="projectLiveUrl" name="website_url" placeholder="https://www.example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Android URL</label><input type="url" id="mobLiveUrl" name="android_url" placeholder="https://play.google.com/..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">iOS URL</label><input type="url" id="iosLiveUrl" name="ios_url" placeholder="https://apps.apple.com/..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            </div>
                        </div>
                        <div>
                            <h4 data-text-animate="blurInUp" data-animate-by="word" class="text-sm font-semibold text-gray-900 dark:text-white mb-3"><i class="fa-solid fa-gear mr-2"></i>Settings</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="hidden"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label><select id="projectStatus" required class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="development">Development</option><option value="live">Live</option><option value="inactive">Inactive</option></select></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon Letter</label><input type="text" id="projectIcon" maxlength="2" name="icon_letter"placeholder="W" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm uppercase bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Color</label><select id="projectColor" name="color" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="black">Black</option><option value="blue">Blue</option><option value="green">Green</option><option value="purple">Purple</option><option value="red">Red</option><option value="orange">Orange</option></select></div>
                            </div>
                            <div class="hidden mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tags (comma separated)</label><input type="text" id="projectTags" placeholder="priority, client-a" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                            <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label><textarea id="projectNotes"name="notes" rows="2" placeholder="Additional notes..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                            <label class="flex items-center gap-2 cursor-pointer mt-4"><input type="checkbox" id="projectFavorite" name="is_favorite" class="w-4 h-4 rounded"><span class="text-sm text-gray-700 dark:text-gray-300">Mark as Favorite</span></label>
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <button type="button" onclick="closeModal('projectModal')" class="btn-secondary px-4 py-2 rounded-lg text-sm">Cancel</button>
                            <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm">Save Project</button>
                        </div>
                    </form>







                    
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW PROJECT MODAL -->
    <div id="viewModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('viewModal')"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden modal-shadow fade-in" onclick="event.stopPropagation()">
                    <div class="sticky top-0 bg-white dark:bg-gray-800 px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between z-10">
                        <div class="flex items-center gap-3">
                            <div id="viewModalIcon" class="w-12 h-12 rounded-xl flex items-center justify-center overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img id="viewModalLogo" src="" alt="" class="w-full h-full object-contain" onerror="this.style.display='none';document.getElementById('viewModalFallback').style.display='flex';">
                                <div id="viewModalFallback" class="w-full h-full bg-black rounded-xl items-center justify-center text-white font-bold hidden"></div>
                            </div>
                            <div>
                                <h3 data-text-animate="blurInUp" data-animate-by="word" id="viewModalTitle" class="text-lg font-bold text-black dark:text-white"></h3>
                                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" id="viewModalSubtitle" class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                        <button onclick="closeModal('viewModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                    </div>
                    <div class="p-6 overflow-y-auto max-h-[calc(90vh-80px)]" id="viewModalContent"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- CREDENTIAL MODAL -->
    <div id="credentialModal" class="fixed inset-0 z-[60] hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('credentialModal')"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-lg modal-shadow fade-in" onclick="event.stopPropagation()">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 data-text-animate="blurInUp" data-animate-by="word" id="credentialModalTitle" class="text-lg font-bold text-black dark:text-white">Add Credential</h3>
                        <button onclick="closeModal('credentialModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                    </div>
                    <form id="credentialForm" onsubmit="saveCredential(event)" class="p-6 space-y-4">
                        <input type="hidden" id="credProjectId"><input type="hidden" id="credentialId">
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type *</label><select id="credentialType" required class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><option value="admin">Admin</option><option value="merchant">Merchant</option><option value="user">User</option><option value="mobile">Mobile</option><option value="api">API</option><option value="database">Database</option><option value="other">Other</option></select></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title *</label><input type="text" id="credentialTitle" required placeholder="e.g., Super Admin" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Login URL</label><input type="url" id="credentialUrl" placeholder="https://admin.example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email/Username *</label><input type="text" id="credentialEmail" required placeholder="admin@example.com" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password *</label><div class="relative"><input type="password" id="credentialPassword" required placeholder="••••••••" class="w-full px-3 py-2 pr-20 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><div class="absolute right-2 top-1/2 -translate-y-1/2 flex gap-1"><button type="button" onclick="toggleCredPassword()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-600 rounded"><i class="fa-solid fa-eye text-gray-500 text-sm"></i></button><button type="button" onclick="generatePassword()" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-600 rounded" title="Generate"><i class="fa-solid fa-rotate text-gray-500 text-sm"></i></button></div></div></div>
                        <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label><textarea id="credentialNotes" rows="2" placeholder="Additional notes..." class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea></div>
                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700"><button type="button" onclick="closeModal('credentialModal')" class="btn-secondary px-4 py-2 rounded-lg text-sm">Cancel</button><button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 z-[60] hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('deleteModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-2">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md modal-shadow fade-in p-6 text-center" onclick="event.stopPropagation()">
                <div class="w-14 h-14 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fa-solid fa-trash text-xl text-red-600"></i></div>
                <h3 data-text-animate="blurInUp" data-animate-by="word" id="deleteModalTitle" class="text-lg font-bold text-gray-900 dark:text-white mb-1">Delete?</h3>
                <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" id="deleteModalMessage" class="text-gray-500 text-sm mb-4"></p>
                <div class="flex gap-3"><button onclick="closeModal('deleteModal')" class="flex-1 btn-secondary px-4 py-2 rounded-lg text-sm">Cancel</button><button onclick="confirmDelete()" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">Delete</button></div>
            </div>
        </div>
    </div>

    <!-- IMPORT MODAL -->
    <div id="importModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('importModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-2">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-lg modal-shadow fade-in" onclick="event.stopPropagation()">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 data-text-animate="blurInUp" data-animate-by="word" class="text-lg font-bold text-black dark:text-white">Import Data</h3>
                    <button onclick="closeModal('importModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                </div>
                <div class="p-6">
                    <div class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-8 text-center hover:border-gray-400 cursor-pointer" onclick="document.getElementById('importFile').click()">
                        <input type="file" id="importFile" accept=".json" onchange="handleImport(event)" class="hidden">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-3"></i>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Click to upload</p>
                        <p class="text-xs text-gray-500 mt-1">JSON file only</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SETTINGS MODAL -->
    {{-- <div id="settingsModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('settingsModal')"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-lg modal-shadow fade-in" onclick="event.stopPropagation()">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 data-text-animate="blurInUp" data-animate-by="word" class="text-lg font-bold text-black dark:text-white">Settings</h3>
                        <button onclick="closeModal('settingsModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                    </div>
                    <div class="pb-6 ps-6 pe-6 space-y-6">
                        <div class="hidden"><h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Data Management</h4><div class="space-y-2"><button onclick="backupData()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-download mr-2"></i>Create Backup</span></button><button onclick="restoreBackup()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-upload mr-2"></i>Restore Backup</span></button><button onclick="viewTrash()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-trash mr-2"></i>View Trash</span></button><button onclick="if(confirm('Clear ALL data?'))clearAllData()" class="w-full px-4 py-2 rounded-lg text-sm text-left bg-red-50 dark:bg-red-900/20 text-red-600"><i class="fa-solid fa-triangle-exclamation mr-2"></i>Clear All Data</button></div></div>
                        <div><h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Change Master Password</h4><div class="space-y-2"><input type="password" id="currentPassword" placeholder="Current password" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><input type="password" id="newPassword" placeholder="New password" class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"><button onclick="changeMasterPassword()" class="btn-primary px-4 py-2 rounded-lg text-sm">Update Password</button></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div id="settingsModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('settingsModal')"></div>
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-lg modal-shadow fade-in" onclick="event.stopPropagation()">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 data-text-animate="blurInUp" data-animate-by="word" class="text-lg font-bold text-black dark:text-white">Settings</h3>
                        <button onclick="closeModal('settingsModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                    </div>
                    <div class="pb-6 ps-6 pe-6 space-y-6">
                        <div class="hidden"><h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Data Management</h4><div class="space-y-2"><button onclick="backupData()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-download mr-2"></i>Create Backup</span></button><button onclick="restoreBackup()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-upload mr-2"></i>Restore Backup</span></button><button onclick="viewTrash()" class="w-full btn-secondary px-4 py-2 rounded-lg text-sm text-left flex items-center justify-between"><span><i class="fa-solid fa-trash mr-2"></i>View Trash</span></button><button onclick="if(confirm('Clear ALL data?'))clearAllData()" class="w-full px-4 py-2 rounded-lg text-sm text-left bg-red-50 dark:bg-red-900/20 text-red-600"><i class="fa-solid fa-triangle-exclamation mr-2"></i>Clear All Data</button></div></div>
              

                
        <p id="passwordSuccess"
           class="hidden text-green-600 dark:text-green-400 text-xs mt-2 font-medium"></p>

<div>
    


    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
        Change Master Password
    </h4>

    <div class="space-y-2">

        {{-- <input type="password" id="currentPassword"
            placeholder="Current password"
            class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"> --}}
<div class="relative">
    <input type="password" id="currentPassword"
        placeholder="Current password"
        class="w-full px-3 py-2 pr-10 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">

    <button type="button"
        onclick="togglePasswordVisibility('currentPassword', this)"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
        <i class="fa-solid fa-eye text-sm"></i>
    </button>
</div>











        <p id="currentPasswordError"
           class="hidden text-red-600 dark:text-red-400 text-xs mt-1"></p>

        {{-- <input type="password" id="newPassword"
            placeholder="New password"
            class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"> --}}
<div class="relative">
    <input type="password" id="newPassword"
        placeholder="New password"
        class="w-full px-3 py-2 pr-10 border border-gray-200 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white">

    <button type="button"
        onclick="togglePasswordVisibility('newPassword', this)"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
        <i class="fa-solid fa-eye text-sm"></i>
    </button>
</div>


        <p id="newPasswordError"
           class="hidden text-red-600 dark:text-red-400 text-xs mt-1"></p>


        <button type="button"
            onclick="changeMasterPassword()"
            class="btn-primary px-4 py-2 rounded-lg text-sm">
            Update Password
        </button>

    </div>
</div>












    <!-- SHORTCUTS MODAL -->
    <div id="shortcutsModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeModal('shortcutsModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-2">
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md modal-shadow fade-in" onclick="event.stopPropagation()">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 data-text-animate="blurInUp" data-animate-by="word" class="text-lg font-bold text-black dark:text-white">Keyboard Shortcuts</h3>
                    <button onclick="closeModal('shortcutsModal')" class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center"><i class="fa-solid fa-xmark text-gray-500"></i></button>
                </div>
                <div class="p-6 grid grid-cols-2 gap-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Search</span><span class="kbd">⌘K</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">New Project</span><span class="kbd">⌘N</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Export</span><span class="kbd">⌘E</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Dark Mode</span><span class="kbd">⌘D</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Lock</span><span class="kbd">⌘L</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Close Modal</span><span class="kbd">Esc</span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP Verification Modal -->
    <div id="otpModal"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-sm"
        style="display:none;">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-6
                animate-fade-in">

        <!-- Header -->
        <div class="text-center mb-5">
        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full
                    flex items-center justify-center mx-auto mb-3">
            <i class="fa-solid fa-shield-halved text-2xl text-blue-600
                    dark:text-blue-400"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
            OTP Verification
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Verify your identity to view passwords
        </p>
        </div>

        <!-- Step 1 – Send OTP -->
        <div id="otpStep1">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 mb-4
                    text-center">
            <i class="fa-solid fa-envelope text-blue-500 text-lg mb-1"></i>
            <p class="text-sm text-blue-700 dark:text-blue-300">
            We'll send a one-time code to your registered email address.
            </p>
        </div>
        <button onclick="sendOtp()"
                class="w-full bg-black dark:bg-white text-white dark:text-black
                        py-2.5 rounded-xl text-sm font-semibold
                        hover:opacity-90 transition">
            <i class="fa-solid fa-paper-plane mr-2"></i>Send OTP
        </button>
        </div>

        <!-- Step 2 – Enter OTP -->
        <div id="otpStep2" class="hidden">
        <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-3 mb-4
                    text-center">
            <i class="fa-solid fa-check-circle text-green-500 mr-1"></i>
            <span class="text-sm text-green-700 dark:text-green-300">
            OTP sent successfully!
            </span>
        </div>

        <!-- 4-digit OTP inputs -->
        <div class="flex justify-center gap-3 mb-3">
            <input type="text" maxlength="1" id="otp1"
                class="w-12 h-14 text-center text-xl font-bold rounded-xl
                        border-2 border-gray-200 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-700
                        text-gray-900 dark:text-white
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                        outline-none transition"
                oninput="otpAutoTab(this,'otp2')"
                onkeydown="otpBackspace(event,this,null)">
            <input type="text" maxlength="1" id="otp2"
                class="w-12 h-14 text-center text-xl font-bold rounded-xl
                        border-2 border-gray-200 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-700
                        text-gray-900 dark:text-white
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                        outline-none transition"
                oninput="otpAutoTab(this,'otp3')"
                onkeydown="otpBackspace(event,this,'otp1')">
            <input type="text" maxlength="1" id="otp3"
                class="w-12 h-14 text-center text-xl font-bold rounded-xl
                        border-2 border-gray-200 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-700
                        text-gray-900 dark:text-white
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                        outline-none transition"
                oninput="otpAutoTab(this,'otp4')"
                onkeydown="otpBackspace(event,this,'otp2')">
            <input type="text" maxlength="1" id="otp4"
                class="w-12 h-14 text-center text-xl font-bold rounded-xl
                        border-2 border-gray-200 dark:border-gray-600
                        bg-gray-50 dark:bg-gray-700
                        text-gray-900 dark:text-white
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                        outline-none transition"
                oninput="otpAutoTab(this,null)"
                onkeydown="otpBackspace(event,this,'otp3')">
        </div>

        <!-- Error message -->
        <p id="otpError"
            class="text-xs text-red-500 text-center mb-3 hidden">
            Invalid OTP. Please try again.
        </p>

        <button onclick="verifyOtp()"
                id="otpVerifyBtn"
                class="w-full bg-black dark:bg-white text-white dark:text-black
                        py-2.5 rounded-xl text-sm font-semibold
                        hover:opacity-90 transition">
            <i class="fa-solid fa-check mr-2"></i>Verify &amp; Show Password
        </button>

        <button onclick="sendOtp()"
                class="w-full text-sm text-gray-500 hover:text-gray-700
                        dark:hover:text-gray-300 mt-2 py-1 transition">
            <i class="fa-solid fa-rotate-right mr-1"></i>Resend OTP
        </button>
        </div>

        <!-- Cancel -->
        <button onclick="closeOtpModal()"
                class="w-full text-sm text-gray-400 hover:text-gray-600
                    dark:hover:text-gray-300 mt-3 py-1 transition">
        Cancel
        </button>
    </div>
    </div>
    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="fixed bottom-4 right-4 bg-black dark:bg-white text-white dark:text-black px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 transform translate-y-20 opacity-0 transition-all duration-300 z-[70]">
        <i id="toastIcon" class="fa-solid fa-check"></i>
        <span id="toastMessage">Success!</span>
    </div>
<script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
    <!-- Marquee Toggle Script -->
    <script>
        function toggleMarquee() {
            const wrapper = document.getElementById('marqueeWrapper');
            const btn = document.getElementById('marqueeToggleBtn');
            const labelSpan = btn.querySelector('span');
            wrapper.classList.toggle('collapsed');
            btn.classList.toggle('collapsed');
            if (wrapper.classList.contains('collapsed')) { if (labelSpan) labelSpan.textContent = 'Show'; }
            else { if (labelSpan) labelSpan.textContent = 'Hide'; }
            localStorage.setItem('marqueeCollapsed', wrapper.classList.contains('collapsed'));
        }
        document.addEventListener('DOMContentLoaded', function() {
            const isCollapsed = localStorage.getItem('marqueeCollapsed') === 'true';
            if (isCollapsed) {
                const wrapper = document.getElementById('marqueeWrapper');
                const btn = document.getElementById('marqueeToggleBtn');
                const labelSpan = btn.querySelector('span');
                wrapper.classList.add('collapsed'); btn.classList.add('collapsed');
                if (labelSpan) labelSpan.textContent = 'Show';
            }
        });
    </script>

    <script>
    // =====================================================
    // FAVICON FETCHER
    // =====================================================
    const FaviconFetcher={s:[(d)=>`https://icon.horse/icon/${d}`,(d)=>`https://www.google.com/s2/favicons?domain=${d}&sz=128`,(d)=>`https://icons.duckduckgo.com/ip3/${d}.ico`,(d)=>`https://favicone.com/${d}?s=128`,(d)=>`https://logo.clearbit.com/${d}`,(d)=>`https://${d}/favicon.ico`,(d)=>`https://${d}/favicon.png`],c:new Map(),f:new Set(),d(u){if(!u)return null;try{return new URL(u.startsWith('http')?u:'https://'+u).hostname.replace('www.','')}catch{return null}},g(d){return d?this.s.map(s=>{try{return s(d)}catch{return null}}).filter(u=>u&&!this.f.has(u)):[]},l(l,c,r){return`<div class="w-full h-full ${typeof c==='string'&&c.startsWith('bg-')?c:getColorClass(c)} ${r} flex items-center justify-center text-white font-bold">${l}</div>`},createHtml(u,o={}){const{size:z=40,className:n='',fallbackLetter:l='?',fallbackColor:fc='bg-gray-500',rounded:r='rounded-xl'}=o,d=this.d(u),urls=this.g(d),id='f_'+Math.random().toString(36).substr(2,6);return urls.length?`<div id="${id}" class="${n} overflow-hidden ${r}" style="width:${z}px;height:${z}px"><img src="${urls[0]}" alt="" class="w-full h-full object-contain bg-gray-100 dark:bg-gray-700 p-1" data-u='${JSON.stringify(urls.slice(1))}' data-l="${l}" data-c="${fc}" data-r="${r}" data-d="${d||''}" onload="FaviconFetcher.ok(this)" onerror="FaviconFetcher.err(this)"></div>`:`<div class="${n}" style="width:${z}px;height:${z}px">${this.l(l,fc,r)}</div>`},ok(i){if(i.naturalWidth<=1)this.err(i);else if(i.dataset.d)this.c.set(i.dataset.d,i.src)},err(i){this.f.add(i.src);let u=[];try{u=JSON.parse(i.dataset.u||'[]')}catch{}u.length?(i.dataset.u=JSON.stringify(u.slice(1)),i.src=u[0]):i.parentElement&&(i.parentElement.innerHTML=this.l(i.dataset.l||'?',i.dataset.c||'bg-gray-500',i.dataset.r||'rounded-xl'))},getUrl(u){const d=this.d(u);return d?this.c.get(d)||`https://icon.horse/icon/${d}`:null}};window.FaviconFetcher=FaviconFetcher;

    // =====================================================
    // CONFIGURATION & STATE
    // =====================================================
    let projects = [];
    let trash = [];
    let selectedProjects = new Set();
    let deleteTarget = { type: null, projectId: null, credentialId: null };
    let currentViewProjectId = null;
    let activityLog = [];
    let filterState = { favorites: false, archived: false, tag: null };
    let settings = { darkMode: false };

    const countryData = {
        IN: { name: 'India', flag: '🇮🇳' },
        UK: { name: 'United Kingdom', flag: '🇬🇧' },
        SG: { name: 'Singapore', flag: '🇸🇬' },
        MY: { name: 'Malaysia', flag: '🇲🇾' },
        LK: { name: 'Sri Lanka', flag: '🇱🇰' },
        OTHER: { name: 'Other', flag: '🌍' }
    };

    // =====================================================
    // INITIALIZATION
    // =====================================================
    function init() {
    loadFromStorage();
    if (projects.length === 0) projects = getDefaultProjects();
    document.body.classList.add('app-ready');
    initApp();
}

    function initApp() {
        applyDarkMode();
        const savedView = localStorage.getItem('winngoo_view') || 'grid';
        switchView(savedView);
        renderProjects();
        renderTags();
        updateStats();
        updateDataSize();
    }

    // =====================================================
    // DEFAULT DATA
    // =====================================================
    function getDefaultProjects() {
        return [
            {
                id: generateId(),
                name: "Winngoo Pages",
                description: "Website builder and landing page platform",
                category: "Website",
                status: "live",
                icon: "WP",
                color: "blue",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "Winngoo Technologies Pvt Ltd",
                address: "2nd Floor, Tech Park Road\nBengaluru, Karnataka – 560102",
                devUrl: "",
                liveUrl: "https://winngoopages.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Landing page builder platform",
                tags: ["website", "builder"],
                favorite: true,
                archived: false,
                createdAt: new Date("2024-02-10").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Super Admin",
                        url: "https://winngoopages.in/admin",
                        email: "admin@winngoopages.in",
                        password: "Pages@2024!",
                        notes: "Main admin access",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Demo User",
                        url: "https://winngoopages.in/login",
                        email: "demo@winngoopages.in",
                        password: "Demo@123",
                        notes: "Demo account",
                    },
                ],
            },
            {
                id: generateId(),
                name: "SSVCC",
                description: "Sri Sai Coaching Center",
                category: "Website",
                status: "live",
                icon: "S",
                color: "blue",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "SSVCC",
                address: "2nd Floor, Tech Park Road\nBengaluru, Karnataka – 560102",
                devUrl: "",
                liveUrl: "https://ssvcc.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Sri Sai Coaching Center",
                tags: ["ssvcc", "coaching"],
                favorite: true,
                archived: false,
                createdAt: new Date("2024-02-10").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Super Admin",
                        url: "https://ssvcc.in/",
                        email: "admin@winngoopages.in",
                        password: "Pages@2024!",
                        notes: "Main admin access",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Demo User",
                        url: "https://ssvcc.in/",
                        email: "demo@winngoopages.in",
                        password: "Demo@123",
                        notes: "Demo account",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Fame",
                description: "Social media and influencer platform",
                category: "Website",
                status: "live",
                icon: "WF",
                color: "purple",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "Winngoo Technologies Pvt Ltd",
                address: "2nd Floor, Tech Park Road\nBengaluru, Karnataka – 560102",
                devUrl: "",
                liveUrl: "https://winngoofame.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Influencer and fame tracking platform",
                tags: ["social", "influencer"],
                favorite: false,
                archived: false,
                createdAt: new Date("2024-03-05").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Admin Panel",
                        url: "https://winngoofame.in/admin",
                        email: "admin@winngoofame.in",
                        password: "Fame@Admin2024",
                        notes: "",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Test Influencer",
                        url: "https://winngoofame.in/login",
                        email: "influencer@test.com",
                        password: "Infl@2024",
                        notes: "Test influencer account",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Pages Business",
                description: "Business landing page solutions",
                category: "Website",
                status: "live",
                icon: "PB",
                color: "green",
                logoUrl: "",
                country: "uk",
                phone: "+91 80156 77018",
                companyName: "Winngoo Technologies Pvt Ltd",
                address: "2nd Floor, Tech Park Road\nBengaluru, Karnataka – 560102",
                devUrl: "",
                liveUrl: "https://winngoopagesbusiness.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Premium business landing pages",
                tags: ["business", "premium"],
                favorite: false,
                archived: false,
                createdAt: new Date("2024-02-20").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Business Admin",
                        url: "https://winngoopagesbusiness.in/admin",
                        email: "admin@pagesbusiness.in",
                        password: "BizPages@2024!",
                        notes: "",
                    },
                    {
                        id: generateId(),
                        type: "merchant",
                        title: "Business Owner",
                        url: "https://winngoopagesbusiness.in/dashboard",
                        email: "business@demo.com",
                        password: "Business@123",
                        notes: "Demo business account",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Content Creator",
                        url: "http://winngooinfini.com/creator",
                        email: "creator@winngooinfini.com",
                        password: "Cr3ator@2024",
                        notes: "Content creator account",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Infini",
                description: "Infinite scrolling content platform",
                category: "Website",
                status: "live",
                icon: "WI",
                color: "orange",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "Winngoo Technologies Pvt Ltd",
                address: "2nd Floor, Tech Park Road\nBengaluru, Karnataka – 560102",
                devUrl: "",
                liveUrl: "http://winngooinfini.com/in/index.html",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Infinite content discovery platform",
                tags: ["content", "discovery"],
                favorite: false,
                archived: false,
                createdAt: new Date("2024-04-01").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Infini Admin",
                        url: "http://winngooinfini.com/admin",
                        email: "admin@winngooinfini.com",
                        password: "Infini@Adm1n!",
                        notes: "Main admin panel",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Content Creator",
                        url: "http://winngooinfini.com/creator",
                        email: "creator@winngooinfini.com",
                        password: "Cr3ator@2024",
                        notes: "Content creator account",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Consultancy",
                description: "Business consultancy services portal",
                category: "Website",
                status: "live",
                icon: "WC",
                color: "blue",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "Winngoo Consultancy Services",
                address: "3rd Floor, Business Hub\nMumbai, Maharashtra – 400001",
                devUrl: "",
                liveUrl: "https://winngooconsultancy.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Professional consultancy services",
                tags: ["consultancy", "services"],
                favorite: true,
                archived: false,
                createdAt: new Date("2024-01-25").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Admin Dashboard",
                        url: "https://winngooconsultancy.in/admin",
                        email: "admin@winngooconsultancy.in",
                        password: "Consult@Admin2024",
                        notes: "",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Consultant",
                        url: "https://winngooconsultancy.in/portal",
                        email: "consultant@demo.in",
                        password: "Consult@123",
                        notes: "Demo consultant login",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Matrimony",
                description: "Matrimonial matchmaking platform",
                category: "Website",
                status: "live",
                icon: "WM",
                color: "red",
                logoUrl: "",
                country: "MY",
                phone: "+91 80156 77018",
                companyName: "Winngoo Matrimony Pvt Ltd",
                address: "1st Floor, Family Plaza\nChennai, Tamil Nadu – 600001",
                devUrl: "",
                liveUrl: "https://winngoomatrimony.com/",
                mobLiveUrl: "https://play.google.com/store/apps/winngoomatrimony",
                iosLiveUrl: "https://apps.apple.com/winngoomatrimony",
                notes: "Premium matrimonial service",
                tags: ["matrimony", "matchmaking", "priority"],
                favorite: true,
                archived: false,
                createdAt: new Date("2023-11-15").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Super Admin",
                        url: "https://winngoomatrimony.com/admin",
                        email: "superadmin@winngoomatrimony.com",
                        password: "Matri@Super2024!",
                        notes: "Full access",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Premium User",
                        url: "https://winngoomatrimony.com/login",
                        email: "premium@test.com",
                        password: "Premium@123",
                        notes: "Test premium account",
                    },
                    {
                        id: generateId(),
                        type: "mobile",
                        title: "Mobile App",
                        url: "",
                        email: "app@winngoomatrimony.com",
                        password: "MobileApp@2024",
                        notes: "Mobile app test credentials",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Vishakarex",
                description: "Industrial equipment marketplace",
                category: "E-Commerce",
                status: "live",
                icon: "VX",
                color: "gray",
                logoUrl: "",
                country: "IN",
                phone: "+91 98765 43210",
                companyName: "Vishakarex Industries",
                address: "Industrial Area, Phase 2\nNoida, Uttar Pradesh – 201301",
                devUrl: "https://staging.vishakarex.in",
                liveUrl: "https://vishakarex.in/",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "B2B industrial marketplace",
                tags: ["industrial", "b2b", "marketplace"],
                favorite: false,
                archived: false,
                createdAt: new Date("2024-05-10").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Admin Panel",
                        url: "https://vishakarex.in/admin",
                        email: "admin@vishakarex.in",
                        password: "Visha@Admin2024",
                        notes: "",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Accountingoo",
                description: "Cloud accounting and bookkeeping software",
                category: "CRM",
                status: "live",
                icon: "AC",
                color: "green",
                logoUrl: "",
                country: "IN",
                phone: "+91 80156 77018",
                companyName: "Accountingoo Software Solutions",
                address: "5th Floor, Finance Tower\nGurugram, Haryana – 122001",
                devUrl: "https://dev.accountingoo.com",
                liveUrl: "https://accountingoo.com/",
                mobLiveUrl: "https://play.google.com/store/apps/accountingoo",
                iosLiveUrl: "https://apps.apple.com/accountingoo",
                notes: "GST compliant accounting software",
                tags: ["accounting", "gst", "finance", "priority"],
                favorite: true,
                archived: false,
                createdAt: new Date("2023-09-01").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Super Admin",
                        url: "https://accountingoo.com/admin",
                        email: "superadmin@accountingoo.com",
                        password: "Acc@Super2024!",
                        notes: "Full system access",
                    },
                    {
                        id: generateId(),
                        type: "user",
                        title: "Business Account",
                        url: "https://accountingoo.com/login",
                        email: "business@demo.com",
                        password: "Business@Acc123",
                        notes: "Demo business account with sample data",
                    },
                ],
            },
            {
                id: generateId(),
                name: "Winngoo Analytics",
                description: "Business intelligence dashboard",
                category: "Analytics",
                status: "development",
                icon: "A",
                color: "blue",
                logoUrl: "",
                country: "🇱🇰",
                phone: "+1 555 123 4567",
                companyName: "Winngoo Inc",
                address: "123 Tech Street\nSan Francisco, CA 94102",
                devUrl: "https://dev.winngoo-analytics.com",
                liveUrl: "",
                mobLiveUrl: "",
                iosLiveUrl: "",
                notes: "Expected Q1 2025",
                tags: ["beta"],
                favorite: false,
                archived: false,
                createdAt: new Date("2024-08-01").toISOString(),
                updatedAt: new Date().toISOString(),
                credentials: [
                    {
                        id: generateId(),
                        type: "admin",
                        title: "Dev Admin",
                        url: "",
                        email: "dev@winngoo.com",
                        password: "D3v@2024",
                        notes: "",
                    },
                ],
            },
        ];

    }

    // =====================================================
    // STORAGE FUNCTIONS
    // =====================================================
    function saveToStorage() {
        localStorage.setItem('winngoo_data', JSON.stringify({ projects, trash, settings, activityLog: activityLog.slice(0, 50) }));
        document.getElementById('lastSaved').textContent = 'Saved ' + new Date().toLocaleTimeString();
        updateDataSize();
    }
    function loadFromStorage() {
        const data = localStorage.getItem('winngoo_data');
        if (data) { const parsed = JSON.parse(data); projects = parsed.projects || []; trash = parsed.trash || []; settings = { ...settings, ...parsed.settings }; activityLog = parsed.activityLog || []; }
    }
    function updateDataSize() {
        const data = localStorage.getItem('winngoo_data') || '';
        document.getElementById('dataSize').textContent = (new Blob([data]).size / 1024).toFixed(1) + ' KB';
    }

    


    // =====================================================
    // DARK MODE
    // =====================================================
    function toggleDarkMode() { settings.darkMode = !settings.darkMode; applyDarkMode(); saveToStorage(); }
    function applyDarkMode() { document.documentElement.classList.toggle('dark', settings.darkMode); }

    // =====================================================
    // UTILITY FUNCTIONS
    // =====================================================
    function generateId() { return 'id_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9); }
    function escapeHtml(t) { const d = document.createElement('div'); d.textContent = t || ''; return d.innerHTML; }
    function formatDate(d) { return new Date(d).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }); }
    function capitalizeFirst(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : ''; }
    function getAllTags() { const t = new Set(); projects.forEach(p => (p.tags || []).forEach(tag => t.add(tag))); return Array.from(t); }
    function copyToClipboard(text) { navigator.clipboard.writeText(text); showToast('Copied!'); logActivity('Copied to clipboard'); }

    function getFaviconUrl(project) {
        if (project.logoUrl) return project.logoUrl;
        if (project.iconData) { try { const iconData = typeof project.iconData === 'string' ? JSON.parse(project.iconData) : project.iconData; if (iconData.type === 'url' && iconData.url) return iconData.url; if (iconData.type === 'upload' && iconData.data) return iconData.data; if (iconData.type === 'favicon' && iconData.url) return iconData.url; } catch {} }
        const url = project.liveUrl || project.devUrl;
        if (url) return FaviconFetcher.getUrl(url);
        return null;
    }

    function createProjectIcon(project, size = 36) {
        const letter = project.icon || project.name?.charAt(0) || 'W';
        const color = project.color || 'black';
        const url = project.liveUrl || project.devUrl;
        if (project.iconData) { try { const iconData = typeof project.iconData === 'string' ? JSON.parse(project.iconData) : project.iconData; if (iconData.type === 'upload' && iconData.data) return `<img src="${iconData.data}" alt="" class="w-[${size}px] h-[${size}px] rounded-xl object-contain bg-gray-100 dark:bg-gray-700 p-1">`; if (iconData.type === 'url' && iconData.url) return FaviconFetcher.createHtml(iconData.url, { size, fallbackLetter: letter, fallbackColor: color }); } catch {} }
        if (project.logoUrl) return FaviconFetcher.createHtml(project.logoUrl, { size, fallbackLetter: letter, fallbackColor: color });
        if (url) return FaviconFetcher.createHtml(url, { size, fallbackLetter: letter, fallbackColor: color });
        return `<div class="w-[${size}px] h-[${size}px] ${getColorClass(color)} rounded-xl flex items-center justify-center text-white font-bold">${escapeHtml(letter)}</div>`;
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').textContent = message;
        document.getElementById('toastIcon').className = type === 'error' ? 'fa-solid fa-xmark' : 'fa-solid fa-check';
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => toast.classList.add('translate-y-20', 'opacity-0'), 2500);
    }
    function logActivity(action, details = '') { activityLog.unshift({ action, details, timestamp: new Date().toISOString() }); if (activityLog.length > 50) activityLog.pop(); saveToStorage(); }

    // =====================================================
    // COLOR & STATUS HELPERS
    // =====================================================
    function getColorClass(c) { return { black: 'bg-black', blue: 'bg-blue-600', green: 'bg-green-600', purple: 'bg-purple-600', red: 'bg-red-600', orange: 'bg-orange-500' }[c] || 'bg-black'; }
    function getStatusClasses(s) { return { live: 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400', development: 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400', inactive: 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }[s] || ''; }
    function getStatusDotClass(s) { return { live: 'status-live', development: 'status-dev', inactive: 'status-inactive' }[s] || 'status-inactive'; }
    function getCredIcon(t) { return { admin: 'fa-shield-halved', user: 'fa-user', api: 'fa-code', database: 'fa-database', ftp: 'fa-folder', other: 'fa-key' }[t] || 'fa-key'; }

    function updateStats() {
        const active = projects.filter(p => !p.archived);
        document.getElementById('stat-total').textContent = active.length;
        document.getElementById('stat-live').textContent = active.filter(p => p.status === 'live').length;
        document.getElementById('stat-dev').textContent = active.filter(p => p.status === 'development').length;
        document.getElementById('stat-creds').textContent = projects.reduce((s, p) => s + (p.credentials?.length || 0), 0);
    }

    function renderTags() {
        const tags = getAllTags();
        document.getElementById('tagFilters').innerHTML = tags.length === 0 ? '' :
            tags.map(t => `<button onclick="toggleFilter('tag','${escapeHtml(t)}')" class="tag ${filterState.tag === t ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'}">${escapeHtml(t)}</button>`).join('');
    }

    function toggleFilter(type, value) {
        if (type === 'favorites') { filterState.favorites = !filterState.favorites; document.getElementById('favFilterBtn').classList.toggle('bg-black', filterState.favorites); document.getElementById('favFilterBtn').classList.toggle('text-white', filterState.favorites); }
        else if (type === 'archived') { filterState.archived = !filterState.archived; document.getElementById('archiveFilterBtn').classList.toggle('bg-black', filterState.archived); document.getElementById('archiveFilterBtn').classList.toggle('text-white', filterState.archived); }
        else if (type === 'tag') { filterState.tag = filterState.tag === value ? null : value; renderTags(); }
        renderProjects();
    }

    function getFilteredProjects() {
        const search = (document.getElementById('searchInput')?.value || '').toLowerCase();
        const status = document.getElementById('filterStatus')?.value || '';
        const category = document.getElementById('filterCategory')?.value || '';
        const country = document.getElementById('filterCountry')?.value || '';
        const sortBy = document.getElementById('sortBy')?.value || 'name-asc';
        let filtered = projects.filter(p => {
            if (!filterState.archived && p.archived) return false; if (filterState.archived && !p.archived) return false;
            if (filterState.favorites && !p.favorite) return false; if (filterState.tag && !(p.tags || []).includes(filterState.tag)) return false;
            if (status && p.status !== status) return false; if (category && p.category !== category) return false; if (country && p.country !== country) return false;
            if (search && !p.name.toLowerCase().includes(search) && !p.description?.toLowerCase().includes(search) && !(p.tags || []).some(t => t.includes(search))) return false;
            return true;
        });
        return filtered.sort((a, b) => { switch (sortBy) { case 'name-desc': return b.name.localeCompare(a.name); case 'date-desc': return new Date(b.updatedAt) - new Date(a.updatedAt); case 'date-asc': return new Date(a.updatedAt) - new Date(b.updatedAt); case 'favorites': return (b.favorite ? 1 : 0) - (a.favorite ? 1 : 0) || a.name.localeCompare(b.name); default: return a.name.localeCompare(b.name); } });
    }

    // =====================================================
    // RENDER PROJECTS TABLE
    // =====================================================
    function renderProjects() {
        const filtered = getFilteredProjects();
        document.getElementById('projectCount').textContent = filtered.length;
        document.getElementById('emptyState').classList.toggle('hidden', filtered.length > 0);
        document.getElementById('projectsBody').innerHTML = filtered.map((p, index) => {
            const faviconUrl = getFaviconUrl(p);
            const faviconHtml = faviconUrl
                ? `<img src="${escapeHtml(faviconUrl)}" alt="" class="favicon-img" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"><div class="w-9 h-9 ${getColorClass(p.color)} rounded-lg items-center justify-center text-white font-bold text-sm hidden">${escapeHtml(p.icon || p.name.charAt(0))}</div>`
                : `<div class="w-9 h-9 ${getColorClass(p.color)} rounded-lg flex items-center justify-center text-white font-bold text-sm">${escapeHtml(p.icon || p.name.charAt(0))}</div>`;
            return `
            <tr class="border-b border-gray-50 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <td class="py-2 px-4 no-print"><input type="checkbox" class="w-4 h-4 rounded" data-id="${p.id}" onchange="toggleSelection('${p.id}')" ${selectedProjects.has(p.id) ? 'checked' : ''}></td>
                <td class="py-3 px-2"><button onclick="toggleFavorite('${p.id}')" class="favorite-star ${p.favorite ? 'active' : 'text-gray-300 dark:text-gray-600'}"><i class="fa-${p.favorite ? 'solid' : 'regular'} fa-star"></i></button></td>
                <td class="py-3 text-center px-2 text-sm font-medium text-gray-600 dark:text-gray-400">${index + 1}</td>
                <td class="py-2 px-4"><div class="flex items-center gap-3">${faviconHtml}<div class="min-w-0"><p class="font-semibold text-gray-900 dark:text-white truncate">${escapeHtml(p.name)}</p><p class="text-gray-500 dark:text-gray-400 text-xs truncate">${escapeHtml(p.description || p.category)}</p></div></div></td>
                <td class="py-2 px-4"><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${getStatusClasses(p.status)}"><span class="status-dot ${getStatusDotClass(p.status)} mr-1.5 ${p.status === 'live' ? 'pulse-dot' : ''}"></span>${capitalizeFirst(p.status)}</span></td>
                <td class="py-2 px-4"><div class="flex flex-wrap gap-1">${(p.tags || []).map(t => `<span class="tag bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">${escapeHtml(t)}</span>`).join('') || '<span class="text-xs text-gray-400">—</span>'}</div></td>
                <td class="py-2 px-4 text-xs text-gray-500">${formatDate(p.updatedAt)}</td>
                <td class="py-2 px-4 no-print"><div class="flex items-center justify-end gap-1">
                    <button onclick="openViewModal('${p.id}')" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="View"><i class="fa-solid fa-eye text-gray-500 text-sm"></i></button>
                    <button onclick="duplicateProject('${p.id}')" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="Duplicate"><i class="fa-solid fa-copy text-gray-500 text-sm"></i></button>
                    <button onclick="openEditProjectModal('${p.id}')" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="Edit"><i class="fa-solid fa-pen text-gray-500 text-sm"></i></button>
                    <button onclick="openDeleteModal('project','${p.id}')" class="p-1.5 hover:bg-red-50 dark:hover:bg-red-900/20 rounded" title="Delete"><i class="fa-solid fa-trash text-gray-500 hover:text-red-600 text-sm"></i></button>
                </div></td>
            </tr>`;
        }).join('');
    }

    // =====================================================
    // SELECTION & BULK ACTIONS
    // =====================================================
    function toggleSelection(id) { selectedProjects.has(id) ? selectedProjects.delete(id) : selectedProjects.add(id); updateBulkActions(); }
    function toggleSelectAll() { const all = document.getElementById('selectAll').checked; getFilteredProjects().forEach(p => all ? selectedProjects.add(p.id) : selectedProjects.delete(p.id)); renderProjects(); updateBulkActions(); }
    function updateBulkActions() { document.getElementById('selectedCount').textContent = selectedProjects.size; document.getElementById('bulkActions').classList.toggle('hidden', selectedProjects.size === 0); }
    function clearSelection() { selectedProjects.clear(); document.getElementById('selectAll').checked = false; renderProjects(); updateBulkActions(); }
    function bulkArchive() { projects.forEach(p => { if (selectedProjects.has(p.id)) { p.archived = true; p.updatedAt = new Date().toISOString(); } }); saveToStorage(); renderProjects(); updateStats(); clearSelection(); showToast('Projects archived'); }
    function bulkExport() { exportData(); }
    function bulkDelete() { deleteTarget = { type: 'bulk' }; document.getElementById('deleteModalTitle').textContent = `Delete ${selectedProjects.size} Projects?`; document.getElementById('deleteModalMessage').textContent = 'Move selected projects to trash?'; document.getElementById('deleteModal').classList.remove('hidden'); }

    // =====================================================
    // PROJECT OPERATIONS
    // =====================================================
    function toggleFavorite(id) { const p = projects.find(x => x.id === id); if (p) { p.favorite = !p.favorite; p.updatedAt = new Date().toISOString(); saveToStorage(); renderProjects(); logActivity(p.favorite ? 'Added to favorites' : 'Removed from favorites', p.name); } }
    function duplicateProject(id) { const p = projects.find(x => x.id === id); if (p) { const dup = { ...JSON.parse(JSON.stringify(p)), id: generateId(), name: p.name + ' (Copy)', favorite: false, createdAt: new Date().toISOString(), updatedAt: new Date().toISOString(), credentials: p.credentials.map(c => ({ ...c, id: generateId() })) }; projects.push(dup); saveToStorage(); renderProjects(); updateStats(); showToast('Project duplicated'); logActivity('Duplicated', p.name); } }

    // =====================================================
    // MODALS - OPEN/CLOSE
    // =====================================================
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); document.body.style.overflow = ''; }
    function closeAllModals() { ['projectModal', 'viewModal', 'credentialModal', 'deleteModal', 'importModal', 'settingsModal', 'shortcutsModal', 'commandPalette'].forEach(closeModal); }

    function openAddProjectModal() { document.getElementById('projectModalTitle').textContent = 'Add New Project'; document.getElementById('projectForm').reset(); document.getElementById('projectId').value = ''; document.getElementById('projectColor').value = 'black'; document.getElementById('projectModal').classList.remove('hidden'); }

    function openEditProjectModal(id) {
        const p = projects.find(x => x.id === id); if (!p) return;
        document.getElementById('projectModalTitle').textContent = 'Edit Project';
        document.getElementById('projectId').value = p.id; document.getElementById('projectName').value = p.name; document.getElementById('projectCategory').value = p.category; document.getElementById('projectDescription').value = p.description || ''; document.getElementById('projectLogoUrl').value = p.logoUrl || ''; document.getElementById('projectCountry').value = p.country || ''; document.getElementById('projectPhone').value = p.phone || ''; document.getElementById('projectCompanyName').value = p.companyName || ''; document.getElementById('projectAddress').value = p.address || ''; document.getElementById('projectDevUrl').value = p.devUrl || ''; document.getElementById('projectLiveUrl').value = p.liveUrl || ''; document.getElementById('mobLiveUrl').value = p.mobLiveUrl || ''; document.getElementById('iosLiveUrl').value = p.iosLiveUrl || ''; document.getElementById('projectStatus').value = p.status; document.getElementById('projectIcon').value = p.icon || ''; document.getElementById('projectColor').value = p.color || 'black'; document.getElementById('projectTags').value = (p.tags || []).join(', '); document.getElementById('projectNotes').value = p.notes || ''; document.getElementById('projectFavorite').checked = p.favorite || false;
        document.getElementById('projectModal').classList.remove('hidden');
    }

    // function saveProject(e) {
    //     e.preventDefault(); const id = document.getElementById('projectId').value; const tagsInput = document.getElementById('projectTags').value; const tags = tagsInput ? tagsInput.split(',').map(t => t.trim().toLowerCase()).filter(t => t) : [];
    //     const data = { name: document.getElementById('projectName').value.trim(), category: document.getElementById('projectCategory').value, description: document.getElementById('projectDescription').value.trim(), logoUrl: document.getElementById('projectLogoUrl').value.trim(), country: document.getElementById('projectCountry').value, phone: document.getElementById('projectPhone').value.trim(), companyName: document.getElementById('projectCompanyName').value.trim(), address: document.getElementById('projectAddress').value.trim(), devUrl: document.getElementById('projectDevUrl').value.trim(), liveUrl: document.getElementById('projectLiveUrl').value.trim(), mobLiveUrl: document.getElementById('mobLiveUrl').value.trim(), iosLiveUrl: document.getElementById('iosLiveUrl').value.trim(), status: document.getElementById('projectStatus').value, icon: document.getElementById('projectIcon').value.trim().toUpperCase() || document.getElementById('projectName').value.charAt(0).toUpperCase(), color: document.getElementById('projectColor').value, tags, notes: document.getElementById('projectNotes').value.trim(), favorite: document.getElementById('projectFavorite').checked, updatedAt: new Date().toISOString() };
    //     if (id) { const idx = projects.findIndex(p => p.id === id); if (idx !== -1) { projects[idx] = { ...projects[idx], ...data }; showToast('Project updated'); logActivity('Updated', data.name); } }
    //     else { projects.push({ id: generateId(), ...data, archived: false, createdAt: new Date().toISOString(), credentials: [] }); showToast('Project created'); logActivity('Created', data.name); }
    //     saveToStorage(); renderProjects(); renderTags(); updateStats(); closeModal('projectModal');
    // }

 function saveProject(e) {
    e.preventDefault();

    const form = document.getElementById('projectForm');
    const formData = new FormData(form);

    // Remove old errors
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    document.querySelectorAll('.input-error').forEach(el => {
        el.classList.remove('border-red-500');
    });

    fetch("{{ route('projects.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        },
        body: formData
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            if (data.errors) {
                showFieldErrors(data.errors);
            }
            return;
        }

        // Success
        form.reset();
        showSuccessMessage(data.message);

    })
    .catch(error => console.error(error));
}


['input', 'change'].forEach(eventType => {
    document.addEventListener(eventType, function (e) {

        const input = e.target;

        // Find the closest wrapper div
        const wrapper = input.closest('div');

        if (!wrapper) return;

        const error = wrapper.querySelector('.field-error');

        if (error) {
            error.remove();
        }

        input.classList.remove('border-red-500', 'input-error');
    });
});
function showFieldErrors(errors) {
    Object.keys(errors).forEach(field => {

        const input = document.querySelector(`[name="${field}"]`);

        if (input) {

            // Add red border + marker class
            // input.classList.add('border-red-500', 'input-error');

            const error = document.createElement('p');
            error.className = "field-error text-red-500 text-xs mt-1";
            error.innerText = errors[field][0];

            input.parentElement.appendChild(error);
        }
    });
}


function showSectionSuccess(message) {

    const successDiv = document.getElementById('formSuccessMessage');

    successDiv.innerText = message;
    successDiv.classList.remove('hidden');

    // Auto hide after 3 seconds
    setTimeout(() => {
        successDiv.classList.add('hidden');
    }, 3000);
}

// Remove error when user starts typing or changing field

    // =====================================================
    // VIEW PROJECT MODAL
    // =====================================================
    function openViewModal(id) {
        const p = projects.find(x => x.id === id); if (!p) return; currentViewProjectId = id;
        const faviconUrl = getFaviconUrl(p); const logoImg = document.getElementById('viewModalLogo'); const fallback = document.getElementById('viewModalFallback');
        if (faviconUrl) { logoImg.src = faviconUrl; logoImg.style.display = 'block'; fallback.style.display = 'none'; fallback.textContent = p.icon || p.name.charAt(0); fallback.className = `w-full h-full ${getColorClass(p.color)} rounded-xl items-center justify-center text-white font-bold hidden`; }
        else { logoImg.style.display = 'none'; fallback.style.display = 'flex'; fallback.textContent = p.icon || p.name.charAt(0); fallback.className = `w-full h-full ${getColorClass(p.color)} rounded-xl flex items-center justify-center text-white font-bold`; }
        document.getElementById('viewModalTitle').textContent = p.name; document.getElementById('viewModalSubtitle').textContent = p.category + ' • ' + capitalizeFirst(p.status);
        renderViewContent(p); document.getElementById('viewModal').classList.remove('hidden'); logActivity('Viewed', p.name);
    }

    function renderViewContent(p) {
        const countryInfo = countryData[p.country] || { name: p.country, flag: '🌍' };
        let html = `<div class="flex flex-wrap gap-2 mb-4 no-print"><button onclick="copyAllCredentials('${p.id}')" class="btn-secondary px-3 py-1.5 rounded text-xs"><i class="fa-solid fa-copy mr-1"></i>Copy All</button><button onclick="openEditProjectModal('${p.id}');closeModal('viewModal')" class="btn-secondary px-3 py-1.5 rounded text-xs"><i class="fa-solid fa-pen mr-1"></i>Edit</button><button onclick="duplicateProject('${p.id}');closeModal('viewModal')" class="btn-secondary px-3 py-1.5 rounded text-xs"><i class="fa-solid fa-copy mr-1"></i>Duplicate</button></div>`;
        if (p.companyName || p.address || p.phone || p.country) {
            html += `<div class="w-full rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 p-5 mb-4"><div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2"><div><h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">${escapeHtml(p.name)}${p.country ? `<span class="inline-flex items-center gap-1 rounded-full bg-blue-50 dark:bg-blue-900/30 px-3 py-1 text-xs font-semibold text-blue-700 dark:text-blue-300">${countryInfo.flag} ${countryInfo.name}</span>` : ''}</h3>${p.description ? `<p class="mt-1 text-sm text-gray-500 dark:text-gray-400">${escapeHtml(p.description)}</p>` : ''}${p.phone ? `<p class="mt-1 text-sm text-gray-500 dark:text-gray-400"><i class="fa-solid fa-phone mr-1"></i>${escapeHtml(p.phone)}</p>` : ''}</div>${(p.companyName || p.address) ? `<div class="text-left sm:text-right text-sm text-gray-700 dark:text-gray-300">${p.companyName ? `<p class="font-medium text-gray-800 dark:text-gray-200">${escapeHtml(p.companyName)}</p>` : ''}${p.address ? `<p class="mt-1 whitespace-pre-line">${escapeHtml(p.address)}</p>` : ''}</div>` : ''}</div></div>`;
        }
        html += `<div class="mb-4"><h4 class="text-xs font-semibold text-gray-400 uppercase mb-3">Project URLs</h4><div class="grid gap-3 sm:grid-cols-2">`;
        html += `<div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-2"><div class="flex items-center justify-between mb-1"><span class="text-sm font-medium text-gray-600 dark:text-gray-400">Website Dev URL</span><span class="credential-badge bg-amber-100 dark:bg-amber-900/30 text-amber-700">DEV</span></div>${p.devUrl ? `<div class="flex items-center justify-between"><a href="${escapeHtml(p.devUrl)}" target="_blank" class="text-sm text-black dark:text-white hover:underline truncate mr-2">${escapeHtml(p.devUrl)}</a><button onclick="copyToClipboard('${escapeHtml(p.devUrl)}')" class="p-1.5 bg-white dark:bg-gray-600 rounded border"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div>` : '<span class="text-sm text-gray-400">Not set</span>'}</div>`;
        html += `<div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-2"><div class="flex items-center justify-between mb-1"><span class="text-sm font-medium text-gray-600 dark:text-gray-400">Website Live URL</span><span class="credential-badge bg-green-100 dark:bg-green-900/30 text-green-700">LIVE</span></div>${p.liveUrl ? `<div class="flex items-center justify-between"><a href="${escapeHtml(p.liveUrl)}" target="_blank" class="text-sm text-black dark:text-white hover:underline truncate mr-2">${escapeHtml(p.liveUrl)}</a><button onclick="copyToClipboard('${escapeHtml(p.liveUrl)}')" class="p-1.5 bg-white dark:bg-gray-600 rounded border"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div>` : '<span class="text-sm text-gray-400">Not deployed</span>'}</div>`;
        html += `<div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-2"><div class="flex items-center justify-between mb-1"><span class="text-sm font-medium text-gray-600 dark:text-gray-400">Android URL</span><span class="credential-badge bg-blue-100 dark:bg-blue-900/30 text-blue-700">ANDROID</span></div>${p.mobLiveUrl ? `<div class="flex items-center justify-between"><a href="${escapeHtml(p.mobLiveUrl)}" target="_blank" class="text-sm text-black dark:text-white hover:underline truncate mr-2">${escapeHtml(p.mobLiveUrl)}</a><button onclick="copyToClipboard('${escapeHtml(p.mobLiveUrl)}')" class="p-1.5 bg-white dark:bg-gray-600 rounded border"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div>` : '<span class="text-sm text-gray-400">Not deployed</span>'}</div>`;
        html += `<div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-2"><div class="flex items-center justify-between mb-1"><span class="text-sm font-medium text-gray-600 dark:text-gray-400">iOS URL</span><span class="credential-badge bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300">iOS</span></div>${p.iosLiveUrl ? `<div class="flex items-center justify-between"><a href="${escapeHtml(p.iosLiveUrl)}" target="_blank" class="text-sm text-black dark:text-white hover:underline truncate mr-2">${escapeHtml(p.iosLiveUrl)}</a><button onclick="copyToClipboard('${escapeHtml(p.iosLiveUrl)}')" class="p-1.5 bg-white dark:bg-gray-600 rounded border"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div>` : '<span class="text-sm text-gray-400">Not deployed</span>'}</div>`;
        html += `</div></div>`;
        if (p.tags?.length) html += `<div class="mb-4"><h4 class="text-xs font-semibold text-gray-400 uppercase mb-1">Tags</h4><div class="flex flex-wrap gap-1">${p.tags.map(t => `<span class="tag bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">${escapeHtml(t)}</span>`).join('')}</div></div>`;
        if (p.notes) html += `<div class="mb-4"><h4 class="text-xs font-semibold text-gray-400 uppercase mb-1">Notes</h4><div class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 rounded-xl p-3 whitespace-pre-wrap">${escapeHtml(p.notes)}</div></div>`;
        html += `<div><div class="flex items-center justify-between mb-3"><h4 class="text-xs font-semibold text-gray-400 uppercase">Credentials (${p.credentials?.length || 0})</h4><button onclick="openAddCredentialModal('${p.id}')" class="text-sm font-medium text-black dark:text-white hover:underline no-print"><i class="fa-solid fa-plus mr-1"></i>Add</button></div>`;
        if (p.credentials?.length) {
            html += '<div class="space-y-3">';
            p.credentials.forEach(c => {
                html += `<div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-2"><div class="flex items-center justify-between mb-3"><div class="flex items-center gap-2"><div class="w-8 h-8 bg-white dark:bg-gray-600 rounded-lg flex items-center justify-center border"><i class="fa-solid ${getCredIcon(c.type)} text-gray-500 text-sm"></i></div><div><p class="font-medium text-gray-900 dark:text-white text-sm">${escapeHtml(c.title)}</p>${c.url ? `<a href="${escapeHtml(c.url)}" target="_blank" class="text-xs text-gray-500 hover:underline">${escapeHtml(c.url)}</a>` : ''}</div></div><div class="flex items-center gap-1 no-print"><span class="credential-badge bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300">${c.type}</span><button onclick="openEditCredentialModal('${p.id}','${c.id}')" class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded"><i class="fa-solid fa-pen text-gray-500 text-xs"></i></button><button onclick="openDeleteModal('credential','${p.id}','${c.id}')" class="p-1 hover:bg-red-100 dark:hover:bg-red-900/20 rounded"><i class="fa-solid fa-trash text-gray-500 hover:text-red-600 text-xs"></i></button></div></div><div class="grid gap-2 sm:grid-cols-2"><div class="bg-white dark:bg-gray-600 rounded-lg p-2 border"><label class="text-xs text-gray-500 block mb-0.5">Email/Username</label><div class="flex items-center justify-between"><span class="text-sm font-medium text-gray-900 dark:text-white truncate mr-2">${escapeHtml(c.email)}</span><button onclick="copyToClipboard('${escapeHtml(c.email)}')" class="p-1 bg-gray-50 dark:bg-gray-500 rounded no-print"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div></div><div class="bg-white dark:bg-gray-600 rounded-lg p-2 border"><label class="text-xs text-gray-500 block mb-0.5">Password</label><div class="flex items-center justify-between"><span class="text-sm font-mono text-gray-900 dark:text-white" id="pwd-${c.id}">••••••••</span><div class="flex gap-1 no-print"><button onclick="togglePwd('pwd-${c.id}','${escapeHtml(c.password)}')" class="p-1 bg-gray-50 dark:bg-gray-500 rounded"><i class="fa-solid fa-eye text-gray-500 text-xs"></i></button><button onclick="copyToClipboard('${escapeHtml(c.password)}')" class="p-1 bg-gray-50 dark:bg-gray-500 rounded"><i class="fa-solid fa-copy text-gray-500 text-xs"></i></button></div></div></div></div>${c.notes ? `<p class="text-xs text-gray-500 mt-2 italic">${escapeHtml(c.notes)}</p>` : ''}</div>`;
            });
            html += '</div>';
        } else {
            html += `<div class="text-center py-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl"><i class="fa-solid fa-key text-2xl text-gray-300 mb-1"></i><p class="text-sm text-gray-500 mb-3">No credentials yet</p><button onclick="openAddCredentialModal('${p.id}')" class="btn-primary px-3 py-1.5 rounded text-sm"><i class="fa-solid fa-plus mr-1"></i>Add</button></div>`;
        }
        html += `</div><div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-400">Created: ${formatDate(p.createdAt)} • Updated: ${formatDate(p.updatedAt)}</div>`;
        document.getElementById('viewModalContent').innerHTML = html;
    }

    /* ───────── OTP State ───────── */
    let otpVerified       = false;   // once true, skip OTP for the session
    let pendingPwdToggle  = null;    // { elId, pwd }
    const CORRECT_OTP     = '1234';  // ← test OTP

    /* ───────── Toggle Password (modified) ───────── */
    function togglePwd(elId, pwd) {
        const el = document.getElementById(elId);

        // If currently visible → just hide (no OTP needed)
        if (el.textContent !== '••••••••') {
            el.textContent = '••••••••';
            return;
        }

        // Already verified this session → reveal instantly
        if (otpVerified) {
            el.textContent = pwd;
            return;
        }

        // Not yet verified → store pending action & open OTP modal
        pendingPwdToggle = { elId, pwd };
        openOtpModal();
    }

    /* ───────── Open / Close OTP Modal ───────── */
    function openOtpModal() {
        const modal = document.getElementById('otpModal');
        modal.style.display = 'flex';

        // Reset to Step 1
        document.getElementById('otpStep1').classList.remove('hidden');
        document.getElementById('otpStep2').classList.add('hidden');
        document.getElementById('otpError').classList.add('hidden');
        clearOtpInputs();
    }

    function closeOtpModal() {
        document.getElementById('otpModal').style.display = 'none';
        pendingPwdToggle = null;
        clearOtpInputs();
    }

    /* ───────── Step 1 → Send OTP ───────── */
    function sendOtp() {
        // In production: call your API to send real email OTP here
        // For test, we just move to step 2

        document.getElementById('otpStep1').classList.add('hidden');
        document.getElementById('otpStep2').classList.remove('hidden');
        document.getElementById('otpError').classList.add('hidden');
        clearOtpInputs();

        // Auto-focus first input
        setTimeout(() => document.getElementById('otp1').focus(), 100);

        // Optional: show toast
        if (typeof showToast === 'function') {
            showToast('OTP sent to your email', 'info');
        }
    }

    /* ───────── Step 2 → Verify OTP ───────── */
    function verifyOtp() {
        const entered = ['otp1','otp2','otp3','otp4']
                        .map(id => document.getElementById(id).value)
                        .join('');

        if (entered === CORRECT_OTP) {
            // ✅ Success
            otpVerified = true;
            closeOtpModal();

            // Reveal the pending password
            if (pendingPwdToggle) {
                const el = document.getElementById(pendingPwdToggle.elId);
                if (el) el.textContent = pendingPwdToggle.pwd;
                pendingPwdToggle = null;
            }

            if (typeof showToast === 'function') {
                showToast('Verified! Passwords unlocked for this session.', 'success');
            }
        } else {
            // ❌ Wrong OTP
            const errEl = document.getElementById('otpError');
            errEl.textContent = 'Invalid OTP. Please try again.';
            errEl.classList.remove('hidden');

            // Shake animation on inputs
            ['otp1','otp2','otp3','otp4'].forEach(id => {
                const inp = document.getElementById(id);
                inp.classList.add('border-red-500');
                inp.style.animation = 'shake 0.4s ease';
                setTimeout(() => {
                    inp.style.animation = '';
                    inp.classList.remove('border-red-500');
                }, 500);
            });

            clearOtpInputs();
            document.getElementById('otp1').focus();
        }
    }

    /* ───────── OTP Input Helpers ───────── */
    function otpAutoTab(current, nextId) {
        // Allow only digits
        current.value = current.value.replace(/\D/g, '');
        if (current.value.length === 1 && nextId) {
            document.getElementById(nextId).focus();
        }
        // Auto-verify when all 4 filled
        if (!nextId && current.value.length === 1) {
            setTimeout(verifyOtp, 150);
        }
    }

    function otpBackspace(e, current, prevId) {
        if (e.key === 'Backspace' && current.value === '' && prevId) {
            document.getElementById(prevId).focus();
        }
    }

    function clearOtpInputs() {
        ['otp1','otp2','otp3','otp4'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.value = '';
                el.classList.remove('border-red-500');
            }
        });
    }

    // Close modal on backdrop click
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('otpModal');
        if (e.target === modal) closeOtpModal();
    });

    // Allow Enter key to verify
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('otpModal');
        if (modal.style.display === 'flex' && e.key === 'Enter') {
            verifyOtp();
        }
        if (modal.style.display === 'flex' && e.key === 'Escape') {
            closeOtpModal();
        }
    });


    function copyAllCredentials(id) {
        const p = projects.find(x => x.id === id); if (!p) return;
        let txt = `=== ${p.name} ===\n`; if (p.companyName) txt += `Company: ${p.companyName}\n`; if (p.country) txt += `Country: ${countryData[p.country]?.name || p.country}\n`; if (p.phone) txt += `Phone: ${p.phone}\n`; if (p.address) txt += `Address: ${p.address}\n`;
        txt += `\nDev: ${p.devUrl || 'N/A'}\nLive: ${p.liveUrl || 'N/A'}\nAndroid: ${p.mobLiveUrl || 'N/A'}\niOS: ${p.iosLiveUrl || 'N/A'}\n\n`;
        p.credentials?.forEach(c => { txt += `--- ${c.title} (${c.type}) ---\nURL: ${c.url || 'N/A'}\nEmail: ${c.email}\nPassword: ${c.password}\n\n`; });
        copyToClipboard(txt);
    }

    // =====================================================
    // CREDENTIAL MODAL
    // =====================================================
    function openAddCredentialModal(projectId) { document.getElementById('credentialModalTitle').textContent = 'Add Credential'; document.getElementById('credentialForm').reset(); document.getElementById('credProjectId').value = projectId; document.getElementById('credentialId').value = ''; document.getElementById('credentialModal').classList.remove('hidden'); }
    function openEditCredentialModal(projectId, credId) { const p = projects.find(x => x.id === projectId); const c = p?.credentials?.find(x => x.id === credId); if (!c) return; document.getElementById('credentialModalTitle').textContent = 'Edit Credential'; document.getElementById('credProjectId').value = projectId; document.getElementById('credentialId').value = credId; document.getElementById('credentialType').value = c.type; document.getElementById('credentialTitle').value = c.title; document.getElementById('credentialUrl').value = c.url || ''; document.getElementById('credentialEmail').value = c.email; document.getElementById('credentialPassword').value = c.password; document.getElementById('credentialNotes').value = c.notes || ''; document.getElementById('credentialModal').classList.remove('hidden'); }
    function saveCredential(e) {
        e.preventDefault(); const projectId = document.getElementById('credProjectId').value; const credId = document.getElementById('credentialId').value; const p = projects.find(x => x.id === projectId); if (!p) return;
        const data = { type: document.getElementById('credentialType').value, title: document.getElementById('credentialTitle').value.trim(), url: document.getElementById('credentialUrl').value.trim(), email: document.getElementById('credentialEmail').value.trim(), password: document.getElementById('credentialPassword').value, notes: document.getElementById('credentialNotes').value.trim() };
        if (credId) { const idx = p.credentials.findIndex(c => c.id === credId); if (idx !== -1) { p.credentials[idx] = { id: credId, ...data }; showToast('Credential updated'); } }
        else { p.credentials.push({ id: generateId(), ...data }); showToast('Credential added'); }
        p.updatedAt = new Date().toISOString(); saveToStorage(); renderProjects(); updateStats(); closeModal('credentialModal');
        if (currentViewProjectId === projectId) renderViewContent(p); logActivity(credId ? 'Updated credential' : 'Added credential', data.title);
    }
    function toggleCredPassword() { const inp = document.getElementById('credentialPassword'); inp.type = inp.type === 'password' ? 'text' : 'password'; }
    function generatePassword() { const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789!@#$%&*'; let pwd = ''; for (let i = 0; i < 16; i++) pwd += chars.charAt(Math.floor(Math.random() * chars.length)); document.getElementById('credentialPassword').value = pwd; document.getElementById('credentialPassword').type = 'text'; showToast('Password generated'); }

    // =====================================================
    // DELETE OPERATIONS
    // =====================================================
    function openDeleteModal(type, projectId, credId = null) {
        deleteTarget = { type, projectId, credentialId: credId };
        if (type === 'project') { const p = projects.find(x => x.id === projectId); document.getElementById('deleteModalTitle').textContent = 'Delete Project?'; document.getElementById('deleteModalMessage').textContent = `Move "${p?.name}" to trash?`; }
        else { document.getElementById('deleteModalTitle').textContent = 'Delete Credential?'; document.getElementById('deleteModalMessage').textContent = 'This action cannot be undone.';         }
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function confirmDelete() {
        if (deleteTarget.type === 'project') {
            const idx = projects.findIndex(p => p.id === deleteTarget.projectId);
            if (idx !== -1) { trash.push({ ...projects[idx], deletedAt: new Date().toISOString() }); const name = projects[idx].name; projects.splice(idx, 1); showToast('Moved to trash'); logActivity('Deleted', name); }
        } else if (deleteTarget.type === 'credential') {
            const p = projects.find(x => x.id === deleteTarget.projectId);
            if (p) { p.credentials = p.credentials.filter(c => c.id !== deleteTarget.credentialId); p.updatedAt = new Date().toISOString(); showToast('Credential deleted'); logActivity('Deleted credential'); if (currentViewProjectId === p.id) renderViewContent(p); }
        } else if (deleteTarget.type === 'bulk') {
            selectedProjects.forEach(id => { const idx = projects.findIndex(p => p.id === id); if (idx !== -1) { trash.push({ ...projects[idx], deletedAt: new Date().toISOString() }); projects.splice(idx, 1); } });
            showToast(`${selectedProjects.size} projects deleted`); logActivity('Bulk deleted', `${selectedProjects.size} projects`); clearSelection();
        }
        saveToStorage(); renderProjects(); renderTags(); updateStats(); closeModal('deleteModal');
    }

    // =====================================================
    // TRASH OPERATIONS
    // =====================================================
    function viewTrash() { closeModal('settingsModal'); document.getElementById('trashSection').classList.toggle('hidden'); renderTrash(); }
    function renderTrash() {
        if (trash.length === 0) { document.getElementById('trashContainer').innerHTML = '<div class="p-6 text-center text-gray-500">Trash is empty</div>'; return; }
        document.getElementById('trashContainer').innerHTML = trash.map(p => `
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-50 dark:border-gray-700 last:border-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 ${getColorClass(p.color)} rounded-lg flex items-center justify-center text-white font-bold text-xs">${escapeHtml(p.icon || p.name.charAt(0))}</div>
                    <div><p class="font-medium text-gray-900 dark:text-white text-sm">${escapeHtml(p.name)}</p><p class="text-xs text-gray-500">Deleted ${formatDate(p.deletedAt)}</p></div>
                </div>
                <div class="flex gap-2">
                    <button onclick="restoreFromTrash('${p.id}')" class="text-xs text-blue-600 hover:underline">Restore</button>
                    <button onclick="permanentDelete('${p.id}')" class="text-xs text-red-600 hover:underline">Delete Forever</button>
                </div>
            </div>`).join('');
    }
    function restoreFromTrash(id) { const idx = trash.findIndex(p => p.id === id); if (idx !== -1) { const p = trash[idx]; delete p.deletedAt; projects.push(p); trash.splice(idx, 1); saveToStorage(); renderProjects(); renderTrash(); updateStats(); showToast('Restored'); logActivity('Restored from trash', p.name); } }
    function permanentDelete(id) { if (confirm('Permanently delete? This cannot be undone.')) { trash = trash.filter(p => p.id !== id); saveToStorage(); renderTrash(); showToast('Permanently deleted'); } }
    function emptyTrash() { if (confirm('Empty all trash? This cannot be undone.')) { trash = []; saveToStorage(); renderTrash(); showToast('Trash emptied'); } }

    // =====================================================
    // EXPORT / IMPORT
    // =====================================================
    function exportData() {

        // ═══════════════════════════════════════════
        //  SHEET 1 — Projects
        // ═══════════════════════════════════════════
        const projectRows = projects.map(p => ({
            "Project Name":     p.name || '',
            "Description":      p.description || '',
            "Category":         p.category || '',
            "Status":           p.status || '',
            "Icon":             p.icon || '',
            "Color":            p.color || '',
            "Logo URL":         p.logoUrl || '',
            "Country":          p.country || '',
            "Phone":            p.phone || '',
            "Company Name":     p.companyName || '',
            "Address":          (p.address || '').replace(/\n/g, ', '),  // flatten newlines
            "Dev URL":          p.devUrl || '',
            "Live URL":         p.liveUrl || '',
            "Mobile Live URL":  p.mobLiveUrl || '',
            "iOS Live URL":     p.iosLiveUrl || '',
            "Notes":            p.notes || '',
            "Tags":             (p.tags || []).join(', '),               // array → string
            "Favorite":         p.favorite ? 'Yes' : 'No',
            "Archived":         p.archived ? 'Yes' : 'No',
            "Created At":       p.createdAt ? new Date(p.createdAt).toLocaleDateString() : '',
            "Updated At":       p.updatedAt ? new Date(p.updatedAt).toLocaleDateString() : ''
        }));

        // ═══════════════════════════════════════════
        //  SHEET 2 — Credentials
        // ═══════════════════════════════════════════
        const credentialRows = [];
        projects.forEach(p => {
            if (p.credentials && p.credentials.length > 0) {
                p.credentials.forEach((cred, index) => {
                    credentialRows.push({
                        "Project Name":     p.name || '',
                        "Category":         p.category || '',
                        "Status":           p.status || '',
                        "#":                index + 1,
                        "Credential Type":  cred.type || '',
                        "Title":            cred.title || '',
                        "URL":              cred.url || '',
                        "Email":            cred.email || '',
                        "Password":         cred.password || '',
                        "Notes":            cred.notes || ''
                    });
                });
            }
        });

        // ═══════════════════════════════════════════
        //  SHEET 3 — Summary / Export Info
        // ═══════════════════════════════════════════
        const totalCredentials = projects.reduce(
            (sum, p) => sum + (p.credentials ? p.credentials.length : 0), 0
        );

        const liveProjects    = projects.filter(p => p.status === 'live').length;
        const devProjects     = projects.filter(p => p.status === 'development').length;
        const favProjects     = projects.filter(p => p.favorite).length;
        const categories      = [...new Set(projects.map(p => p.category))];

        const summaryRows = [
            { "Field": "Export Date",         "Value": new Date().toLocaleString()       },
            { "Field": "App Version",         "Value": "2.0"                             },
            { "Field": "",                    "Value": ""                                },
            { "Field": "Total Projects",      "Value": projects.length                   },
            { "Field": "Live Projects",       "Value": liveProjects                      },
            { "Field": "In Development",      "Value": devProjects                       },
            { "Field": "Favorites",           "Value": favProjects                       },
            { "Field": "Total Credentials",   "Value": totalCredentials                  },
            { "Field": "",                    "Value": ""                                },
            { "Field": "Categories",          "Value": categories.join(', ')             }
        ];

        // ═══════════════════════════════════════════
        //  BUILD WORKBOOK
        // ═══════════════════════════════════════════
        const wb = XLSX.utils.book_new();

        // Helper — auto-fit column widths
        function autoFitColumns(sheet, data) {
            if (!data || data.length === 0) return;
            const keys = Object.keys(data[0]);
            sheet['!cols'] = keys.map(key => ({
                wch: Math.min(
                    50, // max width cap
                    Math.max(
                        key.length + 2,
                        ...data.map(row => String(row[key] || '').length + 2)
                    )
                )
            }));
        }

        // Sheet 1: Projects
        const ws1 = XLSX.utils.json_to_sheet(projectRows);
        autoFitColumns(ws1, projectRows);
        XLSX.utils.book_append_sheet(wb, ws1, "Projects");

        // Sheet 2: Credentials
        if (credentialRows.length > 0) {
            const ws2 = XLSX.utils.json_to_sheet(credentialRows);
            autoFitColumns(ws2, credentialRows);
            XLSX.utils.book_append_sheet(wb, ws2, "Credentials");
        }

        // Sheet 3: Summary
        const ws3 = XLSX.utils.json_to_sheet(summaryRows);
        autoFitColumns(ws3, summaryRows);
        XLSX.utils.book_append_sheet(wb, ws3, "Export Info");

        // ═══════════════════════════════════════════
        //  DOWNLOAD FILE
        // ═══════════════════════════════════════════
        const fileName = `winngoo-backup-${new Date().toISOString().split('T')[0]}.xlsx`;
        XLSX.writeFile(wb, fileName);

        showToast('Data exported as Excel');
        logActivity('Exported data as Excel');
    }
    function openImportModal() { document.getElementById('importModal').classList.remove('hidden'); }
    function handleImport(e) {
        const file = e.target.files[0]; if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            try { const data = JSON.parse(ev.target.result); if (data.projects) { const count = data.projects.length; data.projects.forEach(p => { p.id = generateId(); (p.credentials || []).forEach(c => c.id = generateId()); projects.push(p); }); saveToStorage(); renderProjects(); renderTags(); updateStats(); closeModal('importModal'); showToast(`Imported ${count} projects`); logActivity('Imported', `${count} projects`); } else { showToast('Invalid file format', 'error'); } }
            catch { showToast('Error reading file', 'error'); }
        };
        reader.readAsText(file); e.target.value = '';
    }
    function backupData() { exportData(); }
    function restoreBackup() { document.getElementById('importFile').click(); closeModal('settingsModal'); }
    function clearAllData() { projects = []; trash = []; activityLog = []; saveToStorage(); renderProjects(); renderTags(); updateStats(); showToast('All data cleared'); }

    // =====================================================
    // SETTINGS & PASSWORD
    // =====================================================
    function openSettings() { closeAllModals(); document.getElementById('settingsModal').classList.remove('hidden'); }

    // =====================================================
    // COMMAND PALETTE
    // =====================================================
    function openCommandPalette() { document.getElementById('commandPalette').classList.remove('hidden'); document.getElementById('commandInput').value = ''; document.getElementById('commandInput').focus(); handleCommandInput(''); }
    function closeCommandPalette() { document.getElementById('commandPalette').classList.add('hidden'); }
    function handleCommandInput(val) {
        const results = document.getElementById('commandResults');
        if (val.startsWith('>')) {
            const cmd = val.slice(1).toLowerCase().trim();
            const commands = [
                { icon: 'fa-plus', label: 'New Project', action: 'openAddProjectModal();closeCommandPalette()' },
                { icon: 'fa-download', label: 'Export Data', action: 'exportData();closeCommandPalette()' },
                { icon: 'fa-moon', label: 'Toggle Dark Mode', action: 'toggleDarkMode();closeCommandPalette()' },
                { icon: 'fa-gear', label: 'Settings', action: 'openSettings();closeCommandPalette()' },
                { icon: 'fa-trash', label: 'View Trash', action: 'viewTrash();closeCommandPalette()' }
            ].filter(c => !cmd || c.label.toLowerCase().includes(cmd));
            results.innerHTML = commands.map(c => `<button onclick="${c.action}" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"><i class="fa-solid ${c.icon} w-5 text-gray-400"></i>${c.label}</button>`).join('');
        } else {
            const filtered = projects.filter(p => !val || p.name.toLowerCase().includes(val.toLowerCase()) || p.description?.toLowerCase().includes(val.toLowerCase()));
            results.innerHTML = filtered.slice(0, 8).map(p => `<button onclick="openViewModal('${p.id}');closeCommandPalette()" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"><div class="w-6 h-6 ${getColorClass(p.color)} rounded flex items-center justify-center text-white text-xs font-bold">${escapeHtml(p.icon || p.name.charAt(0))}</div><div class="text-left"><p class="font-medium">${escapeHtml(p.name)}</p><p class="text-xs text-gray-500">${escapeHtml(p.category)} • ${capitalizeFirst(p.status)}</p></div></button>`).join('');
            if (!filtered.length) results.innerHTML = '<div class="px-3 py-6 text-center text-sm text-gray-500">No results found</div>';
        }
    }

    // =====================================================
    // ACTIVITY LOG
    // =====================================================
    function toggleActivityLog() { document.getElementById('activityPanel').classList.toggle('hidden'); renderActivityLog(); }
    function renderActivityLog() {
        document.getElementById('activityList').innerHTML = activityLog.length ? activityLog.map(a => `<div class="px-3 py-2 border-b border-gray-50 dark:border-gray-700 last:border-0"><p class="text-sm text-gray-900 dark:text-white">${escapeHtml(a.action)}</p>${a.details ? `<p class="text-xs text-gray-500">${escapeHtml(a.details)}</p>` : ''}<p class="text-xs text-gray-400 mt-1">${new Date(a.timestamp).toLocaleString()}</p></div>`).join('') : '<div class="p-4 text-center text-sm text-gray-500">No activity yet</div>';
    }

    // =====================================================
    // MISC MODALS
    // =====================================================
    function openShortcutsModal() { closeAllModals(); document.getElementById('shortcutsModal').classList.remove('hidden'); }
    function toggleUserMenu() { document.getElementById('userMenu').classList.toggle('hidden'); }

    // =====================================================
    // VIEW TOGGLE (LIST / GRID)
    // =====================================================
    let currentView = localStorage.getItem('winngoo_view') || 'grid';
    let cardCountryFilter = ''; 


    function switchView(view) {
        currentView = view;
        localStorage.setItem('winngoo_view', view);
        document.getElementById('viewListBtn').classList.toggle('active', view === 'list');
        document.getElementById('viewGridBtn').classList.toggle('active', view === 'grid');
        document.getElementById('projectTableContainer').classList.toggle('hidden', view !== 'list');
        document.getElementById('projectCardsContainer').classList.toggle('hidden', view !== 'grid');
        if (view === 'grid') renderCardView();
    }

    function renderCardView() {
        const filtered = getFilteredProjects();
        // Build country tabs
        const countries = {};
        filtered.forEach(p => {
            const code = p.country || 'OTHER';
            if (!countries[code]) countries[code] = 0;
            countries[code]++;
        });
        let tabsHtml = `<button onclick="filterCardsByCountry('')" class="country-tab ${cardCountryFilter === '' ? 'active' : ''}">All <span class="text-[10px] opacity-60">${filtered.length}</span></button>`;
        Object.entries(countries).sort((a, b) => b[1] - a[1]).forEach(([code, count]) => {
            const info = countryData[code] || { name: code, flag: '' };
            tabsHtml += `<button onclick="filterCardsByCountry('${code}')" class="country-tab ${cardCountryFilter === code ? 'active' : ''}">${info.flag} ${info.name} <span class="text-[10px] opacity-60">${count}</span></button>`;
        });
        document.getElementById('countryTabs').innerHTML = tabsHtml;

        // Filter by country tab
        const cardFiltered = cardCountryFilter ? filtered.filter(p => (p.country || 'OTHER') === cardCountryFilter) : filtered;

        // Render cards
        const cardsContainer = document.getElementById('projectCards');
        const emptyCards = document.getElementById('emptyStateCards');
        emptyCards.classList.toggle('hidden', cardFiltered.length > 0);

        cardsContainer.innerHTML = cardFiltered.map(p => {
            const faviconUrl = getFaviconUrl(p);
            const iconHtml = faviconUrl
                ? `<img src="${escapeHtml(faviconUrl)}" alt="" class="w-10 h-10 rounded-xl object-contain bg-gray-100 dark:bg-gray-700 p-1" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"><div class="w-10 h-10 ${getColorClass(p.color)} rounded-xl items-center justify-center text-white font-bold text-sm hidden">${escapeHtml(p.icon || p.name.charAt(0))}</div>`
                : `<div class="w-10 h-10 ${getColorClass(p.color)} rounded-xl flex items-center justify-center text-white font-bold text-sm">${escapeHtml(p.icon || p.name.charAt(0))}</div>`;

            const countryInfo = countryData[p.country] || (p.country ? { name: p.country, flag: '🌍' } : null);

            let urlChips = '';
            if (p.liveUrl) urlChips += `<a href="${escapeHtml(p.liveUrl)}" target="_blank" class="card-url-chip"><i class="fa-solid fa-globe text-[8px]"></i>Live</a>`;
            if (p.devUrl) urlChips += `<a href="${escapeHtml(p.devUrl)}" target="_blank" class="card-url-chip"><i class="fa-solid fa-code text-[8px]"></i>Dev</a>`;
            if (p.mobLiveUrl) urlChips += `<a href="${escapeHtml(p.mobLiveUrl)}" target="_blank" class="card-url-chip"><i class="fa-brands fa-android text-[8px]"></i>Android</a>`;
            if (p.iosLiveUrl) urlChips += `<a href="${escapeHtml(p.iosLiveUrl)}" target="_blank" class="card-url-chip"><i class="fa-brands fa-apple text-[8px]"></i>iOS</a>`;

            return `
            <div class="project-card" onclick="openViewModal('${p.id}')">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        ${iconHtml}
                        <div class="min-w-0">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm truncate">${escapeHtml(p.name)}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${escapeHtml(p.category)}${countryInfo ? ` • ${countryInfo.flag}` : ''}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 flex-shrink-0">
                        <button onclick="event.stopPropagation();toggleFavorite('${p.id}')" class="favorite-star ${p.favorite ? 'active' : 'text-gray-300 dark:text-gray-600'} text-xs"><i class="fa-${p.favorite ? 'solid' : 'regular'} fa-star"></i></button>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-medium ${getStatusClasses(p.status)}"><span class="status-dot ${getStatusDotClass(p.status)} mr-1 ${p.status === 'live' ? 'pulse-dot' : ''}"></span>${capitalizeFirst(p.status)}</span>
                    </div>
                </div>
                ${p.description ? `<p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mb-3">${escapeHtml(p.description)}</p>` : '<div class="mb-3"></div>'}
                ${urlChips ? `<div class="card-urls mb-3">${urlChips}</div>` : ''}
                <div class="flex items-center justify-between pt-2 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-1 text-[10px] text-gray-400">
                        <i class="fa-solid fa-key"></i>
                        <span>${p.credentials?.length || 0} credentials</span>
                    </div>
                    <div class="flex items-center gap-1 no-print" onclick="event.stopPropagation()">
                        <button onclick="openEditProjectModal('${p.id}')" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="Edit"><i class="fa-solid fa-pen text-gray-400 text-[10px]"></i></button>
                        <button onclick="duplicateProject('${p.id}')" class="p-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="Duplicate"><i class="fa-solid fa-copy text-gray-400 text-[10px]"></i></button>
                        <button onclick="openDeleteModal('project','${p.id}')" class="p-1 hover:bg-red-50 dark:hover:bg-red-900/20 rounded" title="Delete"><i class="fa-solid fa-trash text-gray-400 hover:text-red-500 text-[10px]"></i></button>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    function filterCardsByCountry(code) {
        cardCountryFilter = code;
        renderCardView();
    }

    // Override renderProjects to also update card view
    const _originalRenderProjects = renderProjects;
    renderProjects = function() {
        _originalRenderProjects();
        if (currentView === 'grid') renderCardView();
    };

    // =====================================================
    // KEYBOARD SHORTCUTS
    // =====================================================
    document.addEventListener('keydown', function(e) {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') { e.preventDefault(); openCommandPalette(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'n') { e.preventDefault(); openAddProjectModal(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'e') { e.preventDefault(); exportData(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'd') { e.preventDefault(); toggleDarkMode(); }
        if (e.key === 'Escape') closeAllModals();
    });

    // Close menus on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#userMenu') && !e.target.closest('[onclick*="toggleUserMenu"]')) document.getElementById('userMenu').classList.add('hidden');
        if (!e.target.closest('#activityPanel') && !e.target.closest('[onclick*="toggleActivityLog"]')) document.getElementById('activityPanel').classList.add('hidden');
    });

   
    // =====================================================
    // TEXT ANIMATION (optional utility)
    // =====================================================
    (function(){
        const animMap = {
            fadeIn: 'ta-fadeIn', blurIn: 'ta-blurIn', blurInUp: 'ta-blurInUp', blurInDown: 'ta-blurInDown',
            slideUp: 'ta-slideUp', slideDown: 'ta-slideDown', slideLeft: 'ta-slideLeft', slideRight: 'ta-slideRight',
            scaleUp: 'ta-scaleUp', scaleDown: 'ta-scaleDown'
        };
        function initTextAnimations() {
            document.querySelectorAll('[data-text-animate]').forEach(el => {
                if (el.dataset.taInit) return;
                el.dataset.taInit = 'true';
                const animType = el.dataset.textAnimate || 'fadeIn';
                const splitBy = el.dataset.animateBy || 'word';
                const baseDelay = parseFloat(el.dataset.animateDelay || '0');
                const stagger = parseFloat(el.dataset.animateStagger || '0.05');
                const duration = el.dataset.animateDuration || '0.6s';
                const animName = animMap[animType] || 'ta-fadeIn';
                const originalText = el.textContent;
                el.innerHTML = '';
                let segments = [];
                if (splitBy === 'char') { segments = originalText.split(''); }
                else if (splitBy === 'line') { segments = originalText.split('\n'); }
                else { segments = originalText.split(/(\s+)/); }
                segments.forEach((seg, i) => {
                    const span = document.createElement('span');
                    span.className = 'text-animate-segment' + (splitBy === 'line' ? ' line-segment' : '');
                    span.textContent = seg;
                    const segIndex = splitBy === 'word' ? Math.floor(i / 2) : i;
                    const delay = baseDelay + segIndex * stagger;
                    span.style.animationName = animName;
                    span.style.animationDuration = duration;
                    span.style.animationDelay = delay + 's';
                    span.style.animationFillMode = 'forwards';
                    span.style.animationTimingFunction = 'cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    span.classList.add('animated');
                    el.appendChild(span);
                });
            });
        }
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initTextAnimations);
        else initTextAnimations();
        const observer = new MutationObserver(() => initTextAnimations());
        observer.observe(document.body, { childList: true, subtree: true });
    })();
     // =====================================================
    // INIT ON LOAD
    // =====================================================
    document.addEventListener('DOMContentLoaded', function() {
        init();
    });

    </script>
    








    <script>
document.addEventListener('DOMContentLoaded', () => {
    const currentInput = document.getElementById('currentPassword');
    const newInput = document.getElementById('newPassword');
    const currentError = document.getElementById('currentPasswordError');
    const newError = document.getElementById('newPasswordError');

    // Hide current password error on type
    currentInput.addEventListener('input', () => {
        currentError.classList.add('hidden');
        currentError.textContent = '';
    });

    // Hide new password error on type
    newInput.addEventListener('input', () => {
        newError.classList.add('hidden');
        newError.textContent = '';
    });
});
        function changeMasterPassword() {
    const btn = event.currentTarget;
    const currentInput = document.getElementById('currentPassword');
    const newInput = document.getElementById('newPassword');
    const currentError = document.getElementById('currentPasswordError');
    const newError = document.getElementById('newPasswordError');
    const successMsg = document.getElementById('passwordSuccess');

    // 1. Reset states
    [currentError, newError, successMsg].forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });

    // 2. Simple Frontend Validation for Current Password
    if (!currentInput.value.trim()) {
        currentError.textContent = 'Current password is required';
        currentError.classList.remove('hidden');
        return;
    }

    // 3. STRONG PASSWORD VALIDATION
    const newPwdValue = newInput.value;
    // Regex: 1 Uppercase, 1 Lowercase, 1 Number, 1 Special Char, Min 8 chars
const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

if (!newPwdValue) {
    newError.textContent = 'New password is required';
    newError.classList.remove('hidden');
    return;
}


if (!strongPasswordRegex.test(newPwdValue)) {
    newError.textContent = 'Password needs 8+ chars, uppercase, lowercase, number, and symbol.';
    newError.classList.remove('hidden');
    return;
}
    // Disable button to prevent spam
    btn.disabled = true;
    btn.style.opacity = '0.5'; // Use .style.opacity for JS

    fetch('/admin/change-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            current_password: currentInput.value,
            new_password: newPwdValue
        })
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw data;
        return data;
    })
    .then(data => {
        // ✅ SUCCESS (Centered at top)
        successMsg.textContent = data.message || 'Password changed successfully';
        successMsg.classList.remove('hidden');

        currentInput.value = '';
        newInput.value = '';

        setTimeout(() => {
            successMsg.classList.add('hidden');
            successMsg.textContent = '';
        }, 2000); 
    })
    .catch(error => {
        if (error.errors) {
            if (error.errors.current_password) {
                currentError.textContent = error.errors.current_password[0];
                currentError.classList.remove('hidden');
            }
            if (error.errors.new_password) {
                newError.textContent = error.errors.new_password[0];
                newError.classList.remove('hidden');
            }
        } else if (error.message) {
            currentError.textContent = error.message;
            currentError.classList.remove('hidden');
        }
    })
    .finally(() => {
        btn.disabled = false;
        btn.style.opacity = '1';
    });
}

    </script>

<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>


</body>
</html>