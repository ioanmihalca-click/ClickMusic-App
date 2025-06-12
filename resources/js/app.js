import "./bootstrap";

//Parallax effect

function effectsHomeSection() {
    const homeSection = document.querySelector(".home-parallax, .home-fade");

    if (homeSection) {
        const homeSHeight = homeSection.offsetHeight;
        const topScroll = window.scrollY;

        if (topScroll <= homeSHeight) {
            if (homeSection.classList.contains("home-parallax")) {
                homeSection.style.transform = `translateY(${
                    topScroll * 0.7
                }px)`;
            }

            if (homeSection.classList.contains("home-fade")) {
                const caption = homeSection.querySelector(".caption-content");
                if (caption) {
                    caption.style.opacity = 1 - topScroll / homeSHeight;
                }
            }

            // Adaug efect de blur la scroll
            const blurAmount = Math.min(topScroll / 200, 10); // Limitez la max 10px blur
            homeSection.style.filter = `blur(${blurAmount}px)`;
        }
    }
}

// Call the function on scroll and initial load
window.addEventListener("scroll", effectsHomeSection);
effectsHomeSection();

//Smooth scroll

document.querySelectorAll(".scroll-link").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
        });
    });
});
