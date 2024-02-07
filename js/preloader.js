document.addEventListener('DOMContentLoaded', function() {
    // Simulate loading time (replace with actual asynchronous loading)
    setTimeout(function() {
        // Hide the preloader with fade-out animation
        document.getElementById('preloader').style.opacity = '0';

        // Allow scrolling on the main content after the animation is complete
        setTimeout(function() {
            document.getElementById('preloader').style.pointerEvents = 'none';
            document.body.style.overflow = 'visible';
        }, 500); // Adjust the timeout value to match the transition duration
    }, 1000); // Adjust the timeout value as needed
});
