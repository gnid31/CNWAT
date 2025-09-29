<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Upload Nhiều File</title>
    <link rel="stylesheet" href="../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        
        <div id="middle">
            <div id="left"></div>
            
            <div id="center">
                <p class="content-header">Trang upload nhiều file: associateArray (thao tác với mảng kết hợp và upload file)</p>
                <p class="form-instruction">form upload trên 1 page:</p>
                
                <h3>Sử dụng mảng kết hợp:</h3>
                <p class="form-instruction">(Bài toán: Upload 10 file, in danh sách tên 10 file và đường dẫn download file)</p>

                <form method="post" action="array2.php" enctype="multipart/form-data" class="file-upload-form">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div class="form-group file-input-group">
                            <label for="file<?php echo $i; ?>">File <?php echo $i; ?>:</label>
                            <input type="file" name="files[]" id="file<?php echo $i; ?>" class="file-input">
                        </div>
                    <?php endfor; ?>
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="upload_files" class="btn btn-primary">Upload</button>
                    </div>
                </form>

                <div class="upload-results">
                    <?php
                    $upload_dir = 'uploads/';

                    // Ensure the uploads directory exists
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    if (isset($_POST['upload_files']) && isset($_FILES['files'])) {
                        echo '<h4>Kết quả Upload:</h4>';
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
                                    echo '<p class="error-message">Lỗi khi tải lên file: ' . htmlspecialchars($file_name) . '.</p>';
                                }
                            } else if ($_FILES['files']['error'][$key] != UPLOAD_ERR_NO_FILE) {
                                echo '<p class="error-message">Lỗi upload file ' . htmlspecialchars($_FILES['files']['name'][$key]) . ': Mã lỗi ' . $_FILES['files']['error'][$key] . '.</p>';
                            }
                        }

                        if ($uploaded_count > 0) {
                            echo '<p>Đã tải lên thành công ' . $uploaded_count . ' file:</p>';
                            echo '<ul>';
                            foreach ($file_info_list as $name => $path) {
                                echo '<li>' . htmlspecialchars($name) . ' (<a href="' . htmlspecialchars($path) . '" target="_blank">Tải xuống</a>)</li>';
                            }
                            echo '</ul>';
                        } else if (empty($file_info_list) && $uploaded_count == 0 && count($_FILES['files']['name']) > 0) {
                            echo '<p class="error-message">Không có file nào được tải lên thành công.</p>';
                        } else if (count($_FILES['files']['name']) == 1 && $_FILES['files']['error'][0] == UPLOAD_ERR_NO_FILE) {
                            // No file selected
                        } else {
                            echo '<p class="error-message">Vui lòng chọn ít nhất một file để tải lên.</p>';
                        }
                    } else {
                        echo '<p>Không có file nào được gửi để xử lý.</p>';
                    }

                    echo '<h4>Danh sách file đã tải lên:</h4>';
                    $files_in_dir = array_diff(scandir($upload_dir), array('.', '..'));

                    if (!empty($files_in_dir)) {
                        echo '<ul>';
                        foreach ($files_in_dir as $file_name) {
                            $file_path = $upload_dir . $file_name;
                            echo '<li>Download File: <a href="' . htmlspecialchars($file_path) . '" target="_blank">' . htmlspecialchars($file_name) . '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>Chưa có file nào được tải lên.</p>';
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
