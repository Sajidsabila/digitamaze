   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
           <div class="sidebar-brand-icon rotate-n-15">
               <i class="fas fa-laugh-wink"></i>
           </div>
           <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
       </a>

       <!-- Divider -->
       <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
           <a href="{{ route('dashboard') }}" class="nav-link">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span>
           </a>
       </li>

       <li
           class="nav-item {{ request()->routeIs('user') || request()->routeIs('student') || request()->routeIs('teacher') || request()->routeIs('kelas') ? 'active' : '' }}">
           <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
               aria-controls="collapsePages">
               <i class="fas fa-fw fa-folder"></i>
               <span>Master Data</span>
           </a>
           <div id="collapsePages"
               class="collapse {{ request()->routeIs('user') || request()->routeIs('student') || request()->routeIs('teacher') || request()->routeIs('kelas') ? 'show' : '' }}"
               aria-labelledby="headingPages" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                   <a class="collapse-item {{ request()->routeIs('user') ? 'active' : '' }}"
                       href="{{ route('user') }}">User</a>
                   <a class="collapse-item {{ request()->routeIs('teacher') ? 'active' : '' }}"
                       href="{{ route('teacher') }}">Guru</a>
                   <a class="collapse-item {{ request()->routeIs('kelas') ? 'active' : '' }}"
                       href="{{ route('kelas') }}">Kelas</a>
                   <a class="collapse-item {{ request()->routeIs('student') ? 'active' : '' }}"
                       href="{{ route('student') }}">Murid</a>
               </div>
           </div>
       </li>
       <li class="nav-item {{ request()->routeIs('list.student') ? 'active' : '' }}">
           <a href="{{ route('list.student') }}" class="nav-link">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>List Siswa</span>
           </a>
       </li>
       <li class="nav-item {{ request()->routeIs('list.teacher') ? 'active' : '' }}">
           <a href="{{ route('list.teacher') }}" class="nav-link">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>List Guru</span>
           </a>
       </li>
       <li class="nav-item {{ request()->routeIs('list.data') ? 'active' : '' }}">
           <a href="{{ route('list.data') }}" class="nav-link">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Data</span>
           </a>
       </li>
       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>

   </ul>
