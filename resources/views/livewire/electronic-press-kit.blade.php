<div>
    <!-- Hero Section -->
    <livewire:epk.hero-section />

    <!-- Navigation Menu -->
    <livewire:epk.navigation-menu />

    <!-- Artist Overview Section -->
    <livewire:epk.artist-overview />

    <!-- Biography Section -->
    <livewire:epk.biography-section />

    <!-- Discography Section -->
    <livewire:epk.discography-section />

    <!-- Drum & Bass Project 2025 -->
    <livewire:epk.drum-bass-project />

    <!-- Media Assets Section -->
    <livewire:epk.media-assets />

    <!-- Contact & Booking Section -->
    <livewire:epk.contact-booking />

    <!-- Download Section -->
    <livewire:epk.download-section />

    <!-- Future Vision & Why Click -->
    <livewire:epk.future-vision />


    <!-- Smooth scroll script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>


</div>
