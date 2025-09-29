<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Tính Tổng Điểm</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Tính Tổng Điểm Học Sinh</p>
                <form method="post" action="calculate2.php" class="score-calculator-form">
                    <div class="form-row">
                        <label for="ho_va_ten">Họ và tên:</label>
                        <input type="text" id="ho_va_ten" name="ho_va_ten" value="<?php echo isset($_POST['ho_va_ten']) ? htmlspecialchars($_POST['ho_va_ten']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="lop">Lớp:</label>
                        <input type="text" id="lop" name="lop" value="<?php echo isset($_POST['lop']) ? htmlspecialchars($_POST['lop']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="diem_m1">Điểm M1:</label>
                        <input type="number" id="diem_m1" name="diem_m1" step="0.1" min="0" max="10" value="<?php echo isset($_POST['diem_m1']) ? htmlspecialchars($_POST['diem_m1']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="diem_m2">Điểm M2:</label>
                        <input type="number" id="diem_m2" name="diem_m2" step="0.1" min="0" max="10" value="<?php echo isset($_POST['diem_m2']) ? htmlspecialchars($_POST['diem_m2']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="diem_m3">Điểm M3:</label>
                        <input type="number" id="diem_m3" name="diem_m3" step="0.1" min="0" max="10" value="<?php echo isset($_POST['diem_m3']) ? htmlspecialchars($_POST['diem_m3']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="tong_diem">Tổng điểm:</label>
                        <input type="text" id="tong_diem" name="tong_diem" value="<?php 
                            if (isset($_POST['ok'])) {
                                $diem_m1 = isset($_POST['diem_m1']) ? (float)$_POST['diem_m1'] : 0;
                                $diem_m2 = isset($_POST['diem_m2']) ? (float)$_POST['diem_m2'] : 0;
                                $diem_m3 = isset($_POST['diem_m3']) ? (float)$_POST['diem_m3'] : 0;
                                echo htmlspecialchars($diem_m1 + $diem_m2 + $diem_m3);
                            }
                        ?>" readonly>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="ok" class="btn btn-primary">OK</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['ok'])) {
                    $ho_va_ten = isset($_POST['ho_va_ten']) ? $_POST['ho_va_ten'] : '';
                    $lop = isset($_POST['lop']) ? $_POST['lop'] : '';
                    $diem_m1 = isset($_POST['diem_m1']) ? (float)$_POST['diem_m1'] : null;
                    $diem_m2 = isset($_POST['diem_m2']) ? (float)$_POST['diem_m2'] : null;
                    $diem_m3 = isset($_POST['diem_m3']) ? (float)$_POST['diem_m3'] : null;

                    $errors = [];

                    if (empty($ho_va_ten)) {
                        $errors[] = "Họ và tên không được để trống.";
                    }
                    if (empty($lop)) {
                        $errors[] = "Lớp không được để trống.";
                    }
                    if (!is_numeric($diem_m1) || $diem_m1 < 0 || $diem_m1 > 10) {
                        $errors[] = "Điểm M1 phải là số từ 0 đến 10.";
                    }
                    if (!is_numeric($diem_m2) || $diem_m2 < 0 || $diem_m2 > 10) {
                        $errors[] = "Điểm M2 phải là số từ 0 đến 10.";
                    }
                    if (!is_numeric($diem_m3) || $diem_m3 < 0 || $diem_m3 > 10) {
                        $errors[] = "Điểm M3 phải là số từ 0 đến 10.";
                    }

                    if (count($errors) > 0) {
                        echo '<div class="error-messages">';
                        foreach ($errors as $error) {
                            echo '<p class="error-message">' . htmlspecialchars($error) . '</p>';
                        }
                        echo '</div>';
                    } else {
                        $tong_diem = $diem_m1 + $diem_m2 + $diem_m3;
                        // Display result is handled by the input field value itself
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
