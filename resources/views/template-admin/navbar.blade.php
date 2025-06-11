<ul class="metismenu" id="menu">
    <li class="menu-label">DASHBOARD</li>
    @if(Auth::user()->role == 'admin')
    <li>
        <a href="/dashboard-admin">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    <li>
        <a href="/profil-admin">
            <div class="parent-icon"><i class='bx bx-user'></i></div>
            <div class="menu-title">PROFIL</div>
        </a>
    </li>
   
    <li class="menu-label">AUGMENTED REALITY</li>
    <li>
        <a href="/augmented-reality">
            <div class="parent-icon"><i class='bx bx-cube'></i></div>
            <div class="menu-title">DATA AUGMENTED REALITY</div>
        </a>
    </li>
    <li class="menu-label">MATERI</li>
    <li>
        <a href="/materi">
            <div class="parent-icon"><i class='bx bx-book'></i></div>
            <div class="menu-title">DATA MATERI</div>
        </a>
    </li>
    <li class="menu-label">QUIZ</li>
    <li>
        <a href="/master-quiz">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">DATA QUIZ</div>
        </a>
    </li>
    @endif
</ul>
