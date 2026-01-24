<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rezervă restaurante, tururi și experiențe în Tokyo.">
    <title>Rezervări Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
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
                <li class="nav-item"><a class="nav-link" href="evenimente.php"><i class="bi bi-calendar-event me-1"></i>evenimente</a></li>
                <li class="nav-item"><a class="nav-link" href="transport.php"><i class="bi bi-train-front me-1"></i>Transport</a></li>
                <li class="nav-item"><a class="nav-link active" href="rezervari.php"><i class="bi bi-calendar-check me-1"></i>Rezervări</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i>Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="height: 76px;"></div>

<!-- Page Header -->
<section class="page-header text-white text-center">
    <div class="container">
        <span class="badge bg-danger mb-3">予約</span>
        <h1 class="display-4 fw-bold">Fă o Rezervare</h1>
        <p class="lead">Alege din pachete gata sau creează-ți experiența personalizată</p>
    </div>
</section>

<?php
require_once '../config.php';

$mesaj = '';
$tip_mesaj = '';

// Procesare formular rezervare
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = trim($_POST['nume'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $telefon = trim($_POST['telefon'] ?? '');
    $data_rezervare = $_POST['data_rezervare'] ?? '';
    $ora_rezervare = $_POST['ora_rezervare'] ?? '';
    $numar_persoane = intval($_POST['numar_persoane'] ?? 1);
    $tip_serviciu = $_POST['tip_serviciu'] ?? '';
    $observatii = trim($_POST['observatii'] ?? '');
    
    // Validare
    $erori = [];
    if (empty($nume)) $erori[] = 'Numele este obligatoriu.';
    if (!$email) $erori[] = 'Email-ul nu este valid.';
    if (empty($data_rezervare)) $erori[] = 'Data este obligatorie.';
    if (empty($ora_rezervare)) $erori[] = 'Ora este obligatorie.';
    if ($numar_persoane < 1 || $numar_persoane > 20) $erori[] = 'Număr persoane invalid.';
    if (!in_array($tip_serviciu, ['restaurant', 'cazare', 'tur'])) $erori[] = 'Tip serviciu invalid.';
    
    if (empty($erori)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO rezervari (nume_client, email, telefon, data_rezervare, ora_rezervare, numar_persoane, tip_serviciu, observatii) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nume, $email, $telefon, $data_rezervare, $ora_rezervare, $numar_persoane, $tip_serviciu, $observatii]);
            
            $mesaj = 'Rezervarea a fost trimisă cu succes! Vei primi o confirmare pe email.';
            $tip_mesaj = 'success';
        } catch (PDOException $e) {
            $mesaj = 'Eroare la procesare. Te rugăm încearcă din nou.';
            $tip_mesaj = 'danger';
        }
    } else {
        $mesaj = implode('<br>', $erori);
        $tip_mesaj = 'danger';
    }
}
?>

