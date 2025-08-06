document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const body = document.body;
    const mobileBreakpoint = 768;

    function isMobileView() {
        return window.innerWidth <= mobileBreakpoint;
    }

    function initSidebar() {
        const savedState = localStorage.getItem('sidebarCollapsed');
        const shouldCollapse = savedState ? JSON.parse(savedState) : false;

        if (!isMobileView()) {
            body.classList.toggle('sidebar-collapsed', shouldCollapse);
            sidebarToggleBtn.setAttribute('aria-expanded', !shouldCollapse);
        } else {
            body.classList.remove('sidebar-collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', 'false');
        }

        updateSidebarState();
    }

    function toggleSidebar() {
        if (isMobileView()) {
            body.classList.toggle('sidebar-collapsed');
            sidebarOverlay.classList.toggle('active');
            sidebarToggleBtn.setAttribute('aria-expanded', body.classList.contains('sidebar-collapsed'));
        } else {
            const isCollapsed = body.classList.toggle('sidebar-collapsed');
            sidebarToggleBtn.setAttribute('aria-expanded', !isCollapsed);
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        }
    }

    function updateSidebarState() {
        if (isMobileView()) {
            body.classList.add('mobile-mode');
            body.classList.remove('sidebar-collapsed');
            sidebarOverlay.classList.remove('active');
        } else {
            body.classList.remove('mobile-mode');
        }
    }

    function closeSidebarOnLinkClick() {
        document.querySelectorAll('#sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (isMobileView()) {
                    body.classList.remove('sidebar-collapsed');
                    sidebarOverlay.classList.remove('active');
                    sidebarToggleBtn.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    sidebarOverlay.addEventListener('click', function() {
        if (isMobileView()) {
            body.classList.remove('sidebar-collapsed');
            sidebarOverlay.classList.remove('active');
            sidebarToggleBtn.setAttribute('aria-expanded', 'false');
        }
    });

    sidebarToggleBtn.addEventListener('click', toggleSidebar);
    window.addEventListener('resize', function() {
        updateSidebarState();
    });

    initSidebar();
    closeSidebarOnLinkClick();
});