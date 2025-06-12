<!-- Cookie Consent Banner -->
<div x-data="cookieConsent()" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-full"
    class="fixed inset-0 flex items-center justify-center p-4 duration-300 ease-out" x-cloak>
    <div class="w-full max-w-md p-6 mx-auto bg-white border shadow-lg rounded-xl">
        <div class="flex flex-col items-center text-center text-neutral-600">
            <img src="https://cdn-icons-png.flaticon.com/512/9004/9004938.png" class="w-16 h-16 mb-4" alt="Cookie Icon">
            <h4 class="mb-2 text-xl font-bold text-neutral-900">Notificare privind cookie-urile</h4>
            <p class="mb-6 text-sm">Folosim cookie-uri pentru a îmbunătăți experiența ta online. Continuând
                navigarea, ești de acord cu utilizarea cookie-urilor pentru îmbunătățirea experienței tale pe site.
            </p>
        </div>
        <div class="flex justify-center space-x-3">
            <button @click="denyCookies()"
                class="px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border-2 rounded-md text-neutral-600 hover:text-neutral-700 border-neutral-950 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                Refuz
            </button>
            <button @click="acceptCookies()"
                class="px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 border-2 rounded-md bg-neutral-950 border-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                Accept
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cookieConsent', () => ({
            bannerVisible: false,

            init() {
                if (!this.hasUserConsented()) {
                    setTimeout(() => {
                        this.bannerVisible = true;
                    }, 300);
                }
            },

            acceptCookies() {
                this.setUserConsent(true);
                this.bannerVisible = false;
            },

            denyCookies() {
                this.setUserConsent(false);
                this.bannerVisible = false;
            },

            hasUserConsented() {
                return localStorage.getItem('cookieConsent') !== null;
            },

            setUserConsent(consent) {
                localStorage.setItem('cookieConsent', consent ? 'true' : 'false');
                // Set a cookie for server-side consent checking
                document.cookie =
                    `cookieConsent=${consent}; max-age=${60*60*24*365}; path=/; SameSite=Lax`;
            },

            getUserConsent() {
                return localStorage.getItem('cookieConsent') === 'true';
            }
        }));
    });
</script>
