<div class="menu-top-buttons" style="display:flex; gap:12px; margin-bottom:16px; justify-content:flex-start;padding-left: 10px;">
    <button onclick="window.location.href='../../html/home_content.html'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Home</button>
    <button onclick="window.location.href='../../html/index.html?lesson=1'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 1</button>
    <button onclick="window.location.href='../../html/example_list.html?lesson=2'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 2</button>
    <button onclick="window.location.href='../home.php?lesson=3'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 3</button>
</div>
<ul>
    <li><a href="home.php">User Home</a></li>
    <li><a href="login.php">Login</a></li>
</ul>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let currentPath = window.location.pathname.split('/').pop();
        if (currentPath === '') {
            currentPath = 'home.php'; // Default for End User Home
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (currentPath === linkPath || (currentPath === 'home.php' && linkPath === 'home.php') || (currentPath === 'login.php' && linkPath === 'login.php')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
