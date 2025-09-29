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
                <p class="content-header">Trang thao tác mảng 2 chiều: matrix</p>
                <p class="form-instruction">(Chỉ khi nhấn nút Tính, KẾT QUẢ mới hiển thị bên dưới)</p>
                
                <h3>Sử dụng mảng để tính: hiệu, tổng, tích 2 ma trận</h3>

                <form method="post" action="array1.php" class="matrix-form">
                    <div class="matrix-input-section">
                        <div class="matrix-input-group">
                            <h4>Nhập Ma trận 1</h4>
                            <?php for ($i = 0; $i < 3; $i++): ?>
                                <div class="matrix-row">
                                    <?php for ($j = 0; $j < 3; $j++): ?>
                                        <input type="number" name="matrix1[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo isset($_POST['matrix1'][$i][$j]) ? htmlspecialchars($_POST['matrix1'][$i][$j]) : (($i == $j) ? '1' : '0'); ?>" class="matrix-cell">
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="matrix-input-group">
                            <h4>Nhập Ma trận 2</h4>
                            <?php for ($i = 0; $i < 3; $i++): ?>
                                <div class="matrix-row">
                                    <?php for ($j = 0; $j < 3; $j++): ?>
                                        <input type="number" name="matrix2[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo isset($_POST['matrix2'][$i][$j]) ? htmlspecialchars($_POST['matrix2'][$i][$j]) : '0'; ?>" class="matrix-cell">
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="reset_matrices" class="btn btn-secondary">Nhập Lại</button>
                        <button type="submit" name="calculate_matrices" class="btn btn-primary">Tính</button>
                    </div>
                </form>

                <div class="matrix-results">
                    <?php
                    function displayMatrix($matrix, $title) {
                        echo '<h4>' . htmlspecialchars($title) . ':</h4>';
                        echo '<pre class="matrix-output">';
                        foreach ($matrix as $row) {
                            echo implode(' ', $row) . "\n";
                        }
                        echo '</pre>';
                    }

                    if (isset($_POST['calculate_matrices'])) {
                        $matrix1 = $_POST['matrix1'];
                        $matrix2 = $_POST['matrix2'];

                        // Convert all matrix values to integers
                        foreach ($matrix1 as &$row) {
                            foreach ($row as &$cell) {
                                $cell = (int)$cell;
                            }
                        }
                        foreach ($matrix2 as &$row) {
                            foreach ($row as &$cell) {
                                $cell = (int)$cell;
                            }
                        }

                        // Matrix Sum
                        $matrixSum = [];
                        for ($i = 0; $i < 3; $i++) {
                            for ($j = 0; $j < 3; $j++) {
                                $matrixSum[$i][$j] = $matrix1[$i][$j] + $matrix2[$i][$j];
                            }
                        }
                        displayMatrix($matrixSum, "Ma trận Tổng");

                        // Matrix Difference
                        $matrixDiff = [];
                        for ($i = 0; $i < 3; $i++) {
                            for ($j = 0; $j < 3; $j++) {
                                $matrixDiff[$i][$j] = $matrix1[$i][$j] - $matrix2[$i][$j];
                            }
                        }
                        displayMatrix($matrixDiff, "Ma trận Hiệu");

                        // Matrix Product
                        $matrixProd = [
                            [0, 0, 0],
                            [0, 0, 0],
                            [0, 0, 0]
                        ];
                        for ($i = 0; $i < 3; $i++) {
                            for ($j = 0; $j < 3; $j++) {
                                for ($k = 0; $k < 3; $k++) {
                                    $matrixProd[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
                                }
                            }
                        }
                        displayMatrix($matrixProd, "Ma trận Tích");
                    }
                    ?>
                </div>
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
