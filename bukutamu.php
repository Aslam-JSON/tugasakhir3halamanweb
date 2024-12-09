<?php
include 'includes/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    $stmt = $conn->prepare("INSERT INTO bukutamu (nama, alamat, email, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $alamat, $email, $pesan);
    $stmt->execute();
    $stmt->close();
    header("Location: bukutamu.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link rel="stylesheet" href="bukutamu.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Aslam Muzaky</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="portofolio.php">Portofolio</a></li>
                <li><a href="bukutamu.php">Buku Tamu</a></li>
            </ul>
        </nav>
    </header>
    <section class="bukutamu-form">
        <h1>Buku Tamu</h1>
        <p>Silakan isi formulir di bawah ini untuk meninggalkan pesan.</p>
        <form action="bukutamu.php" method="post">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="pesan" placeholder="Pesan Anda" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </section>
    <section class="bukutamu-entries">
        <h2>Pesan yang Masuk</h2>
        <div class="entries">
    <?php
    $result = $conn->query("SELECT * FROM bukutamu ORDER BY created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='entry'>
                    <h3>{$row['nama']}</h3>
                    <p><strong>Alamat:</strong> {$row['alamat']}</p>
                    <p><strong>Email:</strong> {$row['email']}</p>
                    <p><strong>Pesan:</strong> {$row['pesan']}</p>
                    <hr>
                </div>";
        }
    } else {
        echo "Error: " . $conn->error;
    }
    ?>
</div>
    </section>
    <footer></footer>
</body>
</html>