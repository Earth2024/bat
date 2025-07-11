<div>
    <button wire:click="initiateOAuth">Register with Deriv</button>

    <script>
        window.addEventListener('openOAuthPopup', event => {
            let popup = window.open(event.detail.url, "OAuth Register", "width=600,height=600");
            let timer = setInterval(() => {
                if (popup.closed) {
                    clearInterval(timer);
                    window.location.reload(); // Refresh after registration
                }
            }, 1000);
        });
    </script>
</div>
D