<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Trang DrawTable</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Trang Vẽ Bảng:</p>
                <form method="post" action="draw_table.php" class="draw-table-form">
                    <p class="form-title">Form vẽ bảng:</p>
                    <div class="form-group">
                        <label for="rows">Số dòng:</label>
                        <input type="number" id="rows" name="rows" min="1" value="<?php echo (isset($_POST['rows']) && !isset($_POST['reset'])) ? htmlspecialchars($_POST['rows']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cols">Số cột:</label>
                        <input type="number" id="cols" name="cols" min="1" value="<?php echo (isset($_POST['cols']) && !isset($_POST['reset'])) ? htmlspecialchars($_POST['cols']) : ''; ?>">
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="reset" class="btn btn-secondary">Nhập Lại</button>
                        <button type="submit" name="draw" class="btn btn-primary">Vẽ Bảng</button>
                        <span class="form-instruction">(Khi nhấn nút Vẽ Bảng, bảng sẽ được tạo và hiển thị bên dưới)</span>
                    </div>
                </form>

                <?php
                if (isset($_POST['draw'])) {
                    $rows = isset($_POST['rows']) ? (int)$_POST['rows'] : 0;
                    $cols = isset($_POST['cols']) ? (int)$_POST['cols'] : 0;

                    if ($rows > 0 && $cols > 0) {
                        echo '<table class="drawn-table">';
                        for ($i = 1; $i <= $rows; $i++) {
                            echo '<tr>';
                            for ($j = 1; $j <= $cols; $j++) {
                                echo '<td>&nbsp;</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p class="error-message">Vui lòng nhập số dòng và số cột hợp lệ.</p>';
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
