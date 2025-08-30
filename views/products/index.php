<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<h1>รายการสินค้า</h1>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert success">สร้างสินค้าสำเร็จ!</div>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
    <div class="alert success">อัปเดตข้อมูลสินค้าสำเร็จ!</div>
<?php elseif (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <div class="alert success">ลบสินค้าสำเร็จ!</div>
<?php endif; ?>

<a href="index.php?action=create" class="button">เพิ่มสินค้าใหม่</a>

<table>
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>รายละเอียด</th>
            <th>จัดการ</th> </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $row['id']; ?>">แก้ไข</a>
                    <a href="index.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบสินค้านี้?');">ลบ</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
