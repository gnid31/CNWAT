<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Máy tính PHP</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Máy tính đơn giản</p>
                <form method="post" action="calculate1.php" class="calculator-form">
                    <div class="form-row">
                        <label for="num1">Số thứ nhất:</label>
                        <input type="number" id="num1" name="num1" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="num2">Số thứ hai:</label>
                        <input type="number" id="num2" name="num2" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <label>Phép tính:</label>
                        <div class="operation-radios">
                            <input type="radio" id="add" name="operation" value="add" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 'add') ? 'checked' : ''; ?> required>
                            <label for="add">+</label>
                            <input type="radio" id="subtract" name="operation" value="subtract" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 'subtract') ? 'checked' : ''; ?>>
                            <label for="subtract">-</label>
                            <input type="radio" id="multiply" name="operation" value="multiply" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 'multiply') ? 'checked' : ''; ?>>
                            <label for="multiply">*</label>
                            <input type="radio" id="divide" name="operation" value="divide" <?php echo (isset($_POST['operation']) && $_POST['operation'] == 'divide') ? 'checked' : ''; ?>>
                            <label for="divide">/</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" name="calculate" class="btn btn-primary">Calculate</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['calculate'])) {
                    $num1 = isset($_POST['num1']) ? (int)$_POST['num1'] : 0;
                    $num2 = isset($_POST['num2']) ? (int)$_POST['num2'] : 0;
                    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
                    $result = '';
                    $error = false;

                    switch ($operation) {
                        case 'add':
                            $result = $num1 + $num2;
                            break;
                        case 'subtract':
                            $result = $num1 - $num2;
                            break;
                        case 'multiply':
                            $result = $num1 * $num2;
                            break;
                        case 'divide':
                            if ($num2 != 0) {
                                $result = $num1 / $num2;
                            } else {
                                $result = "Không thể chia cho 0!";
                                $error = true;
                            }
                            break;
                        default:
                            $result = "Vui lòng chọn phép tính.";
                            $error = true;
                            break;
                    }

                    echo '<div class="calculator-result">';
                    if (!$error) {
                        echo '<p>Kết quả: <strong>' . htmlspecialchars($result) . '</strong></p>';
                    } else {
                        echo '<p class="error-message">' . htmlspecialchars($result) . '</p>';
                    }
                    echo '</div>';
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
