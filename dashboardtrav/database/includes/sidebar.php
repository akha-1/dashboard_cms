        <aside class="sidebar">
            <div class="sidebar-header">
                Admin Page
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link<?= $activeModule ? '' : ' active' ?>" onclick="showDashboard()">
                        <i>📊</i> Dashboard
                    </a>
                <li class="nav-item">
                    <a href="#" class="nav-link<?= $activeModule ? ' active' : '' ?>" onclick="showCompanyModule()">
                        <i>🏢</i> Company
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="logout(); return false;">
                        <i>🚪</i> Log Out
                    </a>
                </li>
            </ul>
        </aside>
