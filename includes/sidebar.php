        <!-- Sidebar -->
        <aside class="sidebar bg-dark text-white">
            <div class="sidebar-header p-3">
                <h3 class="h5 mb-0">Navigation</h3>
            </div>
            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tampiluser.php" class="nav-link <?php echo ($currentPage == 'users') ? 'active' : ''; ?>">
                            <i class="fas fa-users me-2"></i> User Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tampilabsensi.php" class="nav-link <?php echo ($currentPage == 'attendance') ? 'active' : ''; ?>">
                            <i class="fas fa-calendar-check me-2"></i> Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>