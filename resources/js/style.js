

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

document.addEventListener("DOMContentLoaded", () => {
    const passwordFields = [
        { id: "currentPassword" },
        { id: "newPassword" }
    ];

    passwordFields.forEach(({ id }) => {
        const input = document.getElementById(id);
        if (!input) return;

        // wrap input
        const wrapper = document.createElement("div");
        wrapper.className = "relative";

        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        // eye button
        const btn = document.createElement("button");
        btn.type = "button";
        btn.innerHTML = '<i class="fa-solid fa-eye"></i>';
        btn.className =
            "absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-800 dark:hover:text-white";

        btn.onclick = () => {
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            btn.innerHTML = isPassword
                ? '<i class="fa-solid fa-eye-slash"></i>'
                : '<i class="fa-solid fa-eye"></i>';
        };

        wrapper.appendChild(btn);
    });
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
    let masterPassword = 'admin@vrex';
    let projects = [];
    let trash = [];
    let selectedProjects = new Set();
    let deleteTarget = { type: null, projectId: null, credentialId: null };
    let currentViewProjectId = null;
    let activityLog = [];
    let filterState = { favorites: false, archived: false, tag: null };
    let isLocked = true;
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
        checkSession();
        
        // ✅ Fallback: if something fails, still show the page after 1 second
        setTimeout(() => {
            if (!document.body.classList.contains('app-ready')) {
                document.body.classList.add('app-ready');
                showLockScreen();
            }
        }, 1000);
    }

    function initApp() {
        applyDarkMode();
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
    // LOCK/UNLOCK VAULT
    // =====================================================
    function checkSession() {
        const session = localStorage.getItem('winngoo_session');
        if (session === 'unlocked') {
            isLocked = false;
            document.body.classList.add('app-ready'); // ✅ reveal body
            initApp();
        } else {
            document.body.classList.add('app-ready'); // ✅ reveal body (lock screen visible)
            showLockScreen();
        }
    }

    // function showLockScreen() { document.getElementById('lockScreen').classList.remove('hidden'); isLocked = true; setTimeout(() => document.getElementById('masterPasswordInput').focus(), 100); }
    // function unlockVault() {
    //     if (document.getElementById('masterPasswordInput').value === masterPassword) { document.getElementById('lockScreen').classList.add('hidden'); isLocked = false; localStorage.setItem('winngoo_session', 'unlocked'); initApp(); logActivity('Vault unlocked'); }
    //     else { showToast('Incorrect password', 'error'); document.getElementById('masterPasswordInput').value = ''; }
    // }
    // function lockVault() { localStorage.removeItem('winngoo_session'); showLockScreen(); document.getElementById('masterPasswordInput').value = ''; closeAllModals(); logActivity('Signed out'); }

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
                    <button onclick="archiveProject('${p.id}')" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded" title="Archive"><i class="fa-solid fa-box-archive text-gray-500 text-sm"></i></button>
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
    function archiveProject(id) { const p = projects.find(x => x.id === id); if (p) { p.archived = !p.archived; p.updatedAt = new Date().toISOString(); saveToStorage(); renderProjects(); updateStats(); showToast(p.archived ? 'Archived' : 'Unarchived'); logActivity(p.archived ? 'Archived' : 'Unarchived', p.name); } }

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

    function saveProject(e) {
        e.preventDefault(); const id = document.getElementById('projectId').value; const tagsInput = document.getElementById('projectTags').value; const tags = tagsInput ? tagsInput.split(',').map(t => t.trim().toLowerCase()).filter(t => t) : [];
        const data = { name: document.getElementById('projectName').value.trim(), category: document.getElementById('projectCategory').value, description: document.getElementById('projectDescription').value.trim(), logoUrl: document.getElementById('projectLogoUrl').value.trim(), country: document.getElementById('projectCountry').value, phone: document.getElementById('projectPhone').value.trim(), companyName: document.getElementById('projectCompanyName').value.trim(), address: document.getElementById('projectAddress').value.trim(), devUrl: document.getElementById('projectDevUrl').value.trim(), liveUrl: document.getElementById('projectLiveUrl').value.trim(), mobLiveUrl: document.getElementById('mobLiveUrl').value.trim(), iosLiveUrl: document.getElementById('iosLiveUrl').value.trim(), status: document.getElementById('projectStatus').value, icon: document.getElementById('projectIcon').value.trim().toUpperCase() || document.getElementById('projectName').value.charAt(0).toUpperCase(), color: document.getElementById('projectColor').value, tags, notes: document.getElementById('projectNotes').value.trim(), favorite: document.getElementById('projectFavorite').checked, updatedAt: new Date().toISOString() };
        if (id) { const idx = projects.findIndex(p => p.id === id); if (idx !== -1) { projects[idx] = { ...projects[idx], ...data }; showToast('Project updated'); logActivity('Updated', data.name); } }
        else { projects.push({ id: generateId(), ...data, archived: false, createdAt: new Date().toISOString(), credentials: [] }); showToast('Project created'); logActivity('Created', data.name); }
        saveToStorage(); renderProjects(); renderTags(); updateStats(); closeModal('projectModal');
    }

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

    function togglePwd(elId, pwd) { const el = document.getElementById(elId); el.textContent = el.textContent === '••••••••' ? pwd : '••••••••'; }

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
        const data = JSON.stringify({ projects, exportDate: new Date().toISOString(), version: '2.0' }, null, 2);
        const blob = new Blob([data], { type: 'application/json' });
        const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download = `winngoo-backup-${new Date().toISOString().split('T')[0]}.json`; a.click();
        showToast('Data exported'); logActivity('Exported data');
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
    function changeMasterPassword() {
        const current = document.getElementById('currentPassword').value; const newPwd = document.getElementById('newPassword').value;
        if (current !== masterPassword) { showToast('Current password incorrect', 'error'); return; }
        if (newPwd.length < 4) { showToast('Password too short', 'error'); return; }
        masterPassword = newPwd; document.getElementById('currentPassword').value = ''; document.getElementById('newPassword').value = ''; showToast('Password changed'); logActivity('Changed master password');
    }

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
                { icon: 'fa-lock', label: 'Lock Vault', action: 'lockVault();closeCommandPalette()' },
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
        if (isLocked) return;
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') { e.preventDefault(); openCommandPalette(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'n') { e.preventDefault(); openAddProjectModal(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'e') { e.preventDefault(); exportData(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'd') { e.preventDefault(); toggleDarkMode(); }
        if ((e.metaKey || e.ctrlKey) && e.key === 'l') { e.preventDefault(); lockVault(); }
        if (e.key === 'Escape') closeAllModals();
    });

    // Close menus on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#userMenu') && !e.target.closest('[onclick*="toggleUserMenu"]')) document.getElementById('userMenu').classList.add('hidden');
        if (!e.target.closest('#activityPanel') && !e.target.closest('[onclick*="toggleActivityLog"]')) document.getElementById('activityPanel').classList.add('hidden');
    });

    // =====================================================
    // INIT ON LOAD
    // =====================================================
    document.addEventListener('DOMContentLoaded', function() {
        init();
        // Apply saved view preference
        if (currentView === 'grid') {
            switchView('grid');
        }
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
