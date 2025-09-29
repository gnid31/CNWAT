<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Bài 3</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Chào mừng đến với web PHP</p>
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
