<?php

$jml = isset($_GET['jml']) ? (int)$_GET['jml'] : 0;

echo "<table border='1' cellpadding='5' cellspacing='0'>\n";

for ($a = $jml; $a > 0; $a--) {
    
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }

    
    echo "<tr style='font-weight:bold;'>";
    echo "<td colspan='$a'>Total: $total</td>";
    echo "</tr>\n";

    
    echo "<tr>";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    echo "</tr>\n";
}

echo "</table>";
?>
