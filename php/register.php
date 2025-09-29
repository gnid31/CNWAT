<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Form Đăng ký</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Form Đăng ký</p>

                <form method="post" action="registerProcess.php" class="registration-form">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Gender:</label>
                        <div class="radio-group">
                            <input type="radio" id="male" name="gender" value="Male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female">
                            <label for="female">Female</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <select id="address" name="address">
                            <option value="Ha Noi">Ha Noi</option>
                            <option value="TP. HCM">TP. HCM</option>
                            <option value="Hue">Hue</option>
                            <option value="Da Nang">Da Nang</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Enable Programming Language:</label>
                        <div class="checkbox-group">
                            <input type="checkbox" id="php" name="languages[]" value="PHP">
                            <label for="php">PHP</label>
                            <input type="checkbox" id="csharp" name="languages[]" value="C#">
                            <label for="csharp">C#</label>
                            <input type="checkbox" id="java" name="languages[]" value="Java">
                            <label for="java">Java</label>
                            <input type="checkbox" id="cpp" name="languages[]" value="C++">
                            <label for="cpp">C++</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Skill:</label>
                        <div class="radio-group">
                            <input type="radio" id="normal" name="skill" value="Normal">
                            <label for="normal">Normal</label>
                            <input type="radio" id="good" name="skill" value="Good">
                            <label for="good">Good</label>
                            <input type="radio" id="verygood" name="skill" value="Very Good">
                            <label for="verygood">Very Good</label>
                            <input type="radio" id="excellent" name="skill" value="Excellent">
                            <label for="excellent">Excellent</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea id="note" name="note" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="marriage_status">Marriage Status:</label>
                        <input type="checkbox" id="marriage_status" name="marriage_status" value="Chưa kết hôn">
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
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
