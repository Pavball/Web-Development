<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>L'OBS</title>
</head>
<body>
  <header>
    <h1>L'OBS</h1>
  </header>
  
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="kategorija.php?kategorija=sport">Sport</a></li>
      <li><a href="kategorija.php?kategorija=kultura">Kultura</a></li>
      <li><a href="unos.html">Unos</a></li>
      <li><a href="login.php">Administracija</a></li>
    </ul>
  </nav>

  <div class="admin-panel">
    <?php
    session_start();

    if (isset($_SESSION['korisnik'])) {
      header('Location: administracija.php');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];
      
        // Spajanje na bazu
        $mysqli = mysqli_connect("localhost:3307", "marco", "root", "projektni2");
      
        // Provjera povezivanja s bazom
        if (mysqli_connect_errno()) {
            echo "Neuspjelo povezivanje s bazom podataka: " . mysqli_connect_error();
            exit();
        }
      
        $stmt = mysqli_prepare($mysqli, "SELECT id, korisnicko_ime, ime, prezime, lozinka, administratorska_prava FROM korisnik WHERE korisnicko_ime = ?");
        mysqli_stmt_bind_param($stmt, "s", $korisnicko_ime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 1) {
            mysqli_stmt_bind_result($stmt, $id, $korisnicko_ime, $ime, $prezime, $hash_lozinke, $admin);
            mysqli_stmt_fetch($stmt);
      
            if (password_verify($lozinka, $hash_lozinke) == true) {
                
                if ($admin) {
                    // Korisnik je administrator
                    $_SESSION['korisnik'] = $korisnicko_ime;
                    session_destroy();
                    header('Location: administracija.php');
                    exit();
                } else {

                    // Korisnik nije administrator
                    echo '<p class="poruka">Nemate pristup administracijskom panelu.</p>';
                    session_destroy();
                }
            } else {

                // Pogrešna lozinka
                echo '<p class="poruka">Pogrešno korisničko ime ili lozinka.</p>';
                echo '<p>Morate se prvo <a href="registracija.php">REGISTRIRATI</a>.</p>';
            }
        } else {
            // Korisnik ne postoji
            echo '<p class="poruka">Pogrešno korisničko ime ili lozinka.</p>';
            echo '<p>Morate se prvo <a href="registracija.php">REGISTRIRATI</a>.</p>';
        }
      
    
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
    }
    
    ?>

    <h2>Prijava</h2>
    <form method="POST" action="">
      <div class="form-item">
        <label for="korisnicko_ime">Korisničko ime:</label>
        <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
      </div>
      <div class="form-item">
        <label for="lozinka">Lozinka:</label>
        <input type="password" id="lozinka" name="lozinka" required>
      </div>
      <div class="form-item">
        <input type="submit" value="Prijavi se" name="prijavi_se">
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2023 L'OBS.</p>
  </footer>
</body>
</html>
