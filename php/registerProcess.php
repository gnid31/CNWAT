<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thông tin Đăng ký</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
    <style>
        .registration-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        .registration-details p {
            margin-bottom: 10px;
            font-size: 1.1em;
            color: #333;
        }
        .registration-details p strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Thông tin Đăng ký của bạn</p>

                <div class="registration-details">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : 'N/A';
                        $password = isset($_POST['password']) ? str_repeat('*', strlen($_POST['password'])) : 'N/A';
                        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : 'N/A';
                        $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : 'N/A';
                        
                        $languages = isset($_POST['languages']) ? $_POST['languages'] : [];
                        $language_str = !empty($languages) ? htmlspecialchars(implode(', ', $languages)) : 'None';

                        $skill = isset($_POST['skill']) ? htmlspecialchars($_POST['skill']) : 'N/A';
                        $note = isset($_POST['note']) ? htmlspecialchars($_POST['note']) : 'N/A';
                        $marriage_status = isset($_POST['marriage_status']) ? 'Chưa kết hôn' : 'Đã kết hôn';

                        echo '<p><strong>Username:</strong> ' . $username . '</p>';
                        echo '<p><strong>Password:</strong> ' . $password . '</p>';
                        echo '<p><strong>Gender:</strong> ' . $gender . '</p>';
                        echo '<p><strong>Address:</strong> ' . $address . '</p>';
                        echo '<p><strong>Enable Programming Language:</strong> ' . $language_str . '</p>';
                        echo '<p><strong>Skill:</strong> ' . $skill . '</p>';
                        echo '<p><strong>Note:</strong> ' . $note . '</p>';
                        echo '<p><strong>Marriage Status:</strong> ' . $marriage_status . '</p>';
                    } else {
                        echo '<p>Không có dữ liệu đăng ký được gửi.</p>';
                    }
                    ?>
                </div>
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

        const footerResponse = await fetch('../html/common_footer.html');
        document.getElementById('bottom').innerHTML = await footerResponse.text();
    }

    document.addEventListener('DOMContentLoaded', loadCommonElements);
</script>
</body>
</html>
