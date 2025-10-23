<footer class="footer-custom">
    <div class="footer-container">
        <div class="footer-logo">
            <span class="logo-icon">🌴</span>
            <span class="logo-text">Elixir Of Life</span>
        </div>

        <div class="footer-links">
            <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
            <a href="{{ route('pengelolaan') }}" class="footer-link">Pengelolaan</a>
            <a href="{{ route('profile') }}" class="footer-link">Profile</a>
            <a href="{{ route('login') }}" class="footer-link">Login</a>
        </div>

        <div class="footer-socials">
            <a href="#" class="social-icon">🐦</a>
            <a href="#" class="social-icon">📸</a>
            <a href="#" class="social-icon">💼</a>
        </div>

        <p class="footer-copy">&copy; {{ date('Y') }} Elixir Of Life. All rights reserved.</p>
    </div>
</footer>

<style>
.footer-custom {
    background: linear-gradient(135deg, rgba(0,77,64,0.95), rgba(0,150,136,0.95));
    border-top: 2px solid rgba(129,199,132,0.3);
    box-shadow: 0 -4px 20px rgba(0,77,64,0.4);
    padding: 2rem 1rem;
    text-align: center;
    color: #fff;
    position: relative;
    z-index: 100;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 800;
    font-size: 1.5rem;
    text-shadow: 0 2px 10px rgba(129,199,132,0.5);
}

.footer-logo .logo-icon {
    font-size: 2rem;
    filter: drop-shadow(0 0 10px rgba(129,199,132,0.8));
    animation: sway 3s ease-in-out infinite;
}

.footer-logo .logo-text {
    background: linear-gradient(135deg, #81C784 0%, #66BB6A 50%, #4CAF50 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-links {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.footer-link {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-weight: 600;
    position: relative;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.footer-link:hover {
    color: #fff;
    border-color: rgba(129,199,132,0.4);
    background: rgba(129,199,132,0.1);
    transform: translateY(-2px);
}

.footer-socials {
    display: flex;
    gap: 1rem;
}

.social-icon {
    font-size: 1.3rem;
    text-decoration: none;
    color: #81C784;
    transition: transform 0.3s ease, color 0.3s ease;
}

.social-icon:hover {
    color: #4CAF50;
    transform: scale(1.2) rotate(10deg);
}

.footer-copy {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.7);
    margin-top: 1rem;
}

@keyframes sway {
    0%, 100% { transform: rotate(-5deg); }
    50% { transform: rotate(5deg); }
}
</style>
