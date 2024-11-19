<?php
session_start();
include 'config.php';

// Proses login ketika form disubmit
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    // Query untuk mencari user dengan email dan password yang cocok
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Simpan email admin ke sesi
        $_SESSION['admin_email'] = $email;
        header('Location: dashboard.php'); // Alihkan ke dashboard jika login berhasil
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login Admin</h2>
        <?php if (isset($error)) { ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <?= $error; ?>
            </div>
        <?php } ?>
        
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700" for="email">Email</label>
                <input type="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700" for="password">Password</label>
                <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            </div>
            <button type="submit" name="login" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition duration-200">Login</button>
        </form>
    </div>
</body>
</html>

