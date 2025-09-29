<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Admin Home</title>
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
                <p class="content-header">Admin Home Page</p>

                    <?php
                    session_start();

                    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
                        echo '<div class="login-message error">Bạn chưa đăng nhập. Vui lòng <a href="../Enduser/login.php">đăng nhập</a> để xem thông tin.</div>';
                    } else {
                        echo '<h4>Thông tin người dùng đã đăng nhập:</h4>';
                        echo '<p><strong>Username:</strong> <span>' . htmlspecialchars($_SESSION['username']) . '</span></p>';
                        echo '<p><strong>Password:</strong> <span>' . htmlspecialchars($_SESSION['password']) . '</span></p>';
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

        // Highlight menu
        let currentPath = window.location.pathname.split('/18_trancongdinh/php/admin/')[1] || '';
        currentPath = currentPath.split('?')[0];
        if (currentPath === '' || currentPath === undefined) {
            currentPath = 'home.php';
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            let linkHref = link.getAttribute('href');
            if (linkHref.startsWith('/18_trancongdinh/php/admin/')) {
                linkHref = linkHref.split('/18_trancongdinh/php/admin/')[1];
            }
            linkHref = linkHref.split('?')[0];
            if (currentPath === linkHref) {
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
