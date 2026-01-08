# 🗼 Tokyo Explorer - Site de promovare Tokyo

Site web PHP + Bootstrap 5 + MySQL pentru promovarea orașului Tokyo.

## 📁 Structura proiectului

```
/tokyo-site
 ├── index.php          # Pagina principală cu carousel și newsletter
 ├── navbar.php         # Componenta navbar comună
 ├── footer.php         # Componenta footer comună
 ├── config.php         # Configurare conexiune MySQL
 ├── README.md          # Documentație
 ├── /css
 │    └── style.css     # Stiluri personalizate
 ├── /img               # Folder pentru imagini locale (gol)
 ├── /sql
 │    └── database.sql  # Script creare bază de date + date demo
 └── /pages
      ├── restaurante.php   # Pagină restaurante
      ├── rezervari.php     # Formular rezervări
      ├── atractii.php      # Atracții turistice
      ├── cazare.php        # Opțiuni cazare
      ├── evenimente.php    # Evenimente și festivaluri
      ├── transport.php     # Ghid transport
      └── contact.php       # Formular contact
```

## 🚀 Instalare

### 1. Cerințe
- XAMPP (sau WAMP/MAMP)
- Browser modern

### 2. Pași instalare

1. **Copiază folderul `tokyo-site`** în directorul `htdocs` din XAMPP:
   ```
   C:\xampp\htdocs\proiect
   ```

2. **Pornește XAMPP** și activează:
   - Apache
   - MySQL

3. **Creează baza de date:**
   - Deschide http://localhost/phpmyadmin
   - Importă fișierul `sql/database.sql` sau rulează conținutul lui

4. **Accesează site-ul:**
   - Deschide http://localhost/proiect

## 📊 Tabele MySQL

| Tabel | Descriere |
|-------|-----------|
| `newsletter` | Abonați newsletter (email) |
| `restaurante` | Lista restaurante |
| `rezervari` | Rezervări clienți |
| `atractii` | Atracții turistice |
| `cazare` | Opțiuni cazare |
| `evenimente` | Evenimente și festivaluri |
| `transport` | Informații transport |
| `contact_mesaje` | Mesaje primite |

## 🎨 Tehnologii folosite

- **Frontend:** HTML5, CSS3, Bootstrap 5.3
- **Backend:** PHP 7+
- **Database:** MySQL
- **Icons:** Bootstrap Icons
- **Fonts:** Google Fonts (Poppins, Noto Sans JP)

## 📝 Formulare funcționale

1. **Newsletter** (index.php) - Salvează email în tabelul `newsletter`
2. **Rezervări** (pages/rezervari.php) - Salvează rezervări
3. **Contact** (pages/contact.php) - Salvează mesaje de contact

## ⚙️ Configurare

Editează `config.php` pentru a modifica credențialele MySQL dacă e necesar:

```php
$host = 'localhost';
$dbname = 'tokyo_db';
$username = 'root';
$password = '';
```

