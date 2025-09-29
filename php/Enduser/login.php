<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Trang Đăng nhập</p>

                <?php
                session_start();
                $message = '';

                $cookie_username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
                $cookie_password = isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : '';
                $last_login_time = isset($_COOKIE['last_login_time']) ? date('d/m/Y H:i:s', $_COOKIE['last_login_time']) : 'Không có thông tin';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = isset($_POST['username']) ? $_POST['username'] : '';
                    $password = isset($_POST['password']) ? $_POST['password'] : '';

                    if ($username === 'admin' && $password === 'admin') {
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password; // Storing password in session is not recommended for production
                        
                        // Set cookies for username, password, and last login time
                        setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
                        setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
                        setcookie('last_login_time', time(), time() + (86400 * 30), "/"); // 30 days

                        header('Location: ../admin/index.php');
                        exit();
                    } else {
                        $message = '<div class="login-message error">Tên đăng nhập hoặc mật khẩu không đúng.</div>';
                    }
                }
                ?>

                <div class="login-form-container">
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" value="<?php echo $cookie_username; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="<?php echo $cookie_password; ?>" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <?php echo $message; ?>
                <div class="last-login-info">
                    <p>Lần đăng nhập cuối: <span><?php echo $last_login_time; ?></span></p>
                </div>
            </div>
        </div>
        
        <div id="bottom"></div>
    </div>
<script>
    async function loadCommonElements() {
        const headerResponse = await fetch('../../html/common_header.html');
        document.getElementById('top').innerHTML = await headerResponse.text();

        const navResponse = await fetch('common_navigation_enduser.php');
        document.getElementById('left').innerHTML = await navResponse.text();

        // Highlight menu
        let currentPath = window.location.pathname.split('/18_trancongdinh/php/Enduser/')[1] || '';
        currentPath = currentPath.split('?')[0];
        if (currentPath === '' || currentPath === undefined) {
            currentPath = 'login.php';
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            let linkHref = link.getAttribute('href');
            if (linkHref.startsWith('/18_trancongdinh/php/Enduser/')) {
                linkHref = linkHref.split('/18_trancongdinh/php/Enduser/')[1];
            }
            linkHref = linkHref.split('?')[0];
            if (currentPath === linkHref) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        const footerResponse = await fetch('../../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
