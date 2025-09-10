<?php


include "config.php";
/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName   = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName    = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email       = mysqli_real_escape_string($conn, $_POST['email']);
    $phone       = mysqli_real_escape_string($conn, $_POST['phone']);
    $birthDate   = $_POST['birth_date'];
    $education   = mysqli_real_escape_string($conn, $_POST['education']);
    $experience  = mysqli_real_escape_string($conn, $_POST['experience']);
    $about       = mysqli_real_escape_string($conn, $_POST['about']);
    $skillsJson  = $_POST['skills']; // JSON string

    // Photo upload
    $photoPath = "";
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $photoPath = $targetDir . basename($_FILES["profile_pic"]["name"]);
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $photoPath);
    }

    $sql = "INSERT INTO cv_bilgileri (first_name, last_name, email, phone, birth_date, education, experience, skills, about, photo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $phone, $birthDate, $education, $experience, $skillsJson, $about, $photoPath);
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
