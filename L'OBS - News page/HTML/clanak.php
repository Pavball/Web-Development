<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>L'OBS - Članak</title>
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
  // Uspostavljanje veze
  $host = 'localhost:3307';
  $dbName = 'projektni2';
  $username = 'marco';
  $password = 'root';

  $conn = mysqli_connect($host, $username, $password, $dbName);

  // Provjera veze
  if (!$conn) {
    die('Greška prilikom povezivanja s bazom podataka: ' . mysqli_connect_error());
  }

  // Provjera je li ID članka definiran
  if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // SQL upit za dohvaćanje članka
    $sql = "SELECT * FROM vijest WHERE id = '$articleId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      ?>


      <section role="main">
        <div class="row">
          <p class="category"><?php echo ucfirst($row['kategorija']); ?></p>
          <br>
          <h1 class="title"><?php echo $row['naslov']; ?></h1>
        </div>
        <section class="slika">
          <img src="<?php echo $row['slika']; ?>" alt="Slika">
        </section>

        <div>
          <span><?php echo 'Datum objave: '.$row['datum']; ?></span>
        </div>

        <section class="about">
        <p>
        <?php echo $row['sazetak']; ?>
        </p>
        </section>
        <section class="sadrzaj">
        <p>
            <?php echo $row['tekst']; ?>
        </p>
        </section>
        
      </section>
      <?php
    } else {
      echo '<p>Nije pronađen članak s odabranim ID-om.</p>';
    }
  } else {
    echo '<p>Nije odabran članak.</p>';
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
