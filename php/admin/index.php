<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left">
            </div>
            
            <div id="center">
                <p class="content-header">Admin Dashboard</p>

                    <?php
                    session_start();

                    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
                        echo '<div class="login-message error">Bạn chưa đăng nhập. Vui lòng <a href="../Enduser/login.php">đăng nhập</a> để truy cập trang quản trị.</div>';
                    } else {
                        echo '<h2>Chào mừng, ' . htmlspecialchars($_SESSION['username']) . '!</h2>';
                        echo '<p>Bạn đã đăng nhập thành công vào trang quản trị.</p>';
                    }
                    ?>
                
            </div>
        </div>
        
        <div id="bottom"></div>
    </div>
<script>
    async function loadCommonElements() {
        const headerResponse = await fetch('../../html/common_header.html');
        document.getElementById('top').innerHTML = await headerResponse.text();

        const footerResponse = await fetch('../../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();

        const navResponse = await fetch('common_navigation_admin.php');
        document.getElementById('left').innerHTML = await navResponse.text();
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
