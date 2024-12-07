<?php
// Include session and database connection
session_start();
include 'includes/db.php';

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: pages/login.php');
    exit;
}

// Fetch books from the database
try {
    $stmt = $conn->prepare("SELECT * FROM books ORDER BY created_at DESC");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching books: " . $e->getMessage());
}

include 'includes/header.php';
?>

<main>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Discover the latest books available in our store.</p>

    
    <div>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search for books here" class="searchBox">
            <button type="submit" class="searchButton">Search</button>
        </form>
    </div>

    <p> </p>
    <!-- Display books -->
    <section>
        <h2>Available Books</h2>
        <?php if (!empty($books)): ?>
            <div class="book-list">
                <?php foreach ($books as $book): ?>
                    <div class="book-item">
                        <img src="images/<?php echo htmlspecialchars($book['image']); ?>" alt="Book Cover" class="book-image">
                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                        <p>Price: Tk <?php echo htmlspecialchars(number_format($book['price'], 2)); ?></p>
                        <a href="pages/book_details.php?id=<?php echo $book['id']; ?>" class="btn">View Details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No books available at the moment. Check back later!</p>
        <?php endif; ?>
    </section>

    <section class="contact-us">
        <h2>Contact Us</h2>
        <div class="contact-details">
            <p><strong>Phone:</strong> +880 1712298000</p>
            <p><strong>Email:</strong> <a href="mailto:chanchallm78@gmail.com">info@thelastchapter.com</a></p>
            <p><strong>Telephone:</strong> +880 999-888-777</p>
            <p><strong>Address:</strong> 123 Book Street, Savar, Dhaka</p>
            <p><strong>Opening Hours:</strong> Monday - Friday: 9:00 AM - 7:00 PM</p>
            <p><strong>Find us on the map:</strong> <a href="https://www.google.com/maps" target="_blank">View on Google Maps</a></p>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
