<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>L'OBS - Kategorija</title>
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

    if (isset($_GET['kategorija'])) {
      $selectedCategory = $_GET['kategorija'];

      $sql = "SELECT * FROM vijest WHERE kategorija = '$selectedCategory' AND arhiva = 0";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        echo '<h2>' . ucfirst($selectedCategory) . '</h2>';
        echo '<div class="clanci">';
        
        // Prikazivanje arhiviranih vijesti
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="clanak">';
          echo '<a href="clanak.php?id=' . $row['id'] . '">';
          echo '<img src="' . $row['slika'] . '" alt="Slika">';
          echo '<h3>' . $row['naslov'] . '</h3>';
          echo '<p>' . $row['sazetak'] . '</p>';
          echo '</a>';
          echo '</div>';
        }
        
        echo '</div>';
      } else {
        echo '<p>Nema arhiviranih vijesti za prikaz u odabranoj kategoriji.</p>';
      }
    } else {
      echo '<p>Nije odabrana kategorija.</p>';
    }

    // Zatvaranje veze s bazom podataka
    mysqli_close($conn);
    ?>
  </main>

  <footer>
    <p>&copy; 2023 L'OBS</p>
  </footer>

</body>
</html>
