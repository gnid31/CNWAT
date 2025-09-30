<div class="menu-top-buttons"
    style="display:flex; gap:12px; margin-bottom:16px; justify-content:flex-start;padding-left: 10px;">
    <button onclick="window.location.href='../html/home_content.html'"
        style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Home</button>
    <button onclick="window.location.href='../html/index.html?lesson=1'"
        style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài
        1</button>
    <button onclick="window.location.href='../html/example_list.html?lesson=2'"
        style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài
        2</button>
    <button onclick="window.location.href='../php/home.php?lesson=3'"
        style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài
        3</button>
</div>
<ul>
    <li><a href="home.php">3.1. Home</a></li>
    <li><a href="draw_table.php">3.2. Draw Table</a></li>
    <li><a href="loop.php">3.3. Star Patterns</a></li>
    <li><a href="calculate1.php">3.4. Calculator</a></li>
    <li><a href="calculate2.php">3.5. Calculate Score</a></li>
    <li><a href="array1.php">3.6. Matrix Operations</a></li>
    <li><a href="array2.php">3.7. Multi-File Upload</a></li>
    <li><a href="uploadprocess.php">3.8. Upload Process</a></li>
    <li><a href="register.php">3.9. Đăng ký</a></li>
    <li><a href="registerProcess.php">3.10. Thông tin đăng ký</a></li>
    <li><a href="contact1Page.php">3.11. Form Liên hệ</a></li>
    <li><a href="/18_trancongdinh/php/Enduser/home.php">3.12. User</a></li>
    <li><a href="/18_trancongdinh/php/admin/index.php">3.13. Admin</a></li>
    <li><a href="/18_trancongdinh/php/student/student_home.php">3.14. Student</a></li>
</ul>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let currentPath = window.location.pathname.split('/').pop().split('?')[0];
        if (currentPath === '') {
            currentPath = 'home.php'; // Default for PHP lesson 3
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            const linkHref = link.getAttribute('href');
            let linkPath = linkHref.split('/').pop().split('?')[0];

            if (currentPath === linkPath) {
                link.classList.add('active');
                console.log('Active class added to:', linkHref);
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
