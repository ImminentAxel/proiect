<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descoperă Tokyo - capitala fascinantă a Japoniei. Atracții turistice, restaurante, cazare și evenimente.">
    <title>Tokyo Explorer - Descoperă Capitala Japoniei</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<?php
// Procesare formular newsletter
$mesaj_newsletter = '';
$tip_mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    require_once 'config.php';
    
    $email = filter_var(trim($_POST['newsletter_email']), FILTER_VALIDATE_EMAIL);
    
    if ($email) {
        try {
            // Verifică dacă email-ul există deja
            $stmt = $pdo->prepare("SELECT id FROM newsletter WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                $mesaj_newsletter = 'Acest email este deja abonat la newsletter!';
                $tip_mesaj = 'warning';
            } else {
                // Inserează email-ul
                $stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (?)");
                $stmt->execute([$email]);
                $mesaj_newsletter = 'Te-ai abonat cu succes la newsletter! ありがとう (Mulțumim!)';
                $tip_mesaj = 'success';
            }
        } catch (PDOException $e) {
            $mesaj_newsletter = 'Eroare la procesare. Te rugăm încearcă din nou.';
            $tip_mesaj = 'danger';
        }
    } else {
        $mesaj_newsletter = 'Te rugăm introdu o adresă de email validă.';
        $tip_mesaj = 'danger';
    }
}
?>

<!-- Hero Section cu Carousel -->
<section id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=1920');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold mb-3">Bine ai venit în Tokyo</h1>
                <p class="lead mb-4">Descoperă orașul unde tradiția întâlnește viitorul</p>
                <a href="pages/atractii.php" class="btn btn-danger btn-lg px-5">
                    Explorează <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="carousel-item">
            <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w=1920');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold mb-3">Temple și Sanctuare</h1>
                <p class="lead mb-4">Experimentează spiritualitatea și liniștea Japoniei antice</p>
                <a href="pages/atractii.php" class="btn btn-danger btn-lg px-5">
                    Descoperă <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="carousel-item">
            <div class="carousel-image" style="background-image: url('https://images.unsplash.com/photo-1536098561742-ca998e48cbcc?w=1920');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold mb-3">Bucătărie Autentică</h1>
                <p class="lead mb-4">Savurează cele mai bune arome japoneze</p>
                <a href="pages/restaurante.php" class="btn btn-danger btn-lg px-5">
                    Gustă <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>

<!-- Secțiune Introducere -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-danger mb-3">東京</span>
                <h2 class="display-5 fw-bold mb-4">De ce să vizitezi Tokyo?</h2>
                <p class="lead text-secondary mb-4">
                    Tokyo este o metropolă fascinantă care îmbină perfect tradiția milenară cu inovația futuristă. 
                    Cu peste 37 de milioane de locuitori, este cel mai mare oraș din lume.
                </p>
<div class="row g-3">
    <!-- Arhitectură unică -->
    <div class="col-6">
        <div class="d-flex align-items-center">
            <div class="bg-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-building text-white" style="font-size: 24px;"></i>
            </div>
            <span class="ms-3">Arhitectură unică</span>
        </div>
    </div>
    
    <!-- Gastronomie de top -->
    <div class="col-6">
        <div class="d-flex align-items-center">
            <div class="bg-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-cup-hot text-white" style="font-size: 24px;"></i>
            </div>
            <span class="ms-3">Gastronomie de top</span>
        </div>
    </div>
    
    <!-- Grădini zen -->
    <div class="col-6">
        <div class="d-flex align-items-center">
            <div class="bg-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-tree text-white" style="font-size: 24px;"></i>
            </div>
            <span class="ms-3">Grădini zen</span>
        </div>
    </div>
    
    <!-- Shopping infinit -->
    <div class="col-6">
        <div class="d-flex align-items-center">
            <div class="bg-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-shop text-white" style="font-size: 24px;"></i>
            </div>
            <span class="ms-3">Shopping infinit</span>
        </div>
    </div>
