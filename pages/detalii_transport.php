<?php
// --- 1. CONEXIUNE BAZĂ DE DATE ---
$host = 'localhost'; $db = 'tokyo_db'; $user = 'root'; $pass = ''; 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Eroare de conexiune: " . $e->getMessage());
}

// --- 2. PRELUARE DATE ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM transport WHERE id = ?");
$stmt->execute([$id]);
$t = $stmt->fetch();

if (!$t) {
    header("Location: transport.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($t['denumire']); ?> - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <style>
        :root { --tokyo-dark: #1a1e23; --tokyo-red: #dc3545; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: var(--tokyo-dark) !important; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .page-header { background-color: var(--tokyo-dark); padding: 90px 0 60px; color: white; text-align: center; }
        .badge-tokyo { background-color: var(--tokyo-red); color: white; padding: 6px 15px; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 0.75rem; }
        .info-card { border: none; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.05); background: white; }
        .payment-sidebar { border-top: 4px solid var(--tokyo-red); }
        .map-wrapper { border-radius: 12px; overflow: hidden; border: 1px solid #ddd; background: white; padding: 15px; }
        .map-wrapper img { width: 100%; height: auto; border-radius: 8px; }
        .btn-back { border-radius: 50px; padding: 10px 25px; font-weight: 600; transition: 0.3s; }

        .page-header { 
    background-color: var(--tokyo-dark); 
    background-size: cover; 
    background-position: center; 
    position: relative;
    padding: 120px 0 80px; 
    color: white; 
    text-align: center; 
}

/* Adăugăm un strat negru transparent peste poză ca să se vadă bine textul alb */
.page-header::before {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.6); 
    z-index: 1;
}

.page-header .container {
    position: relative;
    z-index: 2; /* Pune textul deasupra stratului negru */
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
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i>Acasă</a></li>
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

<?php 
// Verificăm dacă avem o imagine validă în baza de date, altfel folosim o culoare solidă
$banner_url = !empty($t['imagine_url']) ? $t['imagine_url'] : '';
?>

<section class="page-header" style="<?php echo $banner_url ? "background-image: url('$banner_url');" : ""; ?>">
    <div class="container">
        <span class="badge-tokyo mb-3"><?php echo htmlspecialchars($t['tip']); ?></span>
        <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($t['denumire']); ?></h1>
        <p class="lead opacity-75">Ghid complet pentru rute și metode de plată</p>
    </div>
</section>

<div class="container py-5">
    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="info-card p-4 mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Rute și Stații Principale</h4>
                <p class="fs-5 text-dark fw-semibold mb-4"><?php echo htmlspecialchars($t['rute']); ?></p>
                
                <h5 class="fw-bold border-bottom pb-2">Informații Suplimentare</h5>
                <p class="text-secondary mt-3" style="line-height: 1.7;">
                    <?php echo nl2br(htmlspecialchars($t['detalii_extinse'])); ?>
                </p>
            </div>

            <div class="map-wrapper shadow-sm">
                <h5 class="fw-bold mb-3"><i class="bi bi-map-fill text-danger me-2"></i>Harta Rutei</h5>
                <?php 
                $nume_poza = $t['imagine_harta']; 
                if (!empty($nume_poza) && file_exists($nume_poza)): 
                ?>
                    <img src="<?php echo htmlspecialchars($nume_poza); ?>" 
                         alt="Harta <?php echo htmlspecialchars($t['denumire']); ?>" 
                         class="img-fluid rounded shadow-sm">
                <?php else: ?>
                    <div class="alert alert-warning py-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Imaginea nu a putut fi găsită.</strong><br>
                        <small>PHP caută fișierul <code><?php echo htmlspecialchars($nume_poza ?: 'nespecificat'); ?></code> în același folder.</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-4">
                <div class="info-card payment-sidebar p-4 mb-4">
                    <h5 class="fw-bold mb-4 text-uppercase small text-muted">Detalii Plată</h5>
                    
                    <div class="mb-4">
                        <label class="d-block small fw-bold text-dark">Metodă Recomandată:</label>
                        <span class="badge bg-light text-dark border w-100 py-2 fs-6 mt-1 text-start ps-3">
                            <i class="bi bi-credit-card-2-front text-danger me-2"></i><?php echo htmlspecialchars($t['plata_metoda']); ?>
                        </span>
                    </div>

                    <div class="mb-4">
                        <label class="d-block small fw-bold text-dark">Cum se efectuează plata:</label>
                        <p class="small text-secondary mt-1"><?php echo htmlspecialchars($t['plata_instructiuni']); ?></p>
                    </div>

                    <div class="bg-danger text-white p-3 rounded text-center shadow-sm">
                        <span class="small opacity-75 d-block">Cost Călătorie</span>
                        <span class="fs-2 fw-bold"><?php echo htmlspecialchars($t['pret']); ?></span>
                    </div>
                </div>

                <a href="transport.php" class="btn btn-outline-dark btn-back w-100">
                    <i class="bi bi-arrow-left me-2"></i>Înapoi la toate opțiunile
                </a>
            </div>
        </div> </div> </div> <?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>