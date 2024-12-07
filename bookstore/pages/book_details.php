<?php
session_start();
include '../includes/db.php';

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get book details
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        die("Book not found.");
    }
} catch (PDOException $e) {
    die("Error fetching book details: " . $e->getMessage());
}

include '../includes/header.php';
?>

<main>
    <h2><?php echo htmlspecialchars($book['title']); ?></h2>
    <div class="book-details">
        <img src="../images/<?php echo htmlspecialchars($book['image']); ?>" alt="Book Cover" class="book-image">
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
        <p><strong>Price:</strong> Tk <?php echo htmlspecialchars(number_format($book['price'], 2)); ?></p>
        <p><strong>Description:</strong></p>
        <p><?php echo htmlspecialchars($book['description']); ?></p>
    </div>
    <a href="books.php" class="btn">All Books</a>
</main>

<?php include '../includes/footer.php'; ?>
