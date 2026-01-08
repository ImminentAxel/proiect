<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Găsește cazare perfectă în Tokyo - hoteluri, hosteluri, ryokan-uri tradiționale.">
    <title>Cazare Tokyo - Tokyo Explorer</title>
    
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
                <li class="nav-item"><a class="nav-link" href="atractii.php"><i class="bi bi-geo-alt me-1"></i>Atracții</a></li>
                <li class="nav-item"><a class="nav-link" href="restaurante.php"><i class="bi bi-cup-hot me-1"></i>Restaurante</a></li>
                <li class="nav-item"><a class="nav-link active" href="cazare.php"><i class="bi bi-building me-1"></i>Cazare</a></li>
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
        <span class="badge bg-danger mb-3">宿泊</span>
        <h1 class="display-4 fw-bold">Cazare în Tokyo</h1>
        <p class="lead">De la hoteluri de lux la ryokan-uri tradiționale</p>
    </div>
</section>

<!-- Conținut Cazare -->
<section class="py-5">
    <div class="container">
        <?php
        require_once '../config.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM cazare ORDER BY pret_noapte DESC");
            $cazari = $stmt->fetchAll();
        } catch (PDOException $e) {
            $cazari = [];
        }
        ?>
        
        <div class="row g-4">
            <?php if (count($cazari) > 0): ?>
                <?php foreach ($cazari as $cazare): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 card-hover">
                        <div class="card-img-wrapper position-relative">
                            <img src="<?php echo $cazare['imagine'] ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=400'; ?>" 
                                 class="card-img-top" alt="<?php echo htmlspecialchars($cazare['nume']); ?>">
                            <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase">
                                <?php echo htmlspecialchars($cazare['tip']); ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($cazare['nume']); ?></h5>
                                <div class="text-warning">
                                    <?php for ($i = 0; $i < $cazare['stele']; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="card-text text-secondary small">
                                <?php echo htmlspecialchars($cazare['descriere']); ?>
                            </p>
                            <p class="text-secondary small mb-0">
                                <i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($cazare['adresa']); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                            <div>
                                <span class="h5 text-danger mb-0">¥<?php echo number_format($cazare['pret_noapte']); ?></span>
                                <small class="text-secondary">/noapte</small>
                            </div>
                            <a href="rezervari.php" class="btn btn-danger">
                                <i class="bi bi-calendar-check me-1"></i>Rezervă
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-building display-1 text-secondary"></i>
                    <h3 class="mt-3">Nu sunt opțiuni de cazare disponibile</h3>
                    <p class="text-secondary">Verifică conexiunea la baza de date.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>

</body>
</html>
