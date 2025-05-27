document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh every 10 seconds
    const refreshInterval = 10000;
    let isPageVisible = true;

    // Pause refresh when tab is inactive
    document.addEventListener('visibilitychange', () => {
        isPageVisible = !document.hidden;
    });

    function refreshScoreboard() {
        if (!isPageVisible) return;

        fetch(window.location.href, {
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Cache-Control': 'no-cache'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newTable = newDoc.querySelector('table');
            
            if (newTable) {
                // Highlight updated rows
                const oldRows = document.querySelectorAll('tbody tr');
                const newRows = newTable.querySelectorAll('tbody tr');
                
                newRows.forEach((newRow, i) => {
                    if (oldRows[i] && oldRows[i].textContent !== newRow.textContent) {
                        newRow.classList.add('updated');
                    }
                });
                
                document.querySelector('table').replaceWith(newTable);
            }
        })
        .catch(error => console.error('Refresh failed:', error));
    }

    setInterval(refreshInterval);
});