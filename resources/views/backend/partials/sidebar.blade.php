        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3>Admin Dashboard</h3>
            </div>

            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}">
                        <i class="fas fa-book"></i> Courses
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.lessons.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.lessons.index') }}">
                        <i class="fas fa-graduation-cap"></i> Lessons
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.enrollments.index') }}">
                        <i class="fas fa-user-check"></i> Enrollments
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}">
                        <i class="fas fa-credit-card"></i> Payments
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
            </ul>
        </nav>
