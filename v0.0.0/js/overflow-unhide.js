document.getElementById('company-logo').addEventListener('click', function() {
    // Show loading overlay
    document.getElementById('loading-overlay').style.display = 'flex';

    // Simulate loading time (replace with actual asynchronous loading)
    setTimeout(function() {
        // Hide logo section
        document.getElementById('logo-section').style.display = 'none';

        // Show the rest of the content
        document.getElementById('content-section').classList.remove('hidden');
        
        // Hide loading overlay
        document.getElementById('loading-overlay').style.display = 'none';

        // Navigate to login.html
        window.location.href = 'login.html';
    }, 2000); // Adjust the timeout value as needed
});
