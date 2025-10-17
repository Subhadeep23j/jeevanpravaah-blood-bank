{{-- Standalone Loader Component --}}
<div id="pageLoader" class="page-loader">
    <div class="loader-heart">
        <svg class="w-full h-full text-red-500" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
    </div>

    <div class="loader-progress">
        <div class="loader-progress-bar"></div>
    </div>

    <div class="loader-text">
        Loading JeevanPravaah<span class="loader-dots"></span>
    </div>

    {{-- Optional loading tips --}}
    <div class="loader-tips mt-6 text-center">
        <p class="text-sm text-gray-600 opacity-75">
            <span id="loadingTip">Did you know? One blood donation can save up to 3 lives.</span>
        </p>
    </div>
</div>

<style>
    /* Additional Loader Styles */
    .loader-tips {
        max-width: 300px;
        margin: 0 auto;
    }

    #loadingTip {
        animation: tipFade 3s ease-in-out infinite;
    }

    @keyframes tipFade {

        0%,
        100% {
            opacity: 0.75;
        }

        50% {
            opacity: 1;
        }
    }

    /* Enhanced loader animations */
    .loader-heart svg {
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.3));
    }

    /* Responsive loader */
    @media (max-width: 768px) {
        .loader-heart {
            width: 50px;
            height: 50px;
        }

        .loader-progress {
            width: 150px;
        }

        .loader-text {
            font-size: 1rem;
        }
    }
</style>

<script>
    // Loading tips rotation
    document.addEventListener('DOMContentLoaded', function() {
        const tips = [
            "Did you know? One blood donation can save up to 3 lives.",
            "Every 2 seconds someone needs blood in India.",
            "Donating blood burns around 650 calories.",
            "You can donate blood every 56 days.",
            "Blood cannot be manufactured - it can only come from donors.",
            "Type O- blood is the universal donor type.",
            "Platelets must be used within 5 days of donation."
        ];

        const tipElement = document.getElementById('loadingTip');
        let currentTipIndex = 0;

        function rotateTips() {
            if (tipElement) {
                tipElement.style.opacity = '0';
                setTimeout(() => {
                    currentTipIndex = (currentTipIndex + 1) % tips.length;
                    tipElement.textContent = tips[currentTipIndex];
                    tipElement.style.opacity = '0.75';
                }, 200);
            }
        }

        // Rotate tips every 2 seconds
        const tipInterval = setInterval(rotateTips, 2000);

        // Clear interval when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                clearInterval(tipInterval);
            }, 1500);
        });
    });
</script>
