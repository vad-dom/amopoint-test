(() => {
    const endpoint = 'http://localhost:8080/api/visits';

    const payload = {
        page_url: window.location.href,
        referer: document.referrer || null,
        screen: `${window.screen.width}x${window.screen.height}`,
        language: navigator.language || null,
    };

    fetch(endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(payload),
        keepalive: true,
    }).catch(() => {
        // Tracking should not affect the host page
    });
})();
