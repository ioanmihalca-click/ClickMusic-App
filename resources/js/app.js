import "./bootstrap";

// Parallax + estompare la scroll pentru hero-ul de pe homepage.
// Se scriu doar transform și opacity (compositor-only), throttled prin rAF.

const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

let heroSection = null;
let heroDim = null;
let heroHeight = 0;
let heroTicking = false;

function cacheHeroElements() {
    heroSection = document.querySelector(".home-parallax");
    heroDim = heroSection ? heroSection.querySelector(".scroll-dim") : null;
    // hero-ul e ascuns cât timp rulează spinner-ul, deci offsetHeight poate fi 0;
    // min-h-screen garantează că înălțimea reală e cel puțin cât viewport-ul
    heroHeight = heroSection ? heroSection.offsetHeight : 0;
}

function updateHeroEffects() {
    heroTicking = false;

    if (!heroSection || prefersReducedMotion.matches) {
        return;
    }

    const sectionHeight = heroHeight || window.innerHeight;
    const scrolled = Math.min(window.scrollY, sectionHeight);

    heroSection.style.transform = `translateY(${(scrolled * 0.7).toFixed(1)}px)`;

    if (heroDim) {
        heroDim.style.opacity = Math.min(
            scrolled / (sectionHeight * 0.6),
            1
        ).toFixed(3);
    }
}

function requestHeroUpdate() {
    if (!heroTicking) {
        heroTicking = true;
        requestAnimationFrame(updateHeroEffects);
    }
}

window.addEventListener("scroll", requestHeroUpdate, { passive: true });
window.addEventListener("resize", cacheHeroElements);

// după navigarea SPA referințele vechi devin noduri detașate
document.addEventListener("livewire:navigated", () => {
    cacheHeroElements();
    updateHeroEffects();
});

cacheHeroElements();
updateHeroEffects();

//Smooth scroll

document.querySelectorAll(".scroll-link").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
        });
    });
});
