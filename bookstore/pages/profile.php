<?php
session_start();
include '../includes/db.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }
} catch (PDOException $e) {
    die("Error fetching profile: " . $e->getMessage());
}

include '../includes/header.php'; // Include navigation bar
?>

<main class="profile-page">
    <h2>Your Profile</h2>
    <div class="profile-details">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
    </div>
    
    <a href="books.php" class="btn">Back to Home</a>
</main>

<?php include '../includes/footer.php'; // Include footer ?>
