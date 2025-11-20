<style>
       /* NAVBAR */
    .navbar {
        font-size: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        background: #fff;
        border-bottom: 1px solid #dee2e6;
        padding: 0.5rem 1rem;
    }
    .navbar-logo {
        height: 38px;
        width: auto;
    }
    .btn-login {
        border-radius: 6px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        font-size: 0.95rem;
        color: #0d47a1 !important;
        background-color: #fff;
        border: 2px solid #0d47a1;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background-color: #0d47a1;
        color: #fff !important;
        border: 2px solid #0d47a1;
        
    }
   
</style>

    <nav class="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center mx-lg-5">
        <a href="/" class="navbar-brand d-flex align-items-center py-2">
            <img src="{{ asset('images/logo_inotal.png') }}" alt="Talenthub Logo" class="navbar-logo">
        </a>
        <form action="{{ route('company.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn-login">Keluar</button>
        </form>
    </div>
</nav>

