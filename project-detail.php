
<?php include('partials/_header.php')?>
<?php
// config.php dosyasını dahil edelim
include './config.php';

// URL'den gelen proje ID'sini alalım
$proje_id = $_GET['id'];

// Veritabanından ilgili proje bilgilerini çekelim
$sql = "SELECT * FROM project WHERE project_id = ?";
$stmt = $bağlanti->prepare($sql);
$stmt->bind_param("i", $proje_id);
$stmt->execute();
$result = $stmt->get_result();

// Proje bulunduysa detaylarını gösterelim
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <div class="project-detail">
        <h2><?php echo $row['project_name']; ?></h2>
        <img src="images/<?php echo $row['project_image']; ?>" alt="Proje Resmi">
        <p><?php echo $row['project_about']; ?></p>
    </div>
    <?php
} else {
    echo "Proje bulunamadı.";
}

// Bağlantıyı kapat
$bağlanti->close();
?>;
<?php include('partials/_footer.php')?>
