    <nav class="navbar navbar-expand-lg navbar-dark bg-danger" style="height: 70px;">
        <div class="container">
            {{-- <img src="img/icon-chef.png" alt="" style="width:80px; margin-top:0px;"> --}}
            
            <a class="navbar-brand" href="/reseps">CookingPedia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                <a class="nav-link {{ ($active === "beranda") ? 'active' : '' }}"href="/">Beranda</a>
                </li> --}}
                <li class="nav-item">
                <a class="nav-link {{ ($active === "tulis_resep") ? 'active' : '' }}" href="/dashboard/reseps/create">Tulis Resep</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === "reseps") ? 'active' : '' }}" href="/reseps">Resep</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === "kategoris") ? 'active' : '' }}" href="/kategoris">Kategori</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Selamat Datang, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Beranda Akun</a></li>
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item "><i class="bi bi-box-arrow-right"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="/login" class="nav-link {{ ($active === "login") ? 'active' : '' }}"><i class="bi bi-box-arrow-right"></i> Masuk</a>
                        </li>
                    </ul>
                @endauth
                
            </ul>
            

            </div>
        </div>
    </nav>