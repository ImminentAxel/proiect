<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante Tokyo - Tokyo Explorer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        
        .hero-banner {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1554797589-7241bb691973?q=80&w=1936');
            background-size: cover;
            background-position: center;
            padding: 100px 0 120px 0;
            color: white;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .filter-section {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 25px;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .card-img-wrapper { height: 220px; overflow: hidden; position: relative; }
        .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
        .card-hover:hover .card-img-wrapper img { transform: scale(1.05); }
        .card-hover { transition: transform 0.3s, box-shadow 0.3s; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        .review-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>

<?php 
require_once '../config.php'; 

// --- 1. LOGICA INSERT RECENZIE ---
$msg_insert = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_review') {
    try {
        $sql_insert = "INSERT INTO recenzii (restaurant_id, nume_utilizator, rating, comentariu) VALUES (?, ?, ?, ?)";
        $stmt_insert = $pdo->prepare($sql_insert);
        
        $stmt_insert->execute([
            $_POST['restaurant_id'],
            $_POST['nume_utilizator'],
            $_POST['rating'],
            $_POST['comentariu']
        ]);
        
        $msg_insert = '<div class="alert alert-success alert-dismissible fade show container position-fixed top-0 start-50 translate-middle-x mt-5" style="z-index: 2000; width: 90%; max-width:600px;">
            <i class="bi bi-check-circle-fill me-2"></i>Recenzia ta a fost adăugată!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    } catch (PDOException $e) {
        $msg_insert = '<div class="alert alert-danger container mt-3">Eroare: '.$e->getMessage().'</div>';
    }
}

// --- 2. LOGICA SELECT & FILTRARE ---
$where_clauses = ["1=1"];
$params = [];
$selected_cuisine = $_GET['cuisine'] ?? '';
$search_query = $_GET['q'] ?? '';
$price_range = $_GET['price'] ?? '';

if (!empty($selected_cuisine)) {
    $where_clauses[] = "tip_bucatarie = ?";
    $params[] = $selected_cuisine;
}
if (!empty($search_query)) {
    $where_clauses[] = "(nume LIKE ? OR descriere LIKE ?)";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
}
if ($price_range === 'low') $where_clauses[] = "pret_mediu < 2000";
elseif ($price_range === 'medium') $where_clauses[] = "pret_mediu BETWEEN 2000 AND 6000";
elseif ($price_range === 'high') $where_clauses[] = "pret_mediu > 6000";

$sql = "SELECT * FROM restaurante WHERE " . implode(" AND ", $where_clauses) . " ORDER BY rating DESC";

try {
    $stmt_c = $pdo->query("SELECT DISTINCT tip_bucatarie FROM restaurante ORDER BY tip_bucatarie");
    $cuisines = $stmt_c->fetchAll(PDO::FETCH_COLUMN);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $restaurante = $stmt->fetchAll();
} catch (PDOException $e) {
    $restaurante = [];
    $cuisines = [];
    $error_msg = $e->getMessage();
}
?>

<?php 
// Ajustare cale pentru navbar din subdirector
$base_path = '../';
?>

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

<?php echo $msg_insert; ?>

<section class="hero-banner">
    <div class="container">
        <span class="badge bg-danger mb-3 px-3 py-2 rounded-pill">Ghid Gastronomic</span>
        <h1 class="display-4 fw-bold mb-3">Restaurante Tokyo</h1>
        <p class="lead opacity-75">Citește recenzii autentice și descoperă locuri noi</p>
    </div>
</section>

<section class="container filter-section">
    <div class="filter-card">
        <form method="GET" action="" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-secondary">Căutare</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-danger"></i></span>
                    <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Ex: Sushi, Ramen..." value="<?php echo htmlspecialchars($search_query); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-secondary">Specific</label>
                <select name="cuisine" class="form-select">
                    <option value="">Toate</option>
                    <?php foreach($cuisines as $c): ?>
                        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $selected_cuisine === $c ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($c); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-secondary">Buget</label>
                <select name="price" class="form-select">
                    <option value="">Oricare</option>
                    <option value="low" <?php echo $price_range === 'low' ? 'selected' : ''; ?>>Economic (< ¥2000)</option>
                    <option value="medium" <?php echo $price_range === 'medium' ? 'selected' : ''; ?>>Mediu (¥2000-6000)</option>
                    <option value="high" <?php echo $price_range === 'high' ? 'selected' : ''; ?>>Premium (> ¥6000)</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-danger w-100 fw-bold">Filtrează</button>
            </div>
        </form>
    </div>
</section>

<section class="py-5 container">
    <?php if (isset($error_msg)): ?>
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-triangle me-2"></i> Eroare conexiune: <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (count($restaurante) > 0): ?>
            <?php foreach ($restaurante as $r): ?>
                <?php 
                    // Fallback Imagini
                    $img = 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=500'; 
                    if(strpos(strtolower($r['nume']), 'sushi') !== false) $img = 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=500';
                    if(strpos(strtolower($r['nume']), 'ramen') !== false) $img = 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?w=500';
                    if(strpos(strtolower($r['nume']), 'burger') !== false) $img = 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=500';
                    if(strpos(strtolower($r['nume']), 'pizza') !== false) $img = 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=500';
                ?>
                
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 card-hover border-0 shadow-sm">
                        <div class="card-img-wrapper">
                            <span class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 m-3 rounded-pill small fw-bold shadow">
                                ¥<?php echo number_format($r['pret_mediu']); ?>
                            </span>
                            <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($r['nume']); ?>">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title fw-bold mb-0 text-truncate"><?php echo htmlspecialchars($r['nume']); ?></h5>
                                <span class="text-warning fw-bold"><i class="bi bi-star-fill"></i> <?php echo $r['rating']; ?></span>
                            </div>
                            <span class="badge bg-light text-dark border mb-3"><?php echo htmlspecialchars($r['tip_bucatarie']); ?></span>
                            <p class="card-text small text-muted text-truncate">
                                <?php echo htmlspecialchars($r['descriere']); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3 pt-0">
                            <button class="btn btn-outline-dark btn-sm w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal<?php echo $r['id']; ?>">
                                <i class="bi bi-eye me-1"></i> Vezi detalii & Recenzii
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal<?php echo $r['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold"><?php echo htmlspecialchars($r['nume']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body pt-0">
                                <div class="row">
                                    <div class="col-md-5 border-end">
                                        <div class="p-3 bg-light rounded mb-3">
                                            <p class="mb-2"><i class="bi bi-geo-alt text-danger me-2"></i><?php echo htmlspecialchars($r['adresa']); ?></p>
                                            <p class="mb-2"><i class="bi bi-clock text-danger me-2"></i><?php echo htmlspecialchars($r['program']); ?></p>
                                            <p class="mb-0 fw-bold"><i class="bi bi-wallet2 text-danger me-2"></i>¥<?php echo number_format($r['pret_mediu']); ?></p>
                                        </div>
                                        <p class="text-secondary small"><?php echo htmlspecialchars($r['descriere']); ?></p>
                                        <a href="rezervari.php?id=<?php echo $r['id']; ?>" class="btn btn-danger w-100 mt-2">Rezervă Masă</a>
                                    </div>

                                    <div class="col-md-7">
                                        <h6 class="fw-bold mb-3 border-bottom pb-2">Recenzii Clienți</h6>
                                        
                                        <div class="overflow-auto mb-3 pe-2" style="max-height: 300px;">
                                            <?php
                                            $reviews = [];
                                            try {
                                                $stmt_reviews = $pdo->prepare("SELECT * FROM recenzii WHERE restaurant_id = ? ORDER BY id DESC");
                                                $stmt_reviews->execute([$r['id']]);
                                                $reviews = $stmt_reviews->fetchAll();
                                            } catch (PDOException $e) { }
                                            ?>

                                            <?php if(count($reviews) > 0): ?>
                                                <?php foreach($reviews as $rev): ?>
                                                    <div class="review-box">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <strong class="small text-dark"><?php echo htmlspecialchars($rev['nume_utilizator']); ?></strong>
                                                            <div class="text-warning small" style="letter-spacing: -2px;">
                                                                <?php for($i=0; $i<5; $i++) echo ($i < $rev['rating']) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star text-muted opacity-25"></i>'; ?>
                                                            </div>
                                                        </div>
                                                        <p class="small text-secondary mb-0 mt-1 fst-italic">
                                                            "<?php echo htmlspecialchars($rev['comentariu']); ?>"
                                                        </p>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="text-center py-4 text-muted">
                                                    <i class="bi bi-chat-square-text fs-3 d-block mb-2 opacity-25"></i>
                                                    <small>Fii primul care scrie o recenzie!</small>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="card border-0 bg-light p-3">
                                            <h6 class="small fw-bold mb-2">Lasă o recenzie:</h6>
                                            <form method="POST" action="">
                                                <input type="hidden" name="action" value="add_review">
                                                <input type="hidden" name="restaurant_id" value="<?php echo $r['id']; ?>">
                                                
                                                <div class="row g-2 mb-2">
                                                    <div class="col-8">
                                                        <input type="text" name="nume_utilizator" class="form-control form-control-sm" placeholder="Numele tău" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="rating" class="form-select form-select-sm text-warning fw-bold" required>
                                                            <option value="5" class="text-dark">5 ★</option>
                                                            <option value="4" class="text-dark">4 ★</option>
                                                            <option value="3" class="text-dark">3 ★</option>
                                                            <option value="2" class="text-dark">2 ★</option>
                                                            <option value="1" class="text-dark">1 ★</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <textarea name="comentariu" class="form-control form-control-sm mb-2" placeholder="Cum a fost experiența?" rows="2" required></textarea>
                                                <button type="submit" class="btn btn-dark btn-sm w-100">Postează</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-search display-1 text-muted opacity-25"></i>
                <h3 class="mt-3">Nu am găsit rezultate</h3>
                <a href="restaurante.php" class="btn btn-outline-danger">Resetează filtrele</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>