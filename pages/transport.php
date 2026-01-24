<?php
// --- CONEXIUNE BAZA DE DATE ---
$host = 'localhost';
$db   = 'tokyo_db';
$user = 'root'; 
$pass = '';     
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Eroare de conexiune: " . $e->getMessage());
}

// --- PRELUARE DATE ---
try {
    $stmt = $pdo->query("SELECT * FROM transport ORDER BY tip ASC");
    $transporturi = $stmt->fetchAll();
} catch (PDOException $e) {
    $transporturi = [];
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ghid complet pentru transportul în Tokyo - metrou, trenuri, autobuze și mai mult.">
    <title>Transport Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
     <link href="../css/transport.css" rel="stylesheet">
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

<section class="page-header text-white text-center" style="background-color: #1a1e23; padding: 60px 0;">
    <div class="container">
        <span class="badge bg-danger mb-3">交通</span>
        <h1 class="display-4 fw-bold">Transport în Tokyo</h1>
        <p class="lead">Ghid complet pentru a te deplasa în oraș</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        
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
                $tip = $transport['tip'];
                // Folosim clasele cele mai compatibile din Bootstrap Icons
                if ($tip == 'metrou') {
                    $icon_class = 'bi-subway'; 
                } elseif ($tip == 'Tren') {
                    $icon_class = 'bi-train-front'; 
                } else {
                    $icon_class = 'bi-bus-front'; 
                }
                ?>
                <i class="bi <?php echo $icon_class; ?> me-1"></i>
                <?php echo htmlspecialchars($tip); ?>
            </span>
        </td>
        <td class="fw-bold">
            <a href="detalii_transport.php?id=<?php echo $transport['id']; ?>" class="text-decoration-none text-dark">
                <?php echo htmlspecialchars($transport['denumire']); ?> 
                <i class="bi bi-arrow-right-short text-danger"></i>
            </a>
        </td>
        <td class="text-secondary small"><?php echo htmlspecialchars($transport['descriere']); ?></td>
        <td><span class="text-danger fw-bold"><?php echo htmlspecialchars($transport['pret']); ?></span></td>
        <td><i class="bi bi-clock me-1 text-secondary"></i> <?php echo htmlspecialchars($transport['program']); ?></td>
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
        
        <div class="row g-4 mt-5">
    <div class="col-md-4">
        <a href="https://www.pasmo.co.jp/visitors/en/" target="_blank" class="text-decoration-none text-dark">
            <div class="info-card p-4 text-center h-100 shadow-hover">
                <div class="icon-circle mb-3 mx-auto">
                    <i class="bi bi-credit-card-2-front text-white fs-4"></i>
                </div>
                <h5 class="fw-bold">Pasmo Card</h5>
                <p class="small text-muted">Cumpără un card IC pentru a plăti rapid și ușor în tot transportul public din Tokyo.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="https://play.google.com/store/apps/details?id=jp.co.jorudan.nrkj" target="_blank" class="text-decoration-none text-dark">
            <div class="info-card p-4 text-center h-100 shadow-hover">
                <div class="icon-circle mb-3 mx-auto">
                    <i class="bi bi-phone text-white fs-4"></i>
                </div>
                <h5 class="fw-bold">Aplicații Recomandate</h5>
                <p class="small text-muted">Descarcă Japan Transit pentru navigare perfectă în rețeaua de transport.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="https://www.jreast.co.jp/en/multi/pass/" target="_blank" class="text-decoration-none text-dark">
            <div class="info-card p-4 text-center h-100 shadow-hover">
                <div class="icon-circle mb-3 mx-auto">
                    <i class="bi bi-ticket-perforated text-white fs-4"></i>
                </div>
                <h5 class="fw-bold">JR Pass</h5>
                <p class="small text-muted">Pentru călătorii în afara Tokyo-ului, JR Pass oferă acces nelimitat la trenurile JR, inclusiv Shinkansen.</p>
            </div>
        </a>
    </div>
</div>
</section>

<?php 
// Verifică dacă fișierul există înainte de include
if (file_exists('../footer.php')) {
    include '../footer.php'; 
} else {
    echo '<footer class="bg-dark text-white text-center py-3"><p>&copy; 2024 Tokyo Explorer</p></footer>';
}
?>

</body>
</html>