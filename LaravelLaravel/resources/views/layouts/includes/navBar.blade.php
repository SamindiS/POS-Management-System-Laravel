<nav class="navbar navbar-industrial">
    <div class="container-fluid">
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#industrialNavbar">
            <i class="fa fa-bars"></i>
        </button>
        
        <!-- Brand Logo/Name -->
        <a class="navbar-brand" href="#">
            <i class="fa fa-industry"></i> CONSTRUCTION22 POS
        </a>
        
        <!-- Search Bar (Visible on Desktop) -->
        <div class="d-none d-lg-block search-container">
            <div class="search-box">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search...">
                <div class="search-dropdown">
                    <button class="search-filter active" data-filter="all">All</button>
                    <button class="search-filter" data-filter="products">Products</button>
                    <button class="search-filter" data-filter="customers">Customers</button>
                </div>
            </div>
        </div>
        
        <!-- User Profile & Notifications -->
        <div class="user-actions">
            <button class="btn-notification" id="notificationBtn">
                <i class="fa fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <div class="user-dropdown">
                <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                <span class="user-name">Admin</span>
                <i class="fa fa-caret-down"></i>
                <div class="dropdown-menu">
                    <a href="#"><i class="fa fa-user"></i> Profile</a>
                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                    <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        
        <!-- Main Navigation (Collapsible) -->
        <div class="collapse navbar-collapse" id="industrialNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                        <div class="nav-tooltip">Manage system users</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="fa fa-box"></i>
                        <span>Products</span>
                        <div class="nav-tooltip">View and manage inventory</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link active">
                        <i class="fa fa-laptop"></i>
                        <span>Cashier</span>
                        <div class="nav-tooltip">Process sales transactions</div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="reportsDropdown">
                        <i class="fa fa-file"></i>
                        <span>Reports</span>
                        <i class="fa fa-caret-down"></i>
                        <div class="nav-tooltip">View system reports</div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Sales Reports</a>
                        <a class="dropdown-item" href="#">Inventory Reports</a>
                        <a class="dropdown-item" href="#">Financial Reports</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-money-bill"></i>
                        <span>Transactions</span>
                        <div class="nav-tooltip">View transaction history</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-truck"></i>
                        <span>Suppliers</span>
                        <div class="nav-tooltip">Manage suppliers</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-users"></i>
                        <span>Customers</span>
                        <div class="nav-tooltip">Manage customer database</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-arrow-down"></i>
                        <span>Incoming</span>
                        <div class="nav-tooltip">Manage incoming stock</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Base Styles */
    :root {
        --industrial-primary: #1a5276;
        --industrial-secondary: #2980b9;
        --industrial-accent: #c0392b;
        --industrial-light: #ecf0f1;
        --industrial-dark: #2c3e50;
        --industrial-success: #27ae60;
    }
    
    /* Navbar Container */
    .navbar-industrial {
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 0.5rem 1rem;
        position: relative;
        z-index: 1000;
    }
    
    .container-fluid {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }
    
    /* Brand Styles */
    .navbar-brand {
        font-weight: 700;
        color: var(--industrial-primary);
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        margin-right: 2rem;
    }
    
    .navbar-brand i {
        margin-right: 0.5rem;
        font-size: 1.5rem;
    }
    
    /* Toggle Button */
    .navbar-toggler {
        border: 2px solid var(--industrial-primary);
        border-radius: 50px;
        padding: 0.5rem 1rem;
        color: var(--industrial-primary);
        background: transparent;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }
    
    .navbar-toggler:hover {
        background-color: var(--industrial-primary);
        color: white;
    }
    
    /* Navigation Links */
    .navbar-nav {
        display: flex;
        flex-direction: row;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        flex-wrap: wrap;
    }
    
    .nav-item {
        position: relative;
        margin: 0 0.5rem;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.25rem;
        border: 2px solid var(--industrial-primary);
        background-color: transparent;
        color: var(--industrial-primary);
        font-weight: 600;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 0.875rem;
        text-decoration: none;
        position: relative;
    }
    
    .nav-link i {
        margin-right: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .nav-link:hover {
        background-color: var(--industrial-primary);
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .nav-link:hover i {
        transform: translateX(5px);
    }
    
    .nav-link.active {
        background-color: var(--industrial-accent);
        color: white;
        border-color: var(--industrial-accent);
    }
    
    /* Tooltips */
    .nav-tooltip {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--industrial-dark);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: normal;
        text-transform: none;
        letter-spacing: normal;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 100;
        pointer-events: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    
    .nav-tooltip:before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-width: 6px;
        border-style: solid;
        border-color: transparent transparent var(--industrial-dark) transparent;
    }
    
    .nav-link:hover .nav-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(10px);
    }
    
    /* Dropdown Menus */
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 0.875rem;
        color: var(--industrial-dark);
        text-align: left;
        list-style: none;
        background-color: white;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .dropdown-menu a {
        display: block;
        padding: 0.5rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: var(--industrial-dark);
        text-decoration: none;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    
    .dropdown-menu a:hover {
        background-color: var(--industrial-light);
        color: var(--industrial-primary);
    }
    
    .dropdown-menu a i {
        margin-right: 0.75rem;
        width: 1rem;
        text-align: center;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
    
    .dropdown-toggle i.fa-caret-down {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }
    
    .nav-item.dropdown:hover .dropdown-toggle i.fa-caret-down {
        transform: rotate(180deg);
    }
    
    /* Search Bar */
    .search-container {
        flex-grow: 1;
        max-width: 400px;
        margin: 0 2rem;
    }
    
    .search-box {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        color: var(--industrial-primary);
    }
    
    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 2px solid var(--industrial-primary);
        border-radius: 50px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .search-box input:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(26, 82, 118, 0.2);
        border-color: var(--industrial-secondary);
    }
    
    .search-dropdown {
        position: absolute;
        right: 0.5rem;
        display: flex;
        gap: 0.25rem;
    }
    
    .search-filter {
        background-color: var(--industrial-light);
        border: none;
        border-radius: 50px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .search-filter:hover {
        background-color: var(--industrial-primary);
        color: white;
    }
    
    .search-filter.active {
        background-color: var(--industrial-primary);
        color: white;
    }
    
    /* User Actions */
    .user-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .btn-notification {
        position: relative;
        background: none;
        border: none;
        color: var(--industrial-primary);
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
    }
    
    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: var(--industrial-accent);
        color: white;
        border-radius: 50%;
        width: 1.25rem;
        height: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: bold;
    }
    
    .user-dropdown {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .user-dropdown:hover {
        background-color: var(--industrial-light);
    }
    
    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 0.75rem;
        border: 2px solid var(--industrial-primary);
    }
    
    .user-name {
        font-weight: 600;
        color: var(--industrial-dark);
        margin-right: 0.5rem;
    }
    
    .user-dropdown .dropdown-menu {
        right: 0;
        left: auto;
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
        .search-container {
            order: 3;
            width: 100%;
            max-width: none;
            margin: 1rem 0;
        }
        
        .navbar-nav {
            flex-direction: column;
            width: 100%;
        }
        
        .nav-item {
            margin: 0.25rem 0;
            width: 100%;
        }
        
        .nav-link {
            justify-content: center;
        }
        
        .user-actions {
            margin-left: auto;
        }
    }
    
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1rem;
        }
        
        .user-name {
            display: none;
        }
    }
</style>

<script>
    // Add active class to current page link
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
        
        // User dropdown functionality
        const userDropdown = document.querySelector('.user-dropdown');
        if (userDropdown) {
            userDropdown.addEventListener('click', function() {
                const menu = this.querySelector('.dropdown-menu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
        }
        
        // Notification button functionality
        const notificationBtn = document.getElementById('notificationBtn');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                // This would typically open a notifications panel
                alert('Notifications panel would open here');
            });
        }
    });
    
    // Close dropdowns when clicking outside
    window.addEventListener('click', function(e) {
        if (!e.target.matches('.user-dropdown, .user-dropdown *')) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            });
        }
    });
</script>