</div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=600" 
                         class="img-fluid rounded-4 shadow-lg" alt="Tokyo cityscape">
                    <div class="position-absolute bottom-0 start-0 bg-danger text-white p-3 rounded-end">
                        <h4 class="mb-0">37M+</h4>
                        <small>Locuitori</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Secțiuni Rapide -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-danger mb-2">Explorează</span>
            <h2 class="display-6 fw-bold">Ce poți descoperi în Tokyo</h2>
            <p class="text-secondary">Alege categoria care te interesează</p>
        </div>
        
        <div class="row g-4">
            <!-- Card Atracții -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/atractii.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1480796927426-f609979314bd?w=400" 
                             class="card-img-top" alt="Atracții turistice">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                            <h5 class="card-title mb-0">Atracții Turistice</h5>
                        </div>
                        <p class="card-text text-secondary">
                            De la Tokyo Tower la Senso-ji Temple, descoperă cele mai iconice locuri.
                        </p>
                    </div>
                </a>
            </div>
            
            <!-- Card Restaurante -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/restaurante.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=400" 
                             class="card-img-top" alt="Restaurante">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-cup-hot-fill text-danger me-2"></i>
                            <h5 class="card-title mb-0">Restaurante</h5>
                        </div>
                        <p class="card-text text-secondary">
                            Sushi, ramen, tempura și multe alte delicii culinare japoneze.
                        </p>
                    </div>
                </a>
            </div>
            
            <!-- Card Cazare -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/cazare.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=400" 
                             class="card-img-top" alt="Cazare">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-building text-danger me-2"></i>
                            <h5 class="card-title mb-0">Cazare</h5>
                        </div>
                        <p class="card-text text-secondary">
                            Hoteluri de lux, hosteluri sau ryokan-uri tradiționale.
                        </p>
                    </div>
                </a>
            </div>
            
            <!-- Card Evenimente -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/evenimente.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400" 
                             class="card-img-top" alt="Evenimente">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar-event-fill text-danger me-2"></i>
                            <h5 class="card-title mb-0">Evenimente</h5>
                        </div>
                        <p class="card-text text-secondary">
                            Festivaluri, expoziții și evenimente culturale pe tot parcursul anului.
                        </p>
                    </div>
                </a>
            </div>
            
            <!-- Card Transport -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/transport.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1624601573012-efb68931cc8f?w=400" 
                             class="card-img-top" alt="Transport">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-train-front-fill text-danger me-2"></i>
                            <h5 class="card-title mb-0">Transport</h5>
                        </div>
                        <p class="card-text text-secondary">
                            Ghid complet pentru metrou, trenuri și alte mijloace de transport.
                        </p>
                    </div>
                </a>
            </div>
            
            <!-- Card Rezervări -->
            <div class="col-lg-4 col-md-6">
                <a href="pages/rezervari.php" class="card card-hover text-decoration-none h-100">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=400" 
                             class="card-img-top" alt="Rezervări">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar-check-fill text-danger me-2"></i>
                            <h5 class="card-title mb-0">Rezervări</h5>
                        </div>
                        <p class="card-text text-secondary">
                            Rezervă restaurante, tururi ghidate și experiențe unice.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="badge bg-danger mb-3">ニュースレター</span>
                <h2 class="display-6 fw-bold mb-3">Abonează-te la Newsletter</h2>
                <p class="text-secondary mb-4">
                    Primește cele mai noi informații despre evenimente, oferte și sfaturi pentru călătoria ta în Tokyo.
                </p>
                
                <?php if ($mesaj_newsletter): ?>
                <div class="alert alert-<?php echo $tip_mesaj; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mesaj_newsletter; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="index.php" class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-envelope text-danger"></i>
                            </span>
                            <input type="email" name="newsletter_email" class="form-control border-0" 
                                   placeholder="Adresa ta de email" required>
                            <button class="btn btn-danger px-4" type="submit">
                                Abonează-te <i class="bi bi-send ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                <p class="small text-secondary mt-3">
                    <i class="bi bi-shield-check me-1"></i>
                    Nu trimitem spam. Poți dezabona oricând.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Statistici -->
<section class="py-5 bg-danger text-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3 col-6">
                <div class="display-4 fw-bold">2000+</div>
                <p class="mb-0">Temple și sanctuare</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="display-4 fw-bold">160k+</div>
                <p class="mb-0">Restaurante</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="display-4 fw-bold">13</div>
                <p class="mb-0">Linii de metrou</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="display-4 fw-bold">23</div>
                <p class="mb-0">Cartiere speciale</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="index.php"]');
    const newsletterSection = document.getElementById('newsletter-section');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');
            const newAlert = newDoc.querySelector('.alert');
            
            if (newAlert) {
                const existingAlert = form.parentElement.querySelector('.alert');
                if (existingAlert) existingAlert.remove();
                form.parentElement.insertBefore(newAlert, form);
                
                // Scroll la alert
                newAlert.scrollIntoView({behavior: 'smooth', block: 'center'});
            }
            
            // Golește inputul
            form.querySelector('input[name="newsletter_email"]').value = '';
        })
        .catch(error => console.error('Eroare:', error));
    });
});
</script>
</body>
</html>
