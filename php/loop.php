<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>In kết quả theo 3 cách: For, While, Do-While</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">In kết quả dưới theo 3 cách: For, While, Do-While</p>

                <h3>Sử dụng vòng lặp For:</h3>
                <pre>
<?php
for ($i = 1; $i <= 9; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n";
}
?>
                </pre>

                <h3>Sử dụng vòng lặp While:</h3>
                <pre>
<?php
$i = 1;
while ($i <= 9) {
    $j = 1;
    while ($j <= $i) {
        echo "*";
        $j++;
    }
    echo "\n";
    $i++;
}
?>
                </pre>

                <h3>Sử dụng vòng lặp Do-While:</h3>
                <pre>
<?php
$i = 1;
do {
    $j = 1;
    do {
        echo "*";
        $j++;
    } while ($j <= $i);
    echo "\n";
    $i++;
} while ($i <= 9);
?>
                </pre>
            </div>
        </div>
        
        <div id="bottom"></div>
    </div>
<script>
    async function loadCommonElements() {
        const headerResponse = await fetch('../html/common_header.html');
        document.getElementById('top').innerHTML = await headerResponse.text();

        const navResponse = await fetch('common_navigation_bai3.php');
        document.getElementById('left').innerHTML = await navResponse.text();

        const footerResponse = await fetch('../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
