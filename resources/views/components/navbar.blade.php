{{-- resources/views/components/navbar.blade.php --}}
<nav class="navbar-custom">
    <div class="navbar-container">
        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="navbar-logo">
            <span class="logo-icon">🌴</span>
            <span class="logo-text">Elixir Of Life</span>
        </a>

        {{-- Menu Toggle untuk Mobile --}}
        <button class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Navigation Links --}}
        <div class="navbar-menu" id="navbarMenu">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('pengelolaan') }}" class="nav-link {{ request()->routeIs('pengelolaan*') ? 'active' : '' }}">
                Pengelolaan
            </a>
            
            {{-- Conditional Menu berdasarkan login status --}}
            @if(request()->query('username'))
                <a href="{{ route('profile', ['username' => request()->query('username')]) }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    Profile
                </a>
                <a href="{{ route('logout') }}" class="nav-link nav-link-logout">
                    Logout
                </a>
            @else
                <a href="{{ route('login') }}" class="nav-link nav-link-login {{ request()->routeIs('login') ? 'active' : '' }}">
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>

<style>
    .navbar-custom {
        background: linear-gradient(135deg, 
            rgba(0, 77, 64, 0.95) 0%,
            rgba(0, 105, 92, 0.95) 50%,
            rgba(0, 150, 136, 0.95) 100%
        );
        backdrop-filter: blur(10px);
        border-bottom: 2px solid rgba(129, 199, 132, 0.3);
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 77, 64, 0.4);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar-logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-shadow: 0 2px 10px rgba(129, 199, 132, 0.5);
    }

    .logo-icon {
        font-size: 2rem;
        filter: drop-shadow(0 0 10px rgba(129, 199, 132, 0.8));
        animation: sway 3s ease-in-out infinite;
    }

    @keyframes sway {
        0%, 100% { transform: rotate(-5deg); }
        50% { transform: rotate(5deg); }
    }

    .logo-text {
        background: linear-gradient(135deg, #81C784 0%, #66BB6A 50%, #4CAF50 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .navbar-logo:hover {
        transform: scale(1.05);
    }

    .navbar-logo:hover .logo-icon {
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0) rotate(-5deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }

    .navbar-menu {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        position: relative;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(129, 199, 132, 0.2);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .nav-link::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 25px;
        padding: 2px;
        background: linear-gradient(135deg, #81C784, #66BB6A, #4CAF50);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-link:hover {
        color: #fff;
        background: rgba(129, 199, 132, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(129, 199, 132, 0.4);
        border-color: rgba(129, 199, 132, 0.5);
    }

    .nav-link:hover::before {
        opacity: 1;
    }

    .nav-link.active {
        color: #fff;
        background: linear-gradient(135deg, rgba(129, 199, 132, 0.3), rgba(102, 187, 106, 0.3));
        border-color: rgba(129, 199, 132, 0.6);
        box-shadow: 0 0 20px rgba(129, 199, 132, 0.5);
    }

    .nav-link-login {
        background: linear-gradient(135deg, #81C784 0%, #66BB6A 50%, #4CAF50 100%);
        color: #fff;
        border: none;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(129, 199, 132, 0.4);
    }

    .nav-link-login::before {
        display: none;
    }

    .nav-link-login:hover {
        background: linear-gradient(135deg, #66BB6A 0%, #4CAF50 50%, #388E3C 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(129, 199, 132, 0.6);
    }

    .nav-link-logout {
        background: linear-gradient(135deg, rgba(255, 87, 34, 0.3), rgba(244, 67, 54, 0.3));
        color: #FFB74D;
        border-color: rgba(255, 152, 0, 0.4);
    }

    .nav-link-logout:hover {
        background: linear-gradient(135deg, rgba(255, 87, 34, 0.5), rgba(244, 67, 54, 0.5));
        color: #fff;
        border-color: rgba(255, 152, 0, 0.6);
        box-shadow: 0 5px 20px rgba(255, 87, 34, 0.4);
    }

    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .menu-toggle span {
        width: 25px;
        height: 3px;
        background: linear-gradient(90deg, #81C784, #66BB6A);
        border-radius: 3px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(129, 199, 132, 0.3);
    }

    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .menu-toggle {
            display: flex;
        }

        .navbar-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, 
                rgba(0, 77, 64, 0.98) 0%,
                rgba(0, 105, 92, 0.98) 100%
            );
            flex-direction: column;
            gap: 0.5rem;
            padding: 1.5rem;
            border-top: 2px solid rgba(129, 199, 132, 0.3);
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 77, 64, 0.5);
        }

        .navbar-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }

        .nav-link {
            width: 100%;
            text-align: center;
            padding: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('active');
                navbarMenu.classList.toggle('active');
            });
        }

        // Close menu saat klik di luar
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !navbarMenu.contains(event.target)) {
                menuToggle.classList.remove('active');
                navbarMenu.classList.remove('active');
            }
        });
    });
</script>