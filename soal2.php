<?php

$tampilan = isset($_POST['tampilan']) ? (int)$_POST['tampilan'] : 1;
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$umur = isset($_POST['umur']) ? $_POST['umur'] : '';
$hobi = isset($_POST['hobi']) ? $_POST['hobi'] : '';


if ($tampilan === 1) {
    ?>
    <form method="post">
        <label>Nama Anda: </label>
        <input type="text" name="nama" required>
        <br><br>
        <input type="hidden" name="tampilan" value="2">
        <input type="submit" value="SUBMIT">
    </form>
    <?php
}

elseif ($tampilan=== 2) {
    ?>
    <form method="post">
        <label>Umur Anda: </label>
        <input type="number" name="umur" required>
        <br><br>
        
        <input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        <input type="hidden" name="tampilan" value="3">
        <input type="submit" value="SUBMIT">
    </form>
    <?php
}

elseif ($tampilan=== 3) {
    ?>
    <form method="post">
        <label>Hobi Anda: </label>
        <input type="text" name="hobi" required>
        <br><br>
        
        <input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        <input type="hidden" name="umur" value="<?php echo htmlspecialchars($umur); ?>">
        <input type="hidden" name="tampilan" value="4">
        <input type="submit" value="SUBMIT">
    </form>
    <?php
}

elseif ($tampilan === 4) {
   echo  "<div style='margin-bottom: 10px;'>Nama: " . htmlspecialchars($nama) . "</div>";
    echo "<div style='margin-bottom: 10px;'>Umur: " . htmlspecialchars($umur) . "</div>";
    echo "<div style='margin-bottom: 10px;'>Hobi: " . htmlspecialchars($hobi) . "</div>";
}
?>
