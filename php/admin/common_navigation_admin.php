<div class="menu-top-buttons" style="display:flex; gap:12px; margin-bottom:16px; justify-content:flex-start;padding-left: 10px;">
    <button onclick="window.location.href='../../html/home_content.html'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Home</button>
    <button onclick="window.location.href='../../html/index.html?lesson=1'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 1</button>
    <button onclick="window.location.href='../../html/example_list.html?lesson=2'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 2</button>
    <button onclick="window.location.href='../home.php?lesson=3'" style="padding:8px 18px; background:#1976d2; color:#fff; border:none; border-radius:8px; font-weight:bold; font-size:1em; cursor:pointer; box-shadow:0 2px 8px #bde0fe;">Bài 3</button>
</div>

<ul>
   
    <li><a href="index.php">Admin Dashboard</a></li>
    <li><a href="home.php">Admin Home</a></li>
    <li><a href="upload.php">Upload</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let currentPath = window.location.pathname.split('/').pop();
        if (currentPath === '') {
            currentPath = 'index.php'; // Default for Admin Dashboard
        }
        const navLinks = document.querySelectorAll('ul li a');
        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href').split('/').pop().split('?')[0];
            let currentBaseFile = currentPath.split('?')[0];

            if (currentBaseFile === linkPath ||
                (currentBaseFile === 'home_content.html' && linkPath === 'home_content.html') ||
                (currentBaseFile === 'index.html' && linkPath === 'index.html') ||
                (currentBaseFile === 'example_list.html' && linkPath === 'example_list.html') ||
                (currentBaseFile === 'home.php' && linkPath === 'home.php') ||
                (currentBaseFile === 'index.php' && linkPath === 'index.php') ||
                (currentBaseFile === 'upload.php' && linkPath === 'upload.php') ||
                (currentBaseFile === 'logout.php' && linkPath === 'logout.php')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
