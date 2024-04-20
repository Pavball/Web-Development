<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>L'OBS - Registracija</title>
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

  <div class="registracija">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $korisnicko_ime = $_POST['korisnicko_ime'];
      $ime = $_POST['ime'];
      $prezime = $_POST['prezime'];
      $lozinka = $_POST['lozinka'];
      $lozinka_potvrda = $_POST['lozinka_potvrda'];

      // Provjeri jesu li unesene lozinke identične
      if ($lozinka !== $lozinka_potvrda) {
        echo '<p class="poruka">Lozinke se ne podudaraju.</p>';
      } else {
        // Spajanje na bazu
        $mysqli = mysqli_connect("localhost:3307", "marco", "root", "projektni2");

        // Provjera povezivanja s bazom
        if (mysqli_connect_errno()) {
          echo "Neuspjelo povezivanje s bazom podataka: " . mysqli_connect_error();
          exit();
        }

        // Provjeri postoji li već korisnik s istim korisničkim imenom
        $stmt = mysqli_prepare($mysqli, "SELECT * FROM korisnik WHERE korisnicko_ime = ?");
        mysqli_stmt_bind_param($stmt, "s", $korisnicko_ime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
          echo '<p class="poruka">Korisničko ime već postoji. Molimo odaberite drugo korisničko ime.</p>';
        } else {
          //Hash lozinka
          $hash_lozinke = password_hash($lozinka, CRYPT_BLOWFISH);

          // Priprema upita za unos korisnika
          $stmt = mysqli_prepare($mysqli, "INSERT INTO korisnik (korisnicko_ime, ime, prezime, lozinka, administratorska_prava) VALUES (?, ?, ?, ?, 0)");
          mysqli_stmt_bind_param($stmt, "ssss", $korisnicko_ime, $ime, $prezime, $hash_lozinke);
          mysqli_stmt_execute($stmt);

          echo '<p class="porukaUspijeh">Registracija je uspješno završena. Molimo prijavite se. <a href="login.php">OVDJE</a></p>';
        }

       
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
      }
    }
    ?>

    <h2>Registracija</h2>
    <form method="POST" action="">
      <div class="form-item">
        <label for="korisnicko_ime">Korisničko ime:</label>
        <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
      </div>
      <div class="form-item">
        <label for="ime">Ime:</label>
        <input type="text" id="ime" name="ime" required>
      </div>
      <div class="form-item">
        <label for="prezime">Prezime:</label>
        <input type="text" id="prezime" name="prezime" required>
      </div>
      <div class="form-item">
        <label for="lozinka">Lozinka:</label>
        <input type="password" id="lozinka" name="lozinka" required>
      </div>
      <div class="form-item">
        <label for="lozinka_potvrda">Potvrda lozinke:</label>
        <input type="password" id="lozinka_potvrda" name="lozinka_potvrda" required>
      </div>
      <div class="form-item">
        <input type="submit" value="Registriraj se">
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2023 L'OBS.</p>
  </footer>
</body>
</html>
