<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contactează-ne pentru orice întrebare despre călătoria ta în Tokyo.">
    <title>Contact - Tokyo Explorer</title>
    
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
                <li class="nav-item"><a class="nav-link" href="evenimente.php"><i class="bi bi-calendar-event me-1"></i>Evenimente</a></li>
                <li class="nav-item"><a class="nav-link" href="transport.php"><i class="bi bi-train-front me-1"></i>Transport</a></li>
                <li class="nav-item"><a class="nav-link" href="rezervari.php"><i class="bi bi-calendar-check me-1"></i>Rezervări</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php"><i class="bi bi-envelope me-1"></i>Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="height: 76px;"></div>

<!-- Page Header -->
<section class="page-header text-white text-center">
    <div class="container">
        <span class="badge bg-danger mb-3">連絡</span>
        <h1 class="display-4 fw-bold">Contactează-ne</h1>
        <p class="lead">Suntem aici să te ajutăm cu planificarea călătoriei</p>
    </div>
</section>

<?php
require_once '../config.php';

$mesaj = '';
$tip_mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = trim($_POST['nume'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subiect = trim($_POST['subiect'] ?? '');
    $mesaj_text = trim($_POST['mesaj'] ?? '');
    
    $erori = [];
    if (empty($nume)) $erori[] = 'Numele este obligatoriu.';
    if (!$email) $erori[] = 'Email-ul nu este valid.';
    if (empty($mesaj_text)) $erori[] = 'Mesajul este obligatoriu.';
    
    if (empty($erori)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_mesaje (nume, email, subiect, mesaj) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nume, $email, $subiect, $mesaj_text]);
            
            $mesaj = 'Mesajul a fost trimis cu succes! Te vom contacta în curând.';
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

<!-- Conținut Contact -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Info Contact -->
            <div class="col-lg-4">
                <div class="card bg-dark text-white border-0 h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Informații de contact</h4>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-danger rounded-circle p-3 me-3">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Adresă</h6>
                                <p class="text-secondary mb-0">Tokyo, Japan<br>Shibuya District</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-danger rounded-circle p-3 me-3">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Email</h6>
                                <p class="text-secondary mb-0">info@tokyo-explorer.jp<br>support@tokyo-explorer.jp</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-danger rounded-circle p-3 me-3">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Telefon</h6>
                                <p class="text-secondary mb-0">+81 3-1234-5678<br>+81 3-8765-4321</p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="bg-danger rounded-circle p-3 me-3">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Program</h6>
                                <p class="text-secondary mb-0">Luni - Vineri: 09:00 - 18:00<br>Sâmbătă: 10:00 - 14:00</p>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="mb-3">Urmărește-ne</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formular Contact -->
            <div class="col-lg-8">
                <?php if ($mesaj): ?>
                <div class="alert alert-<?php echo $tip_mesaj; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mesaj; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h4 class="mb-4">Trimite-ne un mesaj</h4>
                        
                        <form method="POST" action="contact.php">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="nume" class="form-label">Nume <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nume" name="nume" required 
                                           placeholder="Numele tău">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" required 
                                           placeholder="email@example.com">
                                </div>
                                
                                <div class="col-12">
                                    <label for="subiect" class="form-label">Subiect</label>
                                    <input type="text" class="form-control form-control-lg" id="subiect" name="subiect" 
                                           placeholder="Despre ce dorești să ne întrebi?">
                                </div>
                                
                                <div class="col-12">
                                    <label for="mesaj" class="form-label">Mesaj <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="mesaj" name="mesaj" rows="5" required 
                                              placeholder="Scrie mesajul tău aici..."></textarea>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="bi bi-send me-2"></i>Trimite mesajul
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
