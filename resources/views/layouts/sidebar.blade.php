<nav class="col-md-2 d-md-block bg-light sidebar" id="sidebar">
    <button class="btn btn-primary sidebar-toggle" type="button">
        <i class="bi bi-list"></i>
    </button>
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-2"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                    <i class="bi bi-people me-2"></i><span>Pegawai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('departments.index') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                    <i class="bi bi-building me-2"></i><span>Departemen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('positions.index') ? 'active' : '' }}" href="{{ route('positions.index') }}">
                    <i class="bi bi-briefcase me-2"></i><span>Jabatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i><span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
<style>
    .sidebar .nav-link.active {
        background-color: rgba(0, 123, 255, 0.1);
        color: #0d6efd;
        font-weight: bold;
    }
    .sidebar {
        transition: all 0.3s ease-in-out;
    }
    .sidebar-toggle {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1050;
        transition: transform 0.3s ease;
    }
    @media (max-width: 767px) {
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 250px;
            z-index: 1040;
        }
    }
    .sidebar.collapsed {
        width: 50px;
        overflow: hidden;
        position: relative;
    }
    .sidebar.collapsed .position-sticky {
        display: none;
    }
    .sidebar.collapsed .sidebar-toggle {
        position: absolute;
        top: 10px;
        right: 0;
        transform: rotate(180deg);
    }
    .sidebar.collapsed .sidebar-toggle i {
        font-size: 24px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = sidebar.querySelector('.sidebar-toggle');
        const sidebarLinks = sidebar.querySelectorAll('.nav-link');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            
            // Tambahkan efek hover hanya saat sidebar tidak dalam mode collapsed
            if (sidebar.classList.contains('collapsed')) {
                sidebarLinks.forEach(link => {
                    link.addEventListener('mouseenter', showTooltip);
                    link.addEventListener('mouseleave', removeTooltip);
                });
            } else {
                sidebarLinks.forEach(link => {
                    link.removeEventListener('mouseenter', showTooltip);
                    link.removeEventListener('mouseleave', removeTooltip);
                });
            }
        }

        function showTooltip(event) {
            // Hapus tooltip yang sudah ada
            document.querySelectorAll('.sidebar-tooltip').forEach(el => el.remove());
            
            if (sidebar.classList.contains('collapsed')) {
                const tooltip = document.createElement('div');
                tooltip.classList.add('sidebar-tooltip');
                tooltip.textContent = event.currentTarget.querySelector('span').textContent;
                tooltip.style.position = 'fixed';
                tooltip.style.backgroundColor = 'rgba(0,0,0,0.7)';
                tooltip.style.color = 'white';
                tooltip.style.padding = '5px 10px';
                tooltip.style.borderRadius = '3px';
                tooltip.style.zIndex = '1060';
                
                const rect = event.currentTarget.getBoundingClientRect();
                tooltip.style.left = `${rect.right + 10}px`;
                tooltip.style.top = `${rect.top}px`;
                
                document.body.appendChild(tooltip);
            }
        }

        function removeTooltip() {
            document.querySelectorAll('.sidebar-tooltip').forEach(el => el.remove());
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
    });
</script>