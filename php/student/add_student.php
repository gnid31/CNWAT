<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm Sinh viên</title>
    <link rel="stylesheet" href="../../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        <div id="middle">
            <div id="left"></div>
            <div id="center">
                <?php
                $studentFile = 'student.txt';

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = trim($_POST['name'] ?? '');
                    $address = trim($_POST['address'] ?? '');
                    $age = filter_var($_POST['age'] ?? '', FILTER_VALIDATE_INT);

                    $errors = [];
                    if (empty($name)) {
                        $errors[] = 'Tên không được để trống.';
                    }
                    if (empty($address)) {
                        $errors[] = 'Địa chỉ không được để trống.';
                    }
                    if ($age === false || $age < 0) {
                        $errors[] = 'Tuổi phải là một số nguyên dương.';
                    }

                    if (empty($errors)) {
                        // Append new student data to file
                        $handle = fopen($studentFile, 'a');
                        if ($handle) {
                            fwrite($handle, $name . "\n");
                            fwrite($handle, $address . "\n");
                            fwrite($handle, $age . "\n");
                            fclose($handle);
                            $message = 'Thêm sinh viên thành công!';
                            // Clear form fields
                            $name = '';
                            $address = '';
                            $age = '';
                        } else {
                            $errors[] = 'Không thể mở file student.txt để ghi.';
                        }
                    }
                }

                // Ensure student.txt exists
                if (!file_exists($studentFile)) {
                    file_put_contents($studentFile, ''); // Create empty file if it doesn't exist
                }

                ?>

                <h2>Thêm sinh viên mới</h2>

                <?php if (!empty($errors)): ?>
                    <div style="color: red; margin-bottom: 15px;">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($message)): ?>
                    <div style="color: green; margin-bottom: 15px;">
                        <p><?php echo htmlspecialchars($message); ?></p>
                    </div>
                <?php endif; ?>

                <form method="post" action="add_student.php">
                    <div style="margin-bottom: 10px;">
                        <label for="name" style="display: inline-block; width: 80px;">Tên:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" style="padding:8px; border:1px solid #ccc; border-radius:4px; width:250px;">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label for="address" style="display: inline-block; width: 80px;">Địa chỉ:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" style="padding:8px; border:1px solid #ccc; border-radius:4px; width:250px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="age" style="display: inline-block; width: 80px;">Tuổi:</label>
                        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age ?? ''); ?>" style="padding:8px; border:1px solid #ccc; border-radius:4px; width:250px;">
                    </div>
                    <button type="reset" style="padding: 8px 15px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; margin-right: 10px;">Nhập Lại</button>
                    <button type="submit" style="padding: 8px 15px; background-color: #1976d2; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Ghi</button>
                </form>
            </div>
        </div>
        <div id="bottom"></div>
    </div>
<script>
    async function loadCommonElements() {
        const headerResponse = await fetch('../../html/common_header.html');
        document.getElementById('top').innerHTML = await headerResponse.text();

        const navResponse = await fetch('common_navigation_student.php');
        document.getElementById('left').innerHTML = await navResponse.text();

        const footerResponse = await fetch('../../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();

        // Highlight active navigation link
        let currentPath = window.location.pathname.split('/').pop();
        if (currentPath === '' || currentPath === 'add_student.php') {
            currentPath = 'add_student.php';
        }
        document.querySelectorAll('#left ul li a').forEach(link => {
            const linkPath = link.getAttribute('href');
            if (currentPath === linkPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
