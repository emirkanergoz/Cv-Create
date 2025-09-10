<?php


include "config.php";
/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad       = mysqli_real_escape_string($conn, $_POST['first_name']);
    $soyad    = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $telefon  = mysqli_real_escape_string($conn, $_POST['phone']);
    $dogum    = $_POST['birth_date'];
    $egitim   = mysqli_real_escape_string($conn, $_POST['education']);
    $deneyim  = mysqli_real_escape_string($conn, $_POST['experience']);
    $hakkinda = mysqli_real_escape_string($conn, $_POST['about']);
    $yetenek  = $_POST['skills']; // JSON string

    // Fotoğraf yükleme
    $foto = "";
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $foto = $targetDir . basename($_FILES["profile_pic"]["name"]);
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $foto);
    }

    $sql = "INSERT INTO cv_bilgileri (ad, soyad, email, telefon, dogum_tarihi, egitim, deneyim, yetenekler, hakkinda, foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $ad, $soyad, $email, $telefon, $dogum, $egitim, $deneyim, $yetenek, $hakkinda, $foto);
    $stmt->execute();

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        ?>
        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <title>Save Successful</title>
        </head>
        <body>
        <div class="msg-container">
            <h2>✅ Save Successful!</h2>
            <a href="cv.php?id=<?php echo $last_id; ?>">View CV</a>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Hata: " . $stmt->error;
    }
}
?>
