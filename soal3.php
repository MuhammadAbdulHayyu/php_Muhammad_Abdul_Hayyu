<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$searchNama = isset($_GET['nama']) ? $_GET['nama'] : '';
$searchAlamat = isset($_GET['alamat']) ? $_GET['alamat'] : '';
$searchHobi = isset($_GET['hobi']) ? $_GET['hobi'] : '';

$sql = "
    SELECT 
        p.id,
        p.nama,
        p.alamat,
        GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobi
    FROM person AS p
    JOIN hobi AS h ON p.id = h.person_id
";

$filters = [];
if (!empty($searchNama)) {
    $filters[] = "p.nama LIKE '%" . $conn->real_escape_string($searchNama) . "%'";
}
if (!empty($searchAlamat)) {
    $filters[] = "p.alamat LIKE '%" . $conn->real_escape_string($searchAlamat) . "%'";
}
if (!empty($searchHobi)) {
    $filters[] = "h.hobi LIKE '%" . $conn->real_escape_string($searchHobi) . "%'";
}

if (!empty($filters)) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}

$sql .= " GROUP BY p.id, p.nama, p.alamat ORDER BY p.id ASC";

$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .search-form {
            margin-top: 20px;
        }
        .search-form label {
            display: inline-block;
            width: 80px;
        }
        .search-form input[type="text"] {
            margin-bottom: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Hobi</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
            echo "<td>" . htmlspecialchars($row['hobi'] ?? '-') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
    }
    ?>
</table>

<div class="search-form">
    <form method="get" action="">
        <div>
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($searchNama); ?>">
        </div>
        <div>
            <label>Alamat:</label>
            <input type="text" name="alamat" value="<?php echo htmlspecialchars($searchAlamat); ?>">
        </div>
        <div>
            <label>Hobi:</label>
            <input type="text" name="hobi" value="<?php echo htmlspecialchars($searchHobi); ?>">
        </div>
        <div>
            <input type="submit" value="SEARCH">
        </div>
    </form>
</div>

</body>
</html>
<?php $conn->close(); ?>
