<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $host = 'localhost:3307';
  $dbName = 'projektni2';
  $username = 'marco';
  $password = 'root';
  
  // Uspostavljanje veze s bazom
  $conn = mysqli_connect($host, $username, $password, $dbName);
  
  // Provjera veze s bazom
  if (!$conn) {
    die('Greška prilikom povezivanja s bazom podataka: ' . mysqli_connect_error());
  }
  
  // Priprema podataka za unos
  $naslov = $_POST['title'];
  $sazetak = $_POST['about'];
  $tekst = $_POST['content'];
  $slika = $_FILES['slika']['name'];
  $kategorija = $_POST['category'];
  $arhiva = isset($_POST['archive']) ? 1 : 0;
  $datum = date('Y-m-d'); // Trenutni datum
  
  // Pohrana slike
  $slika_path = 'uploads/' . $slika;
  move_uploaded_file($_FILES['slika']['tmp_name'], $slika_path);
  
  // SQL upit za unos
  $sql = "INSERT INTO vijest (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$datum', '$naslov', '$sazetak', '$tekst', '$slika_path', '$kategorija', '$arhiva')";
  
  // Izvršavanje upita
  if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Podaci su uspjesno upisani!")</script>';
  } else {
    echo 'Dogodila se greška prilikom pohrane podataka u bazu: ' . mysqli_error($conn);
  }
  
  // Zatvaranje veze s bazom
  mysqli_close($conn);

  $dynamic_html = "
    <!DOCTYPE html>
    <html lang='hr'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <link rel='stylesheet' href='../style.css'>
      <title>L'OBS</title>
    </head>
    <body>
      <header>
        <h1>L'OBS</h1>
      </header>
      
      <nav>
        <ul>
          <li><a href='index.php'>Home</a></li>
          <li><a href='kategorija.php?kategorija=sport'>Sport</a></li>
          <li><a href='kategorija.php?kategorija=kultura'>Kultura</a></li>
          <li><a href='unos.html'>Unos</a></li>
          <li><a href='login.php'>Administracija</a></li>
        </ul>
      </nav>

      <section role='main'>
        <div class='row'>
          <p class='category'>$kategorija</p>
          <br>
          <h1 class='title'>$naslov</h1>
        </div>
        <section class='slika'>
          <img src='$slika_path' alt='Slika'>
        </section>
        <section class='about'>
          <p>
            $sazetak
          </p>
        </section>
        <section class='sadrzaj'>
          <p>
            $tekst
          </p>
        </section>
      </section>

      <footer>
        <p>&copy; 2023 L'OBS</p>
      </footer>

    </body>
    </html>
  ";

  // Prikazivanje dinamičkog HTML koda
  echo $dynamic_html;
}
?>
