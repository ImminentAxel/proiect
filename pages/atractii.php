<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descoperă cele mai frumoase atracții turistice din Tokyo - temple, muzee, parcuri și multe altele.">
    <title>Atracții Turistice Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
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

<!-- Page Header -->
<section class="page-header text-white text-center">
    <div class="container">
        <span class="badge bg-danger mb-3">観光地</span>
        <h1 class="display-4 fw-bold">Atracții Turistice</h1>
        <p class="lead">Explorează cele mai iconice locuri din Tokyo</p>
    </div>
</section>

<!-- Conținut Atracții -->
<section class="py-5">
    <div class="container">
        <?php
        require_once '../config.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM atractii ORDER BY rating DESC");
            $atractii = $stmt->fetchAll();
        } catch (PDOException $e) {
            $atractii = [];
        }
        ?>
        
        <div class="row g-4">
            <?php if (count($atractii) > 0): ?>
                <?php foreach ($atractii as $atractie): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 card-hover">
                        <div class="card-img-wrapper">
                            <img src="<?php echo $atractie['imagine'] ?: 'https://images.unsplash.com/photo-1480796927426-f609979314bd?w=400'; ?>" 
                                 class="card-img-top" alt="<?php echo htmlspecialchars($atractie['nume']); ?>">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($atractie['nume']); ?></h5>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill"></i> <?php echo $atractie['rating']; ?>
                                </span>
                            </div>
                            <p class="text-danger mb-2">
                                <i class="bi bi-bookmark-fill me-1"></i><?php echo htmlspecialchars($atractie['categorie']); ?>
                            </p>
                            <p class="card-text text-secondary small">
                                <?php echo htmlspecialchars($atractie['descriere']); ?>
                            </p>
                            <hr>
                            <div class="row text-secondary small">
                                <div class="col-6">
                                    <i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($atractie['adresa']); ?>
                                </div>
                                <div class="col-6 text-end">
                                    <i class="bi bi-clock me-1"></i><?php echo htmlspecialchars($atractie['program']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                            <span class="fw-bold <?php echo $atractie['pret_intrare'] == 0 ? 'text-success' : 'text-danger'; ?>">
                                <?php echo $atractie['pret_intrare'] == 0 ? 'Gratuit' : '¥' . number_format($atractie['pret_intrare']); ?>
                            </span>
                            <a href="rezervari.php" class="btn btn-danger btn-sm">
                                <i class="bi bi-calendar-check me-1"></i>Planifică vizita
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-geo-alt display-1 text-secondary"></i>
                    <h3 class="mt-3">Nu sunt atracții disponibile</h3>
                    <p class="text-secondary">Verifică conexiunea la baza de date.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>

</body>
</html>
