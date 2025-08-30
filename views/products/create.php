<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<h1>เพิ่มสินค้าใหม่</h1>

<?php if (!empty($errors)): ?>
    <div class="alert error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?action=create" method="post">
    <label for="name">ชื่อสินค้า:</label>
    <input type="text" id="name" name="name" required>

    <label for="price">ราคา:</label>
    <input type="text" id="price" name="price" required>

    <label for="description">รายละเอียด:</label>
    <textarea id="description" name="description"></textarea>

    <button type="submit">บันทึก</button>
</form>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
