<?php
// 1. Conectare la baza de date
require_once '../config.php';

$mesaj = "";

// --- LOGICA PHP PENTRU ADĂUGARE (INSERT) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actiune']) && $_POST['actiune'] == 'adauga') {
    try {
        // Preluăm datele
        $tip = isset($_POST['tip']) ? $_POST['tip'] : 'Hotel';
        // Dacă nu se pune imagine la adăugare, punem una default
        $img_default = 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800';
        $imagine_form = !empty($_POST['imagine']) ? $_POST['imagine'] : $img_default;

        $sql = "INSERT INTO cazare (nume, descriere, pret_noapte, stele, adresa, imagine, tip) 
                VALUES (:nume, :descriere, :pret, :stele, :adresa, :imagine, :tip)";
        
        $stmt = $pdo->prepare($sql);
        $executa = $stmt->execute([
            ':nume' => $_POST['nume'],
            ':descriere' => $_POST['descriere'],
            ':pret' => $_POST['pret'],
            ':stele' => $_POST['stele'],
            ':adresa' => $_POST['adresa'],
            ':imagine' => $imagine_form,
            ':tip' => $tip
        ]);

        if ($executa) {
            $mesaj = '<div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">
                        <strong>Succes!</strong> Cazarea a fost adăugată.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
        }
    } catch (PDOException $e) {
        $mesaj = '<div class="alert alert-danger container mt-3">Eroare SQL: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cazare Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        /* CSS Personalizat */
        body { background-color: #f8f9fa; }
        .page-header {
            background-color: #212529;
            color: #fff;
            padding: 60px 0;
            border-bottom: 4px solid #dc3545;
        }
        .hotel-card {
            border: none;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            overflow: hidden;
            margin-bottom: 25px;
        }
        .hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .hotel-img-wrapper {
            height: 100%;
            min-height: 240px;
            background-color: #eee; /* Fundal gri cât se încarcă poza */
        }
        .hotel-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .price-badge {
            font-size: 1.2rem;
            font-weight: 800;
            color: #dc3545;
        }
    </style>
</head>
<body>

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

<div class="page-header text-center">
    <div class="container">
        <span class="badge bg-danger mb-2">宿泊</span>
        <h1 class="fw-bold display-5">Cazare în Tokyo</h1>
        <p class="lead text-white-50">Descoperă locurile preferate ale comunității noastre.</p>
    </div>
</div>

<div class="container py-5">
    
    <?php echo $mesaj; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-secondary border-start border-4 border-danger ps-3">Oferte Disponibile</h4>
        <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAdaugare">
            <i class="bi bi-plus-circle"></i> Adaugă Unitate
        </button>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM cazare ORDER BY pret_noapte DESC");
                $cazari = $stmt->fetchAll();
                
                if (count($cazari) > 0) {
                    foreach ($cazari as $row) {
                        // 1. GESTIONARE DATE LIPSĂ
                        $adresa = isset($row['adresa']) ? $row['adresa'] : (isset($row['locatie']) ? $row['locatie'] : 'Tokyo, Japan');
                        $tip = isset($row['tip']) ? $row['tip'] : 'Hotel';
                        
                        // 2. GESTIONARE IMAGINI (FIX-UL PENTRU POZE)
                        $img_db = $row['imagine'];
                        $img_src = "";

                        if (empty($img_db)) {
                            // Dacă câmpul e gol în baza de date -> Imagine Default (Unsplash)
                            $img_src = 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800';
                        } elseif (strpos($img_db, 'http') === 0) {
                            // Dacă începe cu http -> E link extern, îl lăsăm așa
                            $img_src = $img_db;
                        } else {
                            // Altfel -> E fișier local, punem calea
                            $img_src = "../img/" . $img_db;
                        }

                        // 3. Generare stele
                        $stars = "";
                        for($i=0; $i < $row['stele']; $i++) { $stars .= '<i class="bi bi-star-fill text-warning"></i> '; }
                        
                        echo '
                        <div class="card hotel-card">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="hotel-img-wrapper position-relative">
                                        <img src="' . htmlspecialchars($img_src) . '" alt="Imagine Hotel" onerror="this.src=\'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800\'">
                                        <span class="position-absolute top-0 start-0 m-2 badge bg-danger">' . htmlspecialchars($tip) . '</span>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body p-4 d-flex flex-column h-100 justify-content-center">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h3 class="card-title fw-bold mb-0">' . htmlspecialchars($row['nume']) . '</h3>
                                            <span class="price-badge">¥' . number_format($row['pret_noapte']) . '</span>
                                        </div>
                                        
                                        <div class="mb-2">' . $stars . '</div>
                                        
                                        <p class="text-muted mb-3 small">
                                            <i class="bi bi-geo-alt-fill text-danger"></i> ' . htmlspecialchars($adresa) . '
                                        </p>
                                        
                                        <p class="card-text text-secondary mb-3">' . htmlspecialchars(substr($row['descriere'], 0, 150)) . '...</p>
                                        
                                        <div class="text-end mt-auto">
                                            <a href="rezervari.php" class="btn btn-outline-dark rounded-pill px-4">
                                                Vezi & Rezervă
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-info text-center">Nu există cazări. Adaugă una folosind butonul din dreapta sus!</div>';
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger">Eroare la încărcare: ' . $e->getMessage() . '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarAdaugare">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title"><i class="bi bi-building-add"></i> Adaugă Cazare</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="POST">
            <input type="hidden" name="actiune" value="adauga">
            
            <div class="mb-3">
                <label class="form-label fw-bold">Nume Unitate</label>
                <input type="text" name="nume" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tip Cazare</label>
                <select name="tip" class="form-select">
                    <option value="Hotel">Hotel</option>
                    <option value="Ryokan">Ryokan (Tradițional)</option>
                    <option value="Hostel">Hostel (Capsule)</option>
                    <option value="Apartament">Apartament</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Adresă / Zonă</label>
                <input type="text" name="adresa" class="form-control" required placeholder="ex: Shinjuku, Tokyo">
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6">
                    <label class="form-label fw-bold">Preț (¥)</label>
                    <input type="number" name="pret" class="form-control" required>
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold">Stele</label>
                    <select name="stele" class="form-select">
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3" selected>⭐⭐⭐</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Link Imagine</label>
                <input type="text" name="imagine" class="form-control" placeholder="https://...">
                <div class="form-text text-muted">Lasă gol pentru imagine automată.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descriere</label>
                <textarea name="descriere" class="form-control" rows="4" required></textarea>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-danger py-2">Salvează</button>
            </div>
        </form>
    </div>
</div>

<?php include '../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>