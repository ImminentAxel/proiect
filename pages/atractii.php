<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descoperă cele mai frumoase atracții turistice din Tokyo.">
    <title>Atracții Turistice Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="../css/style.css" rel="stylesheet"> 
    
    <style>
        /* Stiluri extra pentru footer */
        footer a:hover {
            color: #dc3545 !important;
            transition: 0.3s;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
            <span class="fs-4 fw-bold text-danger me-2">🗼</span>
            <span class="fw-bold">Tokyo</span>
            <span class="text-danger ms-1">Explorer</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../index.php"><i class="bi bi-house-door me-1"></i>Acasă</a></li>
                <li class="nav-item"><a class="nav-link active" href="atractii.php"><i class="bi bi-geo-alt me-1"></i>Atracții</a></li>
                <li class="nav-item"><a class="nav-link" href="restaurante.php"><i class="bi bi-cup-hot me-1"></i>Restaurante</a></li>
                <li class="nav-item"><a class="nav-link" href="cazare.php"><i class="bi bi-building me-1"></i>Cazare</a></li>
                <li class="nav-item"><a class="nav-link" href="evenimente.php"><i class="bi bi-calendar-event me-1"></i>Evenimente</a></li>
                <li class="nav-item"><a class="nav-link" href="transport.php"><i class="bi bi-train-front me-1"></i>Transport</a></li>
                <li class="nav-item"><a class="nav-link" href="rezervari.php"><i class="bi bi-calendar-check me-1"></i>Rezervări</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i>Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="height: 76px;"></div>

<section class="page-header text-white text-center bg-dark py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=1200'); background-size: cover; background-position: center;">
    <div class="container">
        <span class="badge bg-danger mb-3">観光地</span>
        <h1 class="display-4 fw-bold">Atracții Turistice</h1>
        <p class="lead">Explorează cele mai iconice locuri din Tokyo</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "tokyo");

        if (!$conn) {
            die("<div class='alert alert-danger'>Conexiunea a eșuat: " . mysqli_connect_error() . "</div>");
        }

        $sql = "SELECT * FROM atractii";
        $result = mysqli_query($conn, $sql);
        ?>
        
        <div class="row g-4">
            <?php 
            if (mysqli_num_rows($result) > 0): 
                while($atractie = mysqli_fetch_assoc($result)): 
                    
                    $img_src = !empty($atractie['imagine']) ? "../images/" . $atractie['imagine'] : "https://images.unsplash.com/photo-1554797589-7241bb691973?w=500&auto=format&fit=crop";
                    
                    $pret = ($atractie['pret_intrare'] == 0) ? "Gratuit" : "¥" . number_format($atractie['pret_intrare']);
                    $class_pret = ($atractie['pret_intrare'] == 0) ? "text-success" : "text-primary";
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrapper" style="height: 200px; overflow: hidden;">
                            <img src="<?php echo $img_src; ?>" 
                                 class="card-img-top w-100 h-100 object-fit-cover" 
                                 style="object-fit: cover;"
                                 alt="<?php echo htmlspecialchars($atractie['nume']); ?>">
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0 fw-bold"><?php echo htmlspecialchars($atractie['nume']); ?></h5>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill"></i> <?php echo $atractie['rating']; ?>
                                </span>
                            </div>
                            
                            <p class="text-danger mb-2 fw-bold" style="font-size: 0.9rem;">
                                <i class="bi bi-bookmark-fill me-1"></i><?php echo htmlspecialchars($atractie['categorie']); ?>
                            </p>
                            
                            <p class="card-text text-secondary small">
                                <?php echo htmlspecialchars($atractie['descriere']); ?>
                            </p>
                            
                            <hr>
                            
                            <div class="row text-secondary small">
                                <div class="col-12 mb-1">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i><?php echo htmlspecialchars($atractie['adresa']); ?>
                                </div>
                                <div class="col-6">
                                    <i class="bi bi-clock me-1"></i><?php echo htmlspecialchars($atractie['program']); ?>
                                </div>
                                <div class="col-6 text-end fw-bold <?php echo $class_pret; ?>">
                                    <?php echo $pret; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                            <a href="rezervari.php" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-calendar-check me-1"></i>Fă o rezervare
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-frown display-1 text-secondary"></i>
                    <h3 class="mt-3">Nu s-au găsit atracții</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-danger mb-3 d-flex align-items-center">
                    <span class="fs-5 fw-bold">🗼 Tokyo Explorer</span>
                </h5>
                <p class="text-secondary small pe-4">
                    Descoperă frumusețea și cultura fascinantă a capitalei Japoniei. De la temple antice la tehnologie de ultimă generație.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-secondary fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase">Explorează</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><a href="atractii.php" class="text-decoration-none text-secondary">Atracții</a></li>
                    <li class="mb-2"><a href="restaurante.php" class="text-decoration-none text-secondary">Restaurante</a></li>
                    <li class="mb-2"><a href="cazare.php" class="text-decoration-none text-secondary">Cazare</a></li>
                    <li class="mb-2"><a href="evenimente.php" class="text-decoration-none text-secondary">Evenimente</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase">Informații</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><a href="transport.php" class="text-decoration-none text-secondary">Transport</a></li>
                    <li class="mb-2"><a href="rezervari.php" class="text-decoration-none text-secondary">Rezervări</a></li>
                    <li class="mb-2"><a href="contact.php" class="text-decoration-none text-secondary">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase">Contact</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-danger"></i> Tokyo, Japan</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2 text-danger"></i> info@tokyo-explorer.jp</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2 text-danger"></i> +81 3-1234-5678</li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap text-secondary small">
            <div class="mb-2 mb-md-0">&copy; 2026 Tokyo Explorer. Toate drepturile rezervate.</div>
            <div>Made with <span class="text-danger">❤</span> for Tokyo lovers</div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>