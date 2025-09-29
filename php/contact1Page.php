<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Form Liên hệ</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
    <style>
        .contact-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(25, 118, 210, 0.12);
            padding: 32px 28px;
            max-width: 420px;
            margin: 32px auto 0 auto;
            border: 1px solid #e3eafc;
        }
        .contact-form-container {
            width: 100%;
        }
      
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            color: #1976d2;
        }
        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #bcd4f6;
            border-radius: 8px;
            font-size: 1em;
            background: #f7fbff;
            transition: border 0.2s;
        }
        .form-group input[type="text"]:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #1976d2;
            outline: none;
        }
        .radio-group {
            display: flex;
            gap: 18px;
            align-items: center;
        }
        .radio-group label {
            margin-bottom: 0;
            font-weight: 400;
            color: #333;
        }
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 18px;
        }
        .btn {
            padding: 10px 28px;
            border-radius: 8px;
            border: none;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px #bde0fe;
            transition: background 0.2s, color 0.2s;
        }
        .btn-primary {
            background: #1976d2;
            color: #fff;
        }
        .btn-primary:hover {
            background: #1565c0;
        }
        .btn-secondary {
            background: #e3eafc;
            color: #1976d2;
        }
        .btn-secondary:hover {
            background: #bcd4f6;
        }
        .contact-results {
            background: #f7fbff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(25, 118, 210, 0.08);
            padding: 24px 20px;
            max-width: 420px;
            margin: 32px auto 0 auto;
            border: 1px solid #e3eafc;
        }
        .contact-results h4 {
            color: #1976d2;
            font-size: 1.3em;
            margin-bottom: 12px;
            text-align: center;
        }
        .contact-results p {
            margin-bottom: 10px;
            font-size: 1em;
        }
        .contact-results strong {
            color: #1565c0;
        }
        @media (max-width: 600px) {
            .contact-card, .contact-results {
                padding: 16px 8px;
                max-width: 98vw;
            }
        }
    </style>
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Form Liên hệ</p>

                <?php
                $username = '';
                $gender = '';
                $address = '';
                $note = '';
                $display_results = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact'])) {
                    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
                    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
                    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
                    $note = isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '';
                    $display_results = true;
                }
                ?>

                <div class="contact-form-container" <?php echo $display_results ? 'style="display:none;"' : ''; ?>>
                    <div class="contact-card">
                        <form method="post" action="contact1Page.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label>Gender:</label>
                                <div class="radio-group">
                                    <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                                    <label for="male">Male</label>
                                    <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <select id="address" name="address">
                                    <option value="Ha Noi" <?php echo ($address == 'Ha Noi') ? 'selected' : ''; ?>>Ha Noi</option>
                                    <option value="TP. HCM" <?php echo ($address == 'TP. HCM') ? 'selected' : ''; ?>>TP. HCM</option>
                                    <option value="Hue" <?php echo ($address == 'Hue') ? 'selected' : ''; ?>>Hue</option>
                                    <option value="Da Nang" <?php echo ($address == 'Da Nang') ? 'selected' : ''; ?>>Da Nang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <textarea id="note" name="note" rows="4"><?php echo $note; ?></textarea>
                            </div>
                            <div class="form-actions">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" name="contact" class="btn btn-primary">Contact</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if ($display_results): ?>
                     <div class="contact-results">
                         <h4>Thông tin liên hệ</h4>
                         <p><strong>Username:</strong> <span><?php echo $username; ?></span></p>
                         <p><strong>Gender:</strong> <span><?php echo ($gender == 'Male') ? 'Nam' : (($gender == 'Female') ? 'Nữ' : 'N/A'); ?></span></p>
                         <p><strong>Address:</strong> <span><?php echo $address; ?></span></p>
                         <p><strong>Note:</strong> <span><?php echo $note; ?></span></p>
                     </div>
                 <?php endif; ?>

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

        // Sau khi navigation đã được load, thực hiện tô sáng menu
        // Lấy đường dẫn tương đối từ thư mục php/
        let currentPath = window.location.pathname.split('/18_trancongdinh/php/')[1] || '';
        currentPath = currentPath.split('?')[0];
        if (currentPath === '' || currentPath === undefined) {
            currentPath = 'home.php';
        }
        const navLinks = document.querySelectorAll('#left ul li a');
        navLinks.forEach(link => {
            let linkHref = link.getAttribute('href');
            // Chuẩn hóa đường dẫn tương đối cho link
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
