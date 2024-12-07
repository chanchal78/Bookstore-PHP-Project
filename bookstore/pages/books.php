<?php
session_start();
include '../includes/db.php';

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all books
try {
    $stmt = $conn->prepare("SELECT * FROM books ORDER BY created_at DESC");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching books: " . $e->getMessage());
}

include '../includes/header.php';
?>

<main>
    <h2>All Books</h2>
    <section class="book-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <img src="../images/<?php echo htmlspecialchars($book['image']); ?>" alt="Book Cover" class="book-image">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars(number_format($book['price'], 2)); ?></p>
                    <a href="book_details.php?id=<?php echo $book['id']; ?>" class="btn">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books available at the moment.</p>
        <?php endif; ?>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
