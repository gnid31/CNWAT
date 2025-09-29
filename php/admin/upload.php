<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Admin Upload</title>
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
                <p class="content-header">Trang upload Files</p>

                    <?php
                    session_start();

                    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
                        echo '<div class="login-message error">Bạn chưa đăng nhập. Vui lòng <a href="../Enduser/login.php">đăng nhập</a> để truy cập trang upload file.</div>';
                    } else {
                        $message = '';
                        $upload_dir = '../uploads_admin/'; // Relative to admin/upload.php

                        // Ensure the uploads directory exists relative to the project root
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_files']) && isset($_FILES['files'])) {
                            $uploaded_count = 0;
                            $file_info_list = [];

                            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                                if ($_FILES['files']['error'][$key] == UPLOAD_ERR_OK) {
                                    $file_name = basename($_FILES['files']['name'][$key]);
                                    $target_file = $upload_dir . $file_name;

                                    if (move_uploaded_file($tmp_name, $target_file)) {
                                        $file_info_list[$file_name] = $target_file;
                                        $uploaded_count++;
                                    } else {
                                        $message .= '<div class="upload-message error">Lỗi khi tải lên file: ' . htmlspecialchars($file_name) . '.</div>';
                                    }
                                } else if ($_FILES['files']['error'][$key] != UPLOAD_ERR_NO_FILE) {
                                    $message .= '<div class="upload-message error">Lỗi tải lên file ' . htmlspecialchars($_FILES['files']['name'][$key]) . ': Mã lỗi ' . htmlspecialchars($_FILES['files']['error'][$key]) . '.</div>';
                                }
                            }

                            if ($uploaded_count > 0) {
                                $message .= '<div class="upload-message success">Đã tải lên thành công ' . $uploaded_count . ' file.</div>';
                            } else if (empty($file_info_list) && count($_FILES['files']['name']) > 0 && $_FILES['files']['error'][0] != UPLOAD_ERR_NO_FILE) {
                                 $message .= '<div class="upload-message error">Không có file nào được tải lên thành công.</div>';
                            } else if (count($_FILES['files']['name']) == 1 && $_FILES['files']['error'][0] == UPLOAD_ERR_NO_FILE) {
                                 // No file selected, do nothing specific as per the image. Message will be empty if no other errors.
                            } else if (count($_FILES['files']['name']) == 0) {
                                 $message .= '<div class="upload-message error">Vui lòng chọn ít nhất một file để tải lên.</div>';
                            }
                        }
                        ?>

                        <div class="admin-upload-container">
                            <form method="post" action="upload.php" enctype="multipart/form-data">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <div class="form-group">
                                        <input type="file" name="files[]">
                                    </div>
                                <?php endfor; ?>
                                <div class="form-actions">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" name="upload_files" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                        <?php echo $message; ?>

                        <div class="uploaded-files-list">
                            <h4>Các file đã tải lên:</h4>
                            <ul>
                                <?php
                                $files_in_dir = array_diff(scandir($upload_dir), array('.', '..'));
                                if (!empty($files_in_dir)) {
                                    foreach ($files_in_dir as $file_name) {
                                        $file_path_display = '../uploads_admin/' . $file_name; 
                                        echo '<li><a href="' . htmlspecialchars($file_path_display) . '" target="_blank">' . htmlspecialchars($file_name) . '</a></li>';
                                    }
                                } else {
                                    echo '<li>Chưa có file nào được tải lên.</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php }
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
