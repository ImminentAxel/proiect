<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descoperă evenimentele și festivalurile din Tokyo - cherry blossom, artificii și expoziții.">
    <title>Evenimente Tokyo - Tokyo Explorer</title>
    
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
                <li class="nav-item"><a class="nav-link" href="cazare.php"><i class="bi bi-building me-1"></i>Cazare</a></li>
                <li class="nav-item"><a class="nav-link active" href="evenimente.php"><i class="bi bi-calendar-event me-1"></i>Evenimente</a></li>
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
        <span class="badge bg-danger mb-3">イベント</span>
        <h1 class="display-4 fw-bold">Evenimente în Tokyo</h1>
        <p class="lead">Festivaluri, expoziții și experiențe unice</p>
    </div>
</section>

<!-- Conținut Evenimente -->
<section class="py-5">
    <div class="container">
        <?php
        require_once '../config.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM evenimente ORDER BY data_start ASC");
            $evenimente = $stmt->fetchAll();
        } catch (PDOException $e) {
            $evenimente = [];
        }
        ?>
        
        <div class="row g-4">
            <?php if (count($evenimente) > 0): ?>
                <?php foreach ($evenimente as $eveniment): ?>
                <div class="col-lg-6">
                    <div class="card h-100 card-hover">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $eveniment['imagine'] ?: 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=300'; ?>" 
                                     class="img-fluid rounded-start h-100" style="object-fit: cover;" 
                                     alt="<?php echo htmlspecialchars($eveniment['titlu']); ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-danger"><?php echo htmlspecialchars($eveniment['categorie']); ?></span>
                                        <span class="text-danger fw-bold">
                                            <?php echo $eveniment['pret'] == 0 ? 'Gratuit' : '¥' . number_format($eveniment['pret']); ?>
                                        </span>
                                    </div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($eveniment['titlu']); ?></h5>
                                    <p class="card-text text-secondary small">
                                        <?php echo htmlspecialchars($eveniment['descriere']); ?>
                                    </p>
                                    <div class="d-flex gap-3 text-secondary small">
                                        <span>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            <?php 
                                                $start = date('d M', strtotime($eveniment['data_start']));
                                                $end = date('d M Y', strtotime($eveniment['data_sfarsit']));
                                                echo $start . ' - ' . $end;
                                            ?>
                                        </span>
                                        <span>
                                            <i class="bi bi-geo-alt me-1"></i>
                                            <?php echo htmlspecialchars($eveniment['locatie']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-calendar-event display-1 text-secondary"></i>
                    <h3 class="mt-3">Nu sunt evenimente disponibile</h3>
                    <p class="text-secondary">Verifică conexiunea la baza de date.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>

</body>
</html>
