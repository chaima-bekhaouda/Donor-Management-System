// Add an event listener for click events on the document
document.addEventListener('click', (event) => {
    // Check if the clicked element is the HTML document itself
    if (event.target.tagName.toLowerCase() === 'html') {
        // Calculate the x and y coordinates of the click event relative to the window size
        const x = event.clientX / window.innerWidth;
        const y = event.clientY / window.innerHeight;

        // Define the number of confetti particles
        const confettiCount = 300;
        // Define the default properties for the confetti particles
        const defaults = {
            origin: {x: x, y: y}
        };

        // Define a function to fire the confetti particles
        function fire(particleRatio, opts) {
            // Merge the default properties, custom options, and particle count into a single object
            confetti(Object.assign({}, defaults, opts, {
                particleCount: Math.floor(confettiCount * particleRatio)
            }));
        }

        // Fire confetti particles with different properties
        fire(0.25, {
            spread: 26,
            startVelocity: 55,
        });
        fire(0.2, {
            spread: 60,
        });
        fire(0.35, {
            spread: 100,
            decay: 0.91,
        });
        fire(0.1, {
            spread: 120,
            startVelocity: 25,
            decay: 0.92,
        });
        fire(0.1, {
            spread: 120,
            startVelocity: 45,
        });
    }
});

// Immediately invoked function expression (IIFE) to load the confetti library
(function () {
    // Create a new script element
    const script = document.createElement('script');
    // Set the source of the script to the confetti library
    script.src = 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js';
    // Set the script to load asynchronously
    script.async = true;
    // Append the script to the head of the document
    document.head.appendChild(script);
})();
