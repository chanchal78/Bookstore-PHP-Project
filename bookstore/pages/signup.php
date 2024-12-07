<?php 
include '../includes/header.php'; 
include '../includes/db.php'; 

// Initialize variables
$username = $email = $password = $confirm_password = "";
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    
    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check if email or username already exists in the database
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->execute(['email' => $email, 'username' => $username]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "Email or username already exists.";
        }
    }

    // If no errors, insert new user into the database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ]);

        // Redirect to login page after successful registration
        header('Location: login.php?success=1');
        exit;
    }
}
?>

<div class="auth-container">
    <div class="auth-box">
        <h2>Sign Up</h2>

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

        <!-- Signup form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn">Sign Up</button>
        </form>

        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
