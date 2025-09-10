<?php
include "config.php";
/** @var mysqli $conn */

$id = $_GET['id'];
$sql = "SELECT * FROM cv_bilgileri WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$skillsArray = json_decode($data['yetenekler'], true);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>CV - <?php echo $data['ad'] . ' ' . $data['soyad']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="cv-container">
    <?php if (!empty($data['foto'])) : ?>
        <img src="<?php echo $data['foto']; ?>" alt="Profil Fotoğrafı" class="profile-pic">
    <?php endif; ?>

    <h1><?php echo $data['ad'] . ' ' . $data['soyad']; ?></h1>
    <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $data['telefon']; ?></p>
    <p><strong>Birth Date:</strong> <?php echo $data['dogum_tarihi']; ?></p>

    <h2>Education</h2>
    <p><?php echo nl2br($data['egitim']); ?></p>

    <h2>Experience</h2>
    <p><?php echo nl2br($data['deneyim']); ?></p>

    <h2>Skills</h2>
    <?php if (!empty($skillsArray)) : ?>
        <ul>
            <?php foreach ($skillsArray as $skill) : ?>
                <li>
                    Yetenek: <?php echo htmlspecialchars($skill['skill']); ?>
                    - Seviye: <?php echo htmlspecialchars($skill['level']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Hiç yetenek girilmemiş.</p>
    <?php endif; ?>

    <h2>About</h2>
    <p><?php echo nl2br($data['hakkinda']); ?></p>
</div>
</body>
</html>