<?php 
include '../includes/header.php'; 
include '../includes/db.php'; 

// Initialize variables
$email = $password = "";
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize inputs
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate inputs
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Attempt login if no validation errors
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful: start a session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect to a dashboard or homepage
            header('Location: ../index.php');
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<div class="auth-container">
    <div class="auth-box">
        <h2>Login</h2>

        <!-- Display success message if redirected from signup -->
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                Registration successful! Please log in.
            </div>
        <?php endif; ?>

        <!-- Display errors -->
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Login form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>

        <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
