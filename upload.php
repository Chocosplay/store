<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";

// กำหนดโฟลเดอร์เก็บไฟล์
$targetDir = "uploads/";

// ตั้งชื่อไฟล์เป็น profile.jpg (ทับไฟล์เก่า)
$targetFile = $targetDir . "profile.jpg";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES["image"]["tmp_name"];

    // ตรวจสอบว่าไฟล์ถูกอัปโหลดจริง ๆ
    if (is_uploaded_file($fileTmp)) {
        // ตรวจสอบว่าเป็นรูปจริง
        $check = getimagesize($fileTmp);
        if ($check !== false) {
            // ย้ายไฟล์ไปยังโฟลเดอร์
            if (move_uploaded_file($fileTmp, $targetFile)) {
                header("Location: indexedit.html");
                echo "อัปโหลดสำเร็จ!";
                echo "<br><a href='test.html'>กลับไปหน้าแรก</a>";
            } else {
                echo "เกิดข้อผิดพลาดในการย้ายไฟล์!";
            }
        } else {
            echo "ไฟล์นี้ไม่ใช่รูปภาพ!";
        }
    } else {
        echo "ไม่ได้อัปโหลดไฟล์!";
    }
} else {
    echo "ไม่มีไฟล์ที่ถูกเลือกหรือเกิดข้อผิดพลาดในการอัปโหลด!";
    if (isset($_FILES["image"])) {
        echo "<br>error code: " . $_FILES["image"]["error"];
    }
}
?>
