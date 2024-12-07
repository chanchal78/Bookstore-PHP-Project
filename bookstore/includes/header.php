<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<header>
    <div class="navbar">
        <!-- Logo and Store Name -->
        <div class="logo">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Bookstore Logo">
            </a>
        </div>
        <!-- Store Name -->
        <?php if (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'signup.php'): ?>
            <div class="store-name">
                <h1>The Last Chapter</h1>  <!-- Store Name -->
            </div>
        <?php else: ?>
            <!-- Full Navbar for other pages (Home, Profile, etc.) -->
            <!-- Add search box and profile dropdown if not on login or signup page -->
            <div class="store-name">
                <h1>The Last Chapter</h1>  <!-- Store Name -->
            </div>
            

            <div class="profile">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="profile-dropdown">
                        <button class="profile-button">
                            <?php echo $_SESSION['username']; ?> <!-- Display logged-in username -->
                        </button>
                        <div class="profile-dropdown-content">
                            <a href="../pages/profile.php">View Profile</a>
                            <a href="../pages/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn">Login</a>
                <?php endif; ?>
            </div>

        <?php endif; ?>
        
    </div>
    
</header>




