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
    <h2>Administracija</h2>
    <p>Dobrodošli na administrativnu stranicu.</p>
    <p>Ovdje možete brisati, mijenjati i dodavati zapise (vijesti) u bazu podataka.</p>

    <?php
    
    $host = 'localhost:3307';
    $dbName = 'projektni2';
    $username = 'marco';
    $password = 'root';

    $conn = mysqli_connect($host, $username, $password, $dbName);

    if (!$conn) {
      die('Greška prilikom povezivanja s bazom podataka: ' . mysqli_connect_error());
    }

    // Brisanje
    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];

      $sqlDelete = "DELETE FROM vijest WHERE id = $id";
      $resultDel = mysqli_query($conn, $sqlDelete);

      if ($resultDel) {
        echo '<p>Zapis je uspješno obrisan.</p>';
      } else {
        echo '<p>Došlo je do greške prilikom brisanja zapisa.</p>';
      }
    }

    // Izmjen
    if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      // Dohvaćanje podataka o zapisu
      $sqlSelect = "SELECT * FROM vijest WHERE id = $id";
      $resultSelect = mysqli_query($conn, $sqlSelect);
      $rowSelect = mysqli_fetch_assoc($resultSelect);

      if ($rowSelect) {

        // Prikaži formu za uređivanje
        ?>
        <h3>Uređivanje zapisa</h3>
        <form method="POST" action="administracija.php" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $rowSelect['id']; ?>">
          <div class="form-item">
            <label for="naslov">Naslov:</label>
            <input type="text" id="naslov" name="naslov" value="<?php echo $rowSelect['naslov']; ?>">
          </div>
          <div class="form-item">
            <label for="sazetak">Sažetak:</label>
            <textarea id="sazetak" name="sazetak"><?php echo $rowSelect['sazetak']; ?></textarea>
          </div>
          <div class="form-item">
            <label for="tekst">Tekst:</label>
            <textarea id="tekst" name="tekst"><?php echo $rowSelect['tekst']; ?></textarea>
          </div>
          <div class="form-item">
            <label for="slika">Slika:</label>
            <input type="file" id="slika" name="slika">
          </div>
          <div class="form-item">
            <label for="kategorija">Kategorija:</label>
            <select id="kategorija" name="kategorija">
              <option value="sport" <?php if ($rowSelect['kategorija'] == 'sport') echo 'selected'; ?>>Sport</option>
              <option value="kultura" <?php if ($rowSelect['kategorija'] == 'kultura') echo 'selected'; ?>>Kultura</option>
            </select>
          </div>
          <div class="form-item">
            <input type="submit" value="Spremi" name="spremi">
          </div>
        </form>
        <?php
      } else {
        echo '<p>Zapis nije pronađen.</p>';
      }
    }

    // Ažuriranje
    if (isset($_POST['spremi'])) {
      $id = $_POST['id'];
      $naslov = $_POST['naslov'];
      $sazetak = $_POST['sazetak'];
      $tekst = $_POST['tekst'];
      $kategorija = $_POST['kategorija'];

      $slika = $_FILES['slika']['name'];
      $slika_tmp = $_FILES['slika']['tmp_name'];

      // Provjeri postoji li direktorij "uploads"
      if (!is_dir('uploads')) {
        
        mkdir('uploads', 0777, true);
      }

      // Spremi sliku
      move_uploaded_file($slika_tmp, 'uploads/' . $slika);

      // Ažuriraj naziv slike u bazi
      $sqlUpdateSlika = "UPDATE vijest SET slika = 'uploads/$slika' WHERE id = $id";
      $result_update_slika = mysqli_query($conn, $sqlUpdateSlika);

      if (!$result_update_slika) {
        echo '<p>Došlo je do greške prilikom ažuriranja slike.</p>';
      }

      // Ažuriraj ostale podatke zapisa u bazi
      $sqlUpdate = "UPDATE vijest SET naslov = '$naslov', sazetak = '$sazetak', tekst = '$tekst', kategorija = '$kategorija' WHERE id = $id";
      $resultUpdate = mysqli_query($conn, $sqlUpdate);

      if ($resultUpdate) {
        echo '<p>Zapis je uspješno ažuriran.</p>';
      } else {
        echo '<p>Došlo je do greške prilikom ažuriranja zapisa.</p>';
      }
    }


    ?>

    <h3>Popis zapisa</h3>
    <table>
      <tr>
        <th>Naslov</th>
        <th>Sažetak</th>
        <th>Kategorija</th>
        <th>Izmijeni</th>
        <th>Obriši</th>
      </tr>

      <?php
      // Dohvati sve zapise iz baze
      $sqlSelectAll = "SELECT * FROM vijest";
      $resultSelectAll = mysqli_query($conn, $sqlSelectAll);

      if (mysqli_num_rows($resultSelectAll) > 0) {
        while ($rowSelectAll = mysqli_fetch_assoc($resultSelectAll)) {
          echo '<tr>';
          echo '<td>' . $rowSelectAll['naslov'] . '</td>';
          echo '<td>' . $rowSelectAll['sazetak'] . '</td>';
          echo '<td>' . $rowSelectAll['kategorija'] . '</td>';
          echo '<td><a href="administracija.php?edit=' . $rowSelectAll['id'] . '">Izmijeni</a></td>';
          echo '<td><a href="administracija.php?delete=' . $rowSelectAll['id'] . '">Obriši</a></td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="5">Nema zapisa u bazi podataka.</td></tr>';
      }
      mysqli_close($conn);
      ?>

    </table>
  </div>

  <footer>
    <p>&copy; 2023 L'OBS.</p>
  </footer>
</body>
</html>
