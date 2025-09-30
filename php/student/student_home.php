<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Trang chủ Sinh viên</title>
    <link rel="stylesheet" href="../../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        <div id="middle">
            <div id="left"></div>
            <div id="center">
                <h1>Chào mừng đến với trang Quản lý Sinh viên!</h1>
                <p>Sử dụng các mục điều hướng bên trái để quản lý danh sách sinh viên.</p>
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
        if (currentPath === '' || currentPath === 'student_home.php') {
            currentPath = 'student_home.php';
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
