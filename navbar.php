<?php
// Determină pagina curentă pentru a evidenția link-ul activ
$pagina_curenta = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <span class="fs-4 fw-bold text-danger me-2">🗼</span>
            <span class="fw-bold">Tokyo</span>
            <span class="text-danger ms-1">Explorer</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'index.php') ? 'active' : ''; ?>" href="index.php">
                        <i class="bi bi-house-door me-1"></i>Acasă
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'atractii.php') ? 'active' : ''; ?>" href="pages/atractii.php">
                        <i class="bi bi-geo-alt me-1"></i>Atracții
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'restaurante.php') ? 'active' : ''; ?>" href="pages/restaurante.php">
                        <i class="bi bi-cup-hot me-1"></i>Restaurante
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'cazare.php') ? 'active' : ''; ?>" href="pages/cazare.php">
                        <i class="bi bi-building me-1"></i>Cazare
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'evenimente.php') ? 'active' : ''; ?>" href="pages/evenimente.php">
                        <i class="bi bi-calendar-event me-1"></i>Evenimente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'transport.php') ? 'active' : ''; ?>" href="pages/transport.php">
                        <i class="bi bi-train-front me-1"></i>Transport
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'rezervari.php') ? 'active' : ''; ?>" href="pages/rezervari.php">
                        <i class="bi bi-calendar-check me-1"></i>Rezervări
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_curenta == 'contact.php') ? 'active' : ''; ?>" href="pages/contact.php">
                        <i class="bi bi-envelope me-1"></i>Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Spațiu pentru navbar fixed -->
<div style="height: 76px;"></div>
