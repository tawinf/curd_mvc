<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<h1>แก้ไขสินค้า: <?php echo htmlspecialchars($product->name); ?></h1>

<form action="index.php?action=update" method="post">
    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
    
    <label for="name">ชื่อสินค้า:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->name); ?>" required>

    <label for="price">ราคา:</label>
    <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product->price); ?>" required>

    <label for="description">รายละเอียด:</label>
    <textarea id="description" name="description"><?php echo htmlspecialchars($product->description); ?></textarea>

    <button type="submit">อัปเดต</button>
</form>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
