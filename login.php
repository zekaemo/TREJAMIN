<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap">
    <link rel="stylesheet" href="style/stylelogin.css" />
    <style>
        .credit { /* TIDAK BOLEH DIHAPUS */
            position: fixed;
            bottom: 0.625rem; /* 10px */
            left: 0.625rem; /* 10px */
            margin: 0;
            font-size: 0.625rem; /* 10px */
            color: #012970;
            opacity: 0.5;
            font-family: Nunito, var(--default-font-family);
        }

        .credit h3 {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <header class="header-section">
        <div class="header-section">
        <div class="content">
            <a class="link">
                <span class="tre-jamin">TRE-JAMIN</span>
            </a>
            <img src="assets/images/2-LOGO-JAMKRINDO.png" class="small-image" alt="Small Image">
            <img src="assets/images/images-removebg-preview.png" class="small-image2" alt="Small Image">
        </div>
        </div>
        </header>
        <div class="rectangle">
            <div class="flex-column-aae">
                <form action="" method="post">
                    <div class="frame">
                        <div class="group">
                            <span class="username">Username</span>
                            <input type="text" name="username" class="rectangle-1" required>
                        </div>
                        <div class="group-2">
                            <span class="password">Password</span>
                            <input type="password" name="password" class="rectangle-3" required>
                        </div>
                        <div class="error-wrapper">
                            <?php
                            if (isset($error)) {
                                echo "<div class='error'>$error</div>";
                            }
                            ?>
                        </div>
                        <button type="submit" class="group-5">
                            <span class="sign-in">Sign in</span>
                        </button>
                    </div>
                </form>
                <span class="jamkrindo-cabang-bandung">Jamkrindo Cabang Bandung</span>
            </div>
            <span class="letter-tracking-management">LETTER TRACKING<br />MANAGEMENT</span>
        </div>
        <div class="credit">
                    <h3><span>&copy; 2024 - TEKNIK KOMPUTER UNDIP 2022</span></h3>
        </div>
    </div>
    <?php
    session_start();
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Directly compare the password without hashing
        if ($user && $user['password'] === $password) {
            // Store user information in the session
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $user['nama'];
            // Redirect to index.php
            header('Location: index.php');
            exit();
        } else {
            $error = 'Invalid username or password';
        }
    }
    ?>
</body>
</html>

