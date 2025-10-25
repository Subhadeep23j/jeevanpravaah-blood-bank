@php
    $success = session('success');
    $error = session('error') ?? ($errors->any() ? $errors->first() : null);
@endphp

<style>
    /* Keep toast below the fixed navbar */
    .swal2-container.swal2-top-end {
        top: 72px !important;
    }

    @media (max-width: 640px) {
        .swal2-container.swal2-top-end {
            top: 64px !important;
        }
    }

    .swal2-popup.swal2-toast {
        font-size: 0.9rem;
        padding: 0.6rem 0.8rem;
        border-radius: 10px;
    }
</style>

<script>
    (function initSweetAlerts() {
        function init() {
            // Helper: show any pending flash alerts as small toasts top-right
            function showFlashAlerts() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    width: 300
                });

                @if ($success)
                    Toast.fire({
                        icon: 'success',
                        title: @json($success)
                    });
                @endif

                @if ($error)
                    Toast.fire({
                        icon: 'error',
                        title: @json($error)
                    });
                @endif
            }

            // Defer alerts until the global loader is hidden to avoid overlay conflicts
            const loader = document.getElementById('pageLoader');
            const isLoaderHidden = !loader || loader.classList.contains('hidden');
            if (isLoaderHidden) {
                showFlashAlerts();
            } else {
                const once = () => {
                    window.removeEventListener('jp:loader:hidden', once);
                    setTimeout(showFlashAlerts, 50);
                };
                window.addEventListener('jp:loader:hidden', once);
            }

            // data-confirm support on forms and links
            document.querySelectorAll('[data-confirm]').forEach(function(el) {
                const message = el.getAttribute('data-confirm');
                if (!message) return;

                if (el.tagName === 'FORM') {
                    el.addEventListener('submit', function(e) {
                        if (el.dataset.confirmed === 'true') return; // already confirmed
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Are you sure?',
                            text: message,
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Yes, continue'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                el.dataset.confirmed = 'true';
                                el.submit();
                            }
                        });
                    });
                } else {
                    el.addEventListener('click', function(e) {
                        e.preventDefault();
                        const href = el.getAttribute('href');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Are you sure?',
                            text: message,
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Yes, continue'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (href) window.location.href = href;
                            }
                        });
                    });
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
