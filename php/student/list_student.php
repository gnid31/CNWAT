<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Danh sách Sinh viên</title>
    <link rel="stylesheet" href="../../html/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div id="main-container">
        <div id="top"></div>
        <div id="middle">
            <div id="left"></div>
            <div id="center">
                <?php
                function readStudentsFromFile($filename) {
                    $students = [];
                    if (file_exists($filename)) {
                        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                        for ($i = 0; $i < count($lines); $i += 3) {
                            if (isset($lines[$i+2])) {
                                $students[] = [
                                    'name' => $lines[$i],
                                    'address' => $lines[$i+1],
                                    'age' => (int)$lines[$i+2]
                                ];
                            }
                        }
                    }
                    return $students;
                }

                $studentFile = 'student.txt';
                $students = readStudentsFromFile($studentFile);

                echo '<h2>Danh sách Sinh viên</h2>';
                if (empty($students)) {
                    echo '<p>Không có sinh viên nào trong danh sách.</p>';
                } else {
                    echo '<table border="1" style="width:100%; border-collapse: collapse;">';
                    echo '<tr><th>STT</th><th>Tên</th><th>Địa chỉ</th><th>Tuổi</th></tr>';
                    foreach ($students as $index => $student) {
                        echo '<tr>';
                        echo '<td>' . ($index + 1) . '</td>';
                        echo '<td>' . htmlspecialchars($student['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['address']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['age']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>
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
        if (currentPath === '' || currentPath === 'list_student.php') {
            currentPath = 'list_student.php';
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
