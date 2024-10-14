    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-orange">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
                    <img src="./assets/img/mangatsuki.png" alt="Logo" class="logo">
                </a>


                <!-- Search Bar -->
                <form class="d-flex search-form">
                    <input class="form-control me-2" type="search" placeholder="Hinted search text" aria-label="Search">
                    <button type="submit" class="btn"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg></button>
                </form>

                <!-- Toggler button for mobile menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <!-- Collapsible menu for mobile -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="produitsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produits
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="produitsDropdown">
                                <li><a class="dropdown-item" href="#">Produit 1</a></li>
                                <li><a class="dropdown-item" href="#">Produit 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <body>