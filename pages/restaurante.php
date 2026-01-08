<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descoperă cele mai bune restaurante din Tokyo - sushi, ramen, tempura și multe altele.">
    <title>Restaurante Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php 
// Ajustare cale pentru navbar din subdirector
$base_path = '../';
?>

<!-- Navbar adaptat pentru subdirector -->
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
                <li class="nav-item"><a class="nav-link active" href="restaurante.php"><i class="bi bi-cup-hot me-1"></i>Restaurante</a></li>
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
        <span class="badge bg-danger mb-3">レストラン</span>
        <h1 class="display-4 fw-bold">Restaurante Tokyo</h1>
        <p class="lead">Savurează cele mai autentice arome japoneze</p>
    </div>
</section>

<!-- Conținut Restaurante -->
<section class="py-5">
    <div class="container">
        <?php
        require_once '../config.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM restaurante ORDER BY rating DESC");
            $restaurante = $stmt->fetchAll();
        } catch (PDOException $e) {
            $restaurante = [];
        }
        ?>
        
        <div class="row g-4">
            <?php if (count($restaurante) > 0): ?>
                <?php foreach ($restaurante as $restaurant): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 card-hover">
                        <div class="card-img-wrapper">
                            <img src="<?php echo $restaurant['imagine'] ?: 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=400'; ?>" 
                                 class="card-img-top" alt="<?php echo htmlspecialchars($restaurant['nume']); ?>">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($restaurant['nume']); ?></h5>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill"></i> <?php echo $restaurant['rating']; ?>
                                </span>
                            </div>
                            <p class="text-danger mb-2">
                                <i class="bi bi-tag-fill me-1"></i><?php echo htmlspecialchars($restaurant['tip_bucatarie']); ?>
                            </p>
                            <p class="card-text text-secondary small">
                                <?php echo htmlspecialchars($restaurant['descriere']); ?>
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between small text-secondary">
                                <span><i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($restaurant['adresa']); ?></span>
                                <span class="fw-bold text-danger">¥<?php echo number_format($restaurant['pret_mediu']); ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="rezervari.php" class="btn btn-outline-danger w-100">
                                <i class="bi bi-calendar-check me-2"></i>Rezervă acum
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-cup-hot display-1 text-secondary"></i>
                    <h3 class="mt-3">Nu sunt restaurante disponibile</h3>
                    <p class="text-secondary">Verifică conexiunea la baza de date sau adaugă restaurante în MySQL.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include '../footer.php'; ?>

</body>
</html>
