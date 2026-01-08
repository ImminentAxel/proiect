<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ghid complet pentru transportul în Tokyo - metrou, trenuri, autobuze și mai mult.">
    <title>Transport Tokyo - Tokyo Explorer</title>
    
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
                <li class="nav-item"><a class="nav-link" href="evenimente.php"><i class="bi bi-calendar-event me-1"></i>Evenimente</a></li>
                <li class="nav-item"><a class="nav-link active" href="transport.php"><i class="bi bi-train-front me-1"></i>Transport</a></li>
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
        <span class="badge bg-danger mb-3">交通</span>
        <h1 class="display-4 fw-bold">Transport în Tokyo</h1>
        <p class="lead">Ghid complet pentru a te deplasa în oraș</p>
    </div>
</section>

<!-- Conținut Transport -->
<section class="py-5">
    <div class="container">
        <?php
        require_once '../config.php';
        
        try {
            $stmt = $pdo->query("SELECT * FROM transport ORDER BY tip ASC");
            $transporturi = $stmt->fetchAll();
        } catch (PDOException $e) {
            $transporturi = [];
        }
        ?>
        
        <?php if (count($transporturi) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Tip</th>
                        <th>Denumire</th>
                        <th>Descriere</th>
                        <th>Preț</th>
                        <th>Program</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transporturi as $transport): ?>
                    <tr>
                        <td>
                            <span class="badge bg-danger">
                                <?php 
                                $icon = 'bi-bus-front';
                                if ($transport['tip'] == 'Metrou') $icon = 'bi-train-subway-fill';
                                if ($transport['tip'] == 'Tren') $icon = 'bi-train-front-fill';
                                ?>
                                <i class="bi <?php echo $icon; ?> me-1"></i>
                                <?php echo htmlspecialchars($transport['tip']); ?>
                            </span>
                        </td>
                        <td class="fw-bold"><?php echo htmlspecialchars($transport['denumire']); ?></td>
                        <td class="text-secondary"><?php echo htmlspecialchars($transport['descriere']); ?></td>
                        <td><span class="text-danger fw-bold"><?php echo htmlspecialchars($transport['pret']); ?></span></td>
                        <td><i class="bi bi-clock me-1"></i><?php echo htmlspecialchars($transport['program']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-train-front display-1 text-secondary"></i>
            <h3 class="mt-3">Nu sunt informații de transport disponibile</h3>
            <p class="text-secondary">Verifică conexiunea la baza de date.</p>
        </div>
        <?php endif; ?>
        
        <!-- Sfaturi Transport -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center">
                        <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-credit-card text-white fs-4"></i>
                        </div>
                        <h5>Suica/Pasmo Card</h5>
                        <p class="text-secondary small">Cumpără un card IC pentru a plăti rapid și ușor în tot transportul public din Tokyo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center">
                        <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-phone text-white fs-4"></i>
                        </div>
                        <h5>Apps Recomandate</h5>
                        <p class="text-secondary small">Descarcă Google Maps sau Japan Transit pentru navigare perfectă în rețeaua de transport.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center">
                        <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-ticket-perforated text-white fs-4"></i>
                        </div>
                        <h5>JR Pass</h5>
                        <p class="text-secondary small">Pentru călătorii în afara Tokyo-ului, JR Pass oferă acces nelimitat la trenurile JR, inclusiv Shinkansen.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>

</body>
</html>
