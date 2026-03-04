<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winngoo - Login</title>
    <link rel="icon" type="image/png" href="https://vishakarex.in/assets/img/vishaka-fav.webp">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { primary: '#000000', secondary: '#374151', accent: '#6b7280' } } }
        }
    </script>
    <style>
        .btn-primary { background: black; color: white; transition: all 0.2s; }
        .btn-primary:hover { opacity: 0.9; }
        .dark .btn-primary { background: white; color: black; }
        .elegant-shadow { box-shadow: 0 1px 3px rgba(0,0,0,.1), 0 1px 2px rgba(0,0,0,.06); }
        .text-animate-segment { display: inline-block; opacity: 0; }
        .text-animate-segment.animated { opacity: 0; margin-left: 1px;}
        @keyframes ta-fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes ta-blurInUp { from { opacity: 0; filter: blur(4px); transform: translateY(8px); } to { opacity: 1; filter: blur(0); transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors">

    <!-- Lock Screen (Always Visible) -->
    <div class="min-h-screen flex items-center justify-center p-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-sm w-full elegant-shadow text-center">
            <div class="w-30 h-30 dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <img src="https://winngoocrm.com/user-uploads/app-logo/bae4a0709276cc863aee3d0f9598400a.png" alt="">
            </div>
            <h2 data-text-animate="blurInUp" data-animate-by="word" class="text-xl font-bold text-gray-900 dark:text-white mb-1">Winngoo Projects Vault</h2>
            <p data-text-animate="fadeIn" data-animate-by="word" data-animate-delay="0.2" class="text-gray-500 dark:text-gray-400 text-sm mb-4">Enter master password to access</p>
            
            <!-- Error Message -->
            {{-- <div id="errorMsg" class="hidden mb-3 p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm rounded-lg">
                Incorrect password. Please try again.
            </div> --}}

            <!-- Password Input with Eye Toggle -->
            {{-- <div class="relative mb-4">
                <input type="password" id="masterPasswordInput" placeholder="Master Password" 
                    class="w-full px-4 py-3 pr-12 border border-gray-200 dark:border-gray-600 rounded-xl text-center bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all"
                    onkeydown="if(event.key==='Enter')unlockVault()">
                <button type="button" id="togglePassword" onclick="togglePasswordVisibility()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200"
                        title="Toggle password visibility">
                    <svg id="eyeOpen" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg id="eyeClosed" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div> --}}
<form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf

    <div class="relative mb-4">
        <input type="password" name="password" id="masterPasswordInput" placeholder="Master Password"
            class="w-full px-4 py-3 pr-12 border border-gray-200 dark:border-gray-600 rounded-xl text-center bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all"
            onkeydown="if(event.key==='Enter') this.form.submit()"  oninput="hideError()">

        <button type="button" id="togglePassword" onclick="togglePasswordVisibility()"
                class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200"
                title="Toggle password visibility">
            <svg id="eyeOpen" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <svg id="eyeClosed" class="w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>
        </button>
    </div>

    @error('password')
        <div id="errorMsg" class="mb-3 p-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm rounded-lg">
            {{ $message }}
        </div>
    @enderror

    {{-- <button type="submit" class="w-full btn-primary py-3 rounded-xl font-medium">Unlock</button> --}}

    <button type="submit" id="unlockBtn" class="w-full btn-primary py-3 rounded-xl font-medium">
    Unlock
</button>
</form>
            {{-- <button onclick="unlockVault()" class="w-full btn-primary py-3 rounded-xl font-medium">Unlock</button> --}}
        </div>
    </div>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full border-t border-gray-200 dark:border-gray-700 py-4">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-center gap-2 text-xs text-gray-500">
            <span>Copyright &copy; <span id="year"></span> Vishakarex | All rights reserved</span>
            <script>document.getElementById("year").textContent = new Date().getFullYear();</script>
        </div>
    </footer>

    
    <script>


    function hideError() {
        const errorMsg = document.getElementById('errorMsg');
        if (errorMsg) errorMsg.classList.add('hidden');
    }




        // =====================================================
        // PASSWORD MANAGEMENT
        // =====================================================
        function getMasterPassword() {
            return localStorage.getItem('winngoo_master_pwd') || 'admin@vrex';
        }

        // =====================================================
        // CHECK IF ALREADY LOGGED IN
        // =====================================================
        (function() {
            const session = localStorage.getItem('winngoo_session');
            // if (session === 'unlocked') {
            //     window.location.href = 'dashboard.html';
            // }
            // Apply dark mode if saved
            const data = localStorage.getItem('winngoo_data');
            if (data) {
                try {
                    const parsed = JSON.parse(data);
                    if (parsed.settings && parsed.settings.darkMode) {
                        document.documentElement.classList.add('dark');
                    }
                } catch(e) {}
            }
            // Auto-focus password input
            setTimeout(() => document.getElementById('masterPasswordInput').focus(), 100);
        })();

        // =====================================================
        // UNLOCK VAULT
        // =====================================================
        function unlockVault() {
            const input = document.getElementById('masterPasswordInput');
            const errorMsg = document.getElementById('errorMsg');
            
            if (input.value === getMasterPassword()) {
                localStorage.setItem('winngoo_session', 'unlocked');
                window.location.href = 'dashboard.html';
            } else {
                errorMsg.classList.remove('hidden');
                input.value = '';
                input.focus();
                // Shake animation
                input.style.animation = 'shake 0.4s ease';
                setTimeout(() => input.style.animation = '', 500);
            }
        }

        // =====================================================
        // PASSWORD VISIBILITY TOGGLE
        // =====================================================
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('masterPasswordInput');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            const toggleBtn = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
                toggleBtn.title = 'Hide password';
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
                toggleBtn.title = 'Show password';
            }
            passwordInput.focus();
        }

        // Ctrl/Cmd + Shift + H to toggle visibility
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'H') {
                e.preventDefault();
                togglePasswordVisibility();
            }
        });

        // =====================================================
        // TEXT ANIMATION
        // =====================================================
        (function(){
            const animMap = {
                fadeIn: 'ta-fadeIn', blurInUp: 'ta-blurInUp'
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
                    let segments = splitBy === 'char' ? originalText.split('') : originalText.split(/(\s+)/);
                    segments.forEach((seg, i) => {
                        const span = document.createElement('span');
                        span.className = 'text-animate-segment';
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
        })();
    </script>
<script>
document.querySelector('form').addEventListener('submit', function() {
    const btn = document.getElementById('unlockBtn');
    btn.disabled = true;
    btn.innerText = 'Please wait...';
});
</script>
    <style>
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    </style>
</body>
</html>