<!-- Formular Rezervare -->
<section id="formular-section" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <?php if ($mesaj): ?>
                <div class="alert alert-<?php echo $tip_mesaj; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mesaj; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-danger text-white py-4">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Completează Detaliile Rezervării</h5>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="rezervari.php">
                            <div class="row g-4">
                                <!-- Nume -->
                                <div class="col-md-6">
                                    <label for="nume" class="form-label">Nume complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nume" name="nume" required 
                                           placeholder="Ex: Tanaka Hiroshi">
                                </div>
                                
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required 
                                           placeholder="email@example.com">
                                </div>
                                
                                <!-- Telefon -->
                                <div class="col-md-6">
                                    <label for="telefon" class="form-label">Telefon</label>
                                    <input type="tel" class="form-control form-control-lg" id="telefon" name="telefon" 
                                           placeholder="+81 XX-XXXX-XXXX">
                                </div>
                                
                                <!-- Tip serviciu -->
                                <div class="col-md-6">
                                    <label for="tip_serviciu" class="form-label">Tip serviciu <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg" id="tip_serviciu" name="tip_serviciu" required>
                                        <option value="">Selectează...</option>
                                        <option value="restaurant">🍣 Restaurant</option>
                                        <option value="cazare">🏨 Cazare</option>
                                        <option value="tur">🗼 Tur ghidat</option>
                                    </select>
                                </div>
                                
                                <!-- Data -->
                                <div class="col-md-4">
                                    <label for="data_rezervare" class="form-label">Data <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg" id="data_rezervare" name="data_rezervare" required 
                                           min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                
                                <!-- Ora -->
                                <div class="col-md-4">
                                    <label for="ora_rezervare" class="form-label">Ora <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control form-control-lg" id="ora_rezervare" name="ora_rezervare" required>
                                </div>
                                
                                <!-- Număr persoane -->
                                <div class="col-md-4">
                                    <label for="numar_persoane" class="form-label">Persoane <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg" id="numar_persoane" name="numar_persoane" required>
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo $i == 1 ? 'persoană' : 'persoane'; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                
                                <!-- Observații -->
                                <div class="col-12">
                                    <label for="observatii" class="form-label">Observații / cereri speciale</label>
                                    <textarea class="form-control" id="observatii" name="observatii" rows="3" 
                                              placeholder="Menționează preferințe, alergii alimentare sau alte cereri..."></textarea>
                                </div>
                                
                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger btn-lg w-100">
                                        <i class="bi bi-calendar-check me-2"></i>Trimite rezervarea
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Pachete Populare (SELECT din DB) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">
                <i class="bi bi-star text-warning me-2"></i>Pachete Populare
            </h2>
            <p class="text-secondary">Alege din ofertele noastre pre-configurate</p>
        </div>
        
        <div class="row g-4">
            <?php
            // SELECT - Preluăm pachete din baza de date
            try {
                $stmt = $pdo->query("SELECT * FROM pachete_rezervari WHERE activ = 1 ORDER BY pret ASC");
                $pachete = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($pachete) > 0) {
                    foreach ($pachete as $pachet) {
                        $icoane = [
                            'restaurant' => 'bi-cup-hot',
                            'cazare' => 'bi-building',
                            'tur' => 'bi-map'
                        ];
                        $icona = $icoane[$pachet['tip_serviciu']] ?? 'bi-star';
                        
                        echo '<div class="col-lg-4 col-md-6">';
                        echo '<div class="card h-100 shadow-lg border-0 transition-card" style="cursor: pointer;" onclick="document.getElementById(\'tip_serviciu\').value=\'' . $pachet['tip_serviciu'] . '\'; window.scrollTo({top: document.getElementById(\'formular-section\').offsetTop - 100, behavior: \'smooth\'});">';
                        
                        // Header cu culoare
                        echo '<div class="card-header bg-danger text-white py-3">';
                        echo '<div class="d-flex align-items-center justify-content-between">';
                        echo '<div>';
                        echo '<h5 class="card-title mb-0"><i class="bi ' . $icona . ' me-2"></i>' . htmlspecialchars($pachet['nume_pachet']) . '</h5>';
                        echo '</div>';
                        if ($pachet['popular']) {
                            echo '<span class="badge bg-warning text-dark">Popular</span>';
                        }
                        echo '</div>';
                        echo '</div>';
                        
                        // Body
                        echo '<div class="card-body">';
                        echo '<p class="text-secondary mb-3">' . htmlspecialchars($pachet['descriere']) . '</p>';
                        
                        // Caracteristici
                        echo '<div class="mb-3">';
                        if (!empty($pachet['caracteristici'])) {
                            $caracteristici = explode(',', $pachet['caracteristici']);
                            foreach ($caracteristici as $cara) {
                                echo '<div class="mb-2"><small class="text-success"><i class="bi bi-check-circle-fill me-1"></i>' . trim($cara) . '</small></div>';
                            }
                        }
                        echo '</div>';
                        
                        // Durată și preț
                        echo '<div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">';
                        echo '<div>';
                        echo '<small class="text-secondary">Durată</small><br>';
                        echo '<strong>' . htmlspecialchars($pachet['durata']) . '</strong>';
                        echo '</div>';
                        echo '<div class="text-end">';
                        echo '<small class="text-secondary">Preț/persoană</small><br>';
                        echo '<h5 class="text-danger mb-0">¥' . number_format($pachet['pret'], 0, '.', ',') . '</h5>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '</div>';
                        
                        // Footer
                        echo '<div class="card-footer bg-white border-top">';
                        echo '<button class="btn btn-danger w-100" onclick="document.getElementById(\'tip_serviciu\').value=\'' . $pachet['tip_serviciu'] . '\'; window.scrollTo({top: document.getElementById(\'formular-section\').offsetTop - 100, behavior: \'smooth\'});">';
                        echo '<i class="bi bi-calendar-check me-2"></i>Selectează Pachet';
                        echo '</button>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12"><div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Nu sunt pachete disponibile momentan.</div></div>';
                }
            } catch (PDOException $e) {
                echo '<div class="col-12"><div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>Eroare la încărcarea pachete.</div></div>';
            }
            ?>
        </div>
    </div>
</section>




<?php include '../footer.php'; ?>

<style>
.transition-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.transition-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>

</body>
</html>