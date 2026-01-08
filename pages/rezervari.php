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
        <p class="lead">Rezervă restaurante, tururi și experiențe unice</p>
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
<section class="py-5">
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

<?php include '../footer.php'; ?>

</body>
</html>
