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

<?php
require_once '../config.php';

$bilet_succes = '';
$bilet_eroare = '';

// Formular cumpărare bilete evenimente (INSERT în `rezervari`)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cumpara_bilet'])) {
    $nume         = trim($_POST['nume'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $telefon      = trim($_POST['telefon'] ?? '');
    $eveniment_id = (int)($_POST['eveniment_id'] ?? 0);
    $ora          = $_POST['ora'] ?? '';
    $numar_bilete = (int)($_POST['numar_bilete'] ?? 0);
    $observatii   = trim($_POST['observatii'] ?? '');

    // Validare de bază
    if (
        $nume === '' ||
        $email === '' ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        $eveniment_id <= 0 ||
        $numar_bilete <= 0 ||
        $ora === ''
    ) {
        $bilet_eroare = 'Te rugăm să completezi toate câmpurile obligatorii și să alegi un eveniment.';
    } else {
        try {
            // Căutăm evenimentul ales (pentru titlu și dată)
            $stmt_ev = $pdo->prepare("SELECT titlu, data_start FROM evenimente WHERE id = :id");
            $stmt_ev->execute([':id' => $eveniment_id]);
            $eveniment_selectat = $stmt_ev->fetch(PDO::FETCH_ASSOC);

            if (!$eveniment_selectat) {
                $bilet_eroare = 'Evenimentul selectat nu există.';
            } else {
                // Folosim data_start ca dată a rezervării (sau data de azi, fallback)
                $data_rezervare = $eveniment_selectat['data_start'] ?: date('Y-m-d');

                $stmt_bilet = $pdo->prepare("
                    INSERT INTO rezervari 
                        (nume_client, email, telefon, data_rezervare, ora_rezervare, numar_persoane, tip_serviciu, observatii)
                    VALUES 
                        (:nume_client, :email, :telefon, :data_rezervare, :ora_rezervare, :numar_persoane, :tip_serviciu, :observatii)
                ");

                $observatii_complete = 'Bilete pentru eveniment: ' . $eveniment_selectat['titlu'];
                if ($observatii !== '') {
                    $observatii_complete .= ' | ' . $observatii;
                }

                $stmt_bilet->execute([
                    ':nume_client'    => $nume,
                    ':email'          => $email,
                    ':telefon'        => $telefon,
                    ':data_rezervare' => $data_rezervare,
                    ':ora_rezervare'  => $ora,
                    ':numar_persoane' => $numar_bilete,
                    ':tip_serviciu'   => 'tur', 
                    ':observatii'     => $observatii_complete
                ]);

                $bilet_succes = 'Rezervarea pentru bilete a fost înregistrată! ✅ Vei primi confirmarea pe email.';
            }
        } catch (PDOException $e) {
            $bilet_eroare = 'A apărut o eroare la înregistrarea rezervării. Încearcă din nou.';
       
        }
    }
}


$imagini_folder = '../img evenimente';
$imagini = [];
if (is_dir($imagini_folder)) {
    $imagini = array_diff(scandir($imagini_folder), ['.', '..']);
    $imagini = array_values($imagini);
}

//SELECT din `evenimente` pentru afișare + filtrare
try {
    $stmt = $pdo->query("SELECT * FROM evenimente ORDER BY data_start ASC");
    $evenimente = $stmt->fetchAll();
} catch (PDOException $e) {
    $evenimente = [];
}

// Categorii unice pentru filtru
$categorii = [];
foreach ($evenimente as $ev) {
    if (!in_array($ev['categorie'], $categorii)) {
        $categorii[] = $ev['categorie'];
    }
}

// Aplicăm filtrul după categorie (dacă există ?categorie= în URL)
$categorie_filtru = isset($_GET['categorie']) ? $_GET['categorie'] : '';
$evenimente_filtrate = $categorie_filtru
    ? array_filter($evenimente, function ($e) use ($categorie_filtru) {
        return $e['categorie'] == $categorie_filtru;
    })
    : $evenimente;
$evenimente_filtrate = array_values($evenimente_filtrate);
?>

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
<section class="page-header text-white text-center" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../img evenimente/tokyo.webp') center/cover no-repeat; min-height: 350px; display: flex; align-items: center;">
    <div class="container">
        <span class="badge bg-danger mb-3">イベント</span>
        <h1 class="display-4 fw-bold">Evenimente în Tokyo</h1>
        <p class="lead">Festivaluri, expoziții și experiențe unice</p>
    </div>
</section>

<!-- Conținut Evenimente -->
<section class="py-5">
    <div class="container">

        <!-- Filtru Categorie -->
        <div class="mb-4">
            <h5 class="mb-3">Filtrează după categorie</h5>
            <div class="btn-group flex-wrap" role="group">
                <a href="?" class="btn btn-outline-danger <?php echo !$categorie_filtru ? 'active' : ''; ?>">
                    <i class="bi bi-funnel me-2"></i>Toate
                </a>
                <?php foreach ($categorii as $cat): ?>
                    <a href="?categorie=<?php echo urlencode($cat); ?>" class="btn btn-outline-danger <?php echo $categorie_filtru == $cat ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($cat); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="row g-4">
            <?php if (count($evenimente_filtrate) > 0): ?>
                <?php foreach ($evenimente_filtrate as $index => $eveniment): ?>
                <div class="col-lg-6">
                    <div class="card h-100 card-hover">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <?php
                                $imagine_src = 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=300';
                                if ($index < count($imagini)) {
                                    $imagine_src = $imagini_folder . '/' . $imagini[$index];
                                }
                                ?>
                                <img src="<?php echo $imagine_src; ?>" 
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
                                                $start = $eveniment['data_start'] ? date('d M', strtotime($eveniment['data_start'])) : '';
                                                $end = $eveniment['data_sfarsit'] ? date('d M Y', strtotime($eveniment['data_sfarsit'])) : '';
                                                echo trim($start . ' - ' . $end, ' -');
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
                    <h3 class="mt-3">Nu sunt evenimente în această categorie</h3>
                    <p class="text-secondary"><a href="?" class="text-danger">Șterge filtrul</a> pentru a vedea toate evenimentele.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Sfaturi Practici -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">💡 Sfaturi pentru Vizitarea Evenimentelor</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="display-6 text-danger mb-3">🎫</div>
                    <h5>Cumpără Bilete Online</h5>
                    <p class="text-secondary small">Evită cozile lungi cumpărând bilete în avans pe platformele oficiale.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="display-6 text-danger mb-3">⏰</div>
                    <h5>Vino Devreme</h5>
                    <p class="text-secondary small">Sosește cu 30-60 minute înainte pentru a asigura accesul și un loc bun.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="display-6 text-danger mb-3">🚆</div>
                    <h5>Folosește Transportul Public</h5>
                    <p class="text-secondary small">Tokyo-ul are o rețea excelentă de trenuri și metrouri pentru a ajunge la evenimente.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="display-6 text-danger mb-3">👕</div>
                    <h5>Îmbracă-te Corespunzător</h5>
                    <p class="text-secondary small">Verifică vremea și tipul de eveniment pentru a te îmbrăca potrivit.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formular cumpărare bilete -->
<section class="py-5">
    <div class="container">

        <?php if (!empty($bilet_succes)): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?php echo htmlspecialchars($bilet_succes); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Închide"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($bilet_eroare)): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars($bilet_eroare); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Închide"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card my-3 shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-ticket-perforated me-2"></i>
                            Cumpără bilete la un eveniment
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <input type="hidden" name="cumpara_bilet" value="1">
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nume complet *</label>
                                    <input type="text" name="nume" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" name="telefon" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Alege evenimentul *</label>
                                    <select name="eveniment_id" class="form-select" required>
                                        <option value="">-- Selectează un eveniment --</option>
                                        <?php foreach ($evenimente as $ev): ?>
                                            <option value="<?php echo $ev['id']; ?>">
                                                <?php 
                                                    $data_ev = $ev['data_start'] ? date('d.m.Y', strtotime($ev['data_start'])) : '';
                                                    echo htmlspecialchars($ev['titlu']) . ($data_ev ? ' (' . $data_ev . ')' : '');
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Ora *</label>
                                    <input type="time" name="ora" class="form-control" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Număr bilete *</label>
                                    <input type="number" name="numar_bilete" class="form-control" min="1" value="1" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Observații (opțional)</label>
                                    <textarea name="observatii" class="form-control" rows="3" placeholder="Ex: prefer loc în față, sosesc cu 10 minute mai târziu etc."></textarea>
                                </div>
                            </div>

                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-cart-check me-1"></i>
                                    Confirmă rezervarea biletelor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
