<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thao tác mảng 2 chiều</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        <div id="middle">
            <div id="left"></div>
            <div id="center">
                <h2>Chọn loại mảng để thao tác</h2>
                <form method="post" action="array1.php" style="margin-bottom:20px;">
                    <button type="submit" name="chon_mang" value="1chieu" class="btn btn-primary">Mảng 1 chiều</button>
                    <button type="submit" name="chon_mang" value="2chieu" class="btn btn-primary">Mảng 2 chiều</button>
                </form>
                <?php
                // Hàm cho mảng 1 chiều
                function minArr($arr) { return min($arr); }
                function maxArr($arr) { return max($arr); }
                function avgArr($arr) { return count($arr) ? array_sum($arr)/count($arr) : 0; }
                function sortArr($arr) { $tmp = $arr; sort($tmp); return $tmp; }
                function reverseArr($arr) { return array_reverse($arr); }

                // Hàm cho mảng 2 chiều
                function minMat($mat) {
                    $min = $mat[0][0];
                    foreach ($mat as $row) foreach ($row as $v) if ($v < $min) $min = $v;
                    return $min;
                }
                function maxMat($mat) {
                    $max = $mat[0][0];
                    foreach ($mat as $row) foreach ($row as $v) if ($v > $max) $max = $v;
                    return $max;
                }
                function sumMainDiag($mat) {
                    $sum = 0;
                    for ($i=0; $i<count($mat); $i++) $sum += $mat[$i][$i];
                    return $sum;
                }
                function sumSecDiag($mat) {
                    $sum = 0;
                    $n = count($mat);
                    for ($i=0; $i<$n; $i++) $sum += $mat[$i][$n-$i-1];
                    return $sum;
                }
                function matSum($m1, $m2) {
                    $res = [];
                    for ($i=0; $i<3; $i++) for ($j=0; $j<3; $j++) $res[$i][$j] = $m1[$i][$j]+$m2[$i][$j];
                    return $res;
                }
                function matProd($m1, $m2) {
                    $res = [[0,0,0],[0,0,0],[0,0,0]];
                    for ($i=0; $i<3; $i++) for ($j=0; $j<3; $j++) for ($k=0; $k<3; $k++) $res[$i][$j] += $m1[$i][$k]*$m2[$k][$j];
                    return $res;
                }
                function displayMatrix($matrix, $title) {
                    echo '<h4>' . htmlspecialchars($title) . ':</h4>';
                    echo '<pre class="matrix-output">';
                    foreach ($matrix as $row) {
                        echo implode(' ', $row) . "\n";
                    }
                    echo '</pre>';
                }

                // Xử lý chọn loại mảng
                $chon_mang = $_POST['chon_mang'] ?? '';
                if ($chon_mang == '1chieu') {
                ?>
                    <h3>Mảng 1 chiều</h3>
                    <form method="post" action="array1.php" style="display:flex; align-items:center; gap:10px;">
                        <input type="hidden" name="chon_mang" value="1chieu">
                        <label style="white-space:nowrap;">Nhập các số, cách nhau bởi dấu phẩy:</label>
                        <input type="text" name="mang1chieu" value="<?php echo isset($_POST['mang1chieu']) ? htmlspecialchars($_POST['mang1chieu']) : '1,2,3,4,5'; ?>" style="flex-grow:1; width:400px; padding:8px; border:1px solid #ccc; border-radius:5px;">
                        <button type="submit" name="tinh1chieu" class="btn btn-primary">Tính</button>
                    </form>
                    <?php
                    if (isset($_POST['tinh1chieu'])) {
                        $arr = array_map('intval', explode(',', $_POST['mang1chieu']));
                        echo '<div class="matrix-results">';
                        echo '<b>Min:</b> '.minArr($arr).'<br>';
                        echo '<b>Max:</b> '.maxArr($arr).'<br>';
                        echo '<b>Trung bình:</b> '.avgArr($arr).'<br>';
                        echo '<b>Sắp xếp tăng dần:</b> '.implode(', ', sortArr($arr)).'<br>';
                        echo '<b>Đảo ngược dãy:</b> '.implode(', ', reverseArr($arr)).'<br>';
                        echo '</div>';
                    }
                }
                elseif ($chon_mang == '2chieu') {
                ?>
                    <h3>Mảng 2 chiều (ma trận 3x3)</h3>
                    <form method="post" action="array1.php">
                        <input type="hidden" name="chon_mang" value="2chieu">
                        <div style="display:flex;gap:40px;">
                            <div>
                                <h4>Ma trận 1</h4>
                                <?php for ($i=0;$i<3;$i++): ?>
                                    <div>
                                    <?php for ($j=0;$j<3;$j++): ?>
                                        <input type="number" name="matrix1[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo isset($_POST['matrix1'][$i][$j]) ? htmlspecialchars($_POST['matrix1'][$i][$j]) : (($i==$j)?'1':'0'); ?>" style="width:40px;">
                                    <?php endfor; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <div>
                                <h4>Ma trận 2</h4>
                                <?php for ($i=0;$i<3;$i++): ?>
                                    <div>
                                    <?php for ($j=0;$j<3;$j++): ?>
                                        <input type="number" name="matrix2[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo isset($_POST['matrix2'][$i][$j]) ? htmlspecialchars($_POST['matrix2'][$i][$j]) : '0'; ?>" style="width:40px;">
                                    <?php endfor; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <button type="submit" name="tinh2chieu" class="btn btn-primary" style="margin-top:10px;">Tính</button>
                    </form>
                    <?php
                    if (isset($_POST['tinh2chieu'])) {
                        $m1 = $_POST['matrix1'];
                        $m2 = $_POST['matrix2'];
                        // Chuyển về số nguyên
                        foreach ($m1 as &$row) foreach ($row as &$cell) $cell = (int)$cell;
                        foreach ($m2 as &$row) foreach ($row as &$cell) $cell = (int)$cell;
                        echo '<div style="display:flex; justify-content: space-around; gap: 20px;">';
                        echo '<div class="matrix-results" style="flex: 1;">';
                        echo '<h4>Kết quả Ma trận 1:</h4>';
                        echo '<b>Min Ma trận 1:</b> '.minMat($m1).'<br>';
                        echo '<b>Max Ma trận 1:</b> '.maxMat($m1).'<br>';
                        echo '<b>Tổng đường chéo chính Ma trận 1:</b> '.sumMainDiag($m1).'<br>';
                        echo '<b>Tổng đường chéo phụ Ma trận 1:</b> '.sumSecDiag($m1).'<br>';
                        echo '</div>';
                        echo '<div class="matrix-results" style="flex: 1;">';
                        echo '<h4>Kết quả Ma trận 2:</h4>';
                        echo '<b>Min Ma trận 2:</b> '.minMat($m2).'<br>';
                        echo '<b>Max Ma trận 2:</b> '.maxMat($m2).'<br>';
                        echo '<b>Tổng đường chéo chính Ma trận 2:</b> '.sumMainDiag($m2).'<br>';
                        echo '<b>Tổng đường chéo phụ Ma trận 2:</b> '.sumSecDiag($m2).'<br>';
                        echo '</div>';
                        echo '</div>';
                        displayMatrix(matSum($m1,$m2), 'Ma trận Tổng');
                        displayMatrix(matProd($m1,$m2), 'Ma trận Tích');
                        echo '</div>';
                    }
                }
                ?>
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

        // Tô sáng menu sau khi navigation đã load
        let currentPath = window.location.pathname.split('/18_trancongdinh/php/')[1] || '';
        currentPath = currentPath.split('?')[0];
        if (currentPath === '' || currentPath === undefined) {
            currentPath = 'home.php';
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            let linkHref = link.getAttribute('href');
            if (linkHref.startsWith('/18_trancongdinh/php/')) {
                linkHref = linkHref.split('/18_trancongdinh/php/')[1];
            }
            linkHref = linkHref.split('?')[0];
            if (currentPath === linkHref) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        const footerResponse = await fetch('../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
