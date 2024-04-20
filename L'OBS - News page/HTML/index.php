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

  <main>
    <h2>Sport</h2>
    <div class="clanci">
      <?php
      // Uspostavljanje veze s bazom
      $host = 'localhost:3307';
      $dbName = 'projektni2';
      $username = 'marco';
      $password = 'root';

      $conn = mysqli_connect($host, $username, $password, $dbName);

      // Provjera veze s bazom
      if (!$conn) {
        die('Greška prilikom povezivanja s bazom podataka: ' . mysqli_connect_error());
      }

      // SQL upit za dohvaćanje vijesti iz kategorije "Sport"
      $sqlSport = "SELECT * FROM vijest WHERE kategorija = 'sport' AND arhiva = 0 LIMIT 3";
      $resultSport = mysqli_query($conn, $sqlSport);
      
      // Prikazivanje vijesti iz kategorije "Sport"
      while ($rowSport = mysqli_fetch_assoc($resultSport)) {
        echo '<div class="clanak">';
        echo '<a href="clanak.php?id=' . $rowSport['id'] . '">';
        echo '<img src="' . $rowSport['slika'] . '" alt="Slika">';
        echo '<h3>' . $rowSport['naslov'] . '</h3>';
        echo '<p>' . $rowSport['sazetak'] . '</p>';
        echo '</a>';
        echo '</div>';
      }

      // Zatvaranje veze s bazom
      mysqli_close($conn);
      ?>
    </div>

    <h2>Kultura</h2>
    <div class="clanci">
      <?php
      // Uspostavljanje veze s bazom
      $host = 'localhost:3307';
      $dbName = 'projektni2';
      $username = 'marco';
      $password = 'root';

      $conn = mysqli_connect($host, $username, $password, $dbName);

      // Provjera veze s bazom
      if (!$conn) {
        die('Greška prilikom povezivanja s bazom podataka: ' . mysqli_connect_error());
      }

      // SQL upit za dohvaćanje vijesti
      $sqlKultura = "SELECT * FROM vijest WHERE kategorija = 'kultura' AND arhiva = 0";
      $resultKultura = mysqli_query($conn, $sqlKultura);

      // Prikazivanje vijesti iz kategorije "Kultura"
      while ($rowKultura = mysqli_fetch_assoc($resultKultura)) {
        echo '<div class="clanak">';
        echo '<a href="clanak.php?id=' . $rowKultura['id'] . '">';
        echo '<img src="' . $rowKultura['slika'] . '" alt="Slika">';
        echo '<h3>' . $rowKultura['naslov'] . '</h3>';
        echo '<p>' . $rowKultura['sazetak'] . '</p>';
        echo '</a>';
        echo '</div>';
      }

      // Zatvaranje veze s bazom podataka
      mysqli_close($conn);
      ?>
    </div>


    
  </main>

  <footer>
    <p>&copy; 2023 L'OBS</p>
  </footer>

</body>
</html>