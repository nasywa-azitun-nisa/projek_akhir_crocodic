<?php
session_start();
include 'config.php';

// Jika belum login, alihkan ke halaman login
if (!isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit();
}

// Hitung total data dari setiap tabel
$total_customers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM customers"))['total'];
$total_categories = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM categories"))['total'];
$total_products = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
$total_orders = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];

// Ambil data dari masing-masing tabel
$customers = mysqli_query($conn, "SELECT * FROM customers LIMIT 5");
$categories = mysqli_query($conn, "SELECT * FROM categories LIMIT 5");
$products = mysqli_query($conn, "SELECT * FROM products LIMIT 5");
$orders = mysqli_query($conn, "SELECT o.*, c.name as customer_name FROM orders o JOIN customers c ON o.customer_id = c.id LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-blue-100 flex">

    <nav class="bg-blue-800 text-white w-64 min-h-screen p-5">
        <div class="mb-5">
            <a class="text-2xl font-bold" href="dashboard.php">DASBOARD</a>
        </div>
        <ul>
            <li class="mb-4">
                <a class="flex items-center hover:text-blue-300 transition" href="products.php">
                    <i class="fas fa-box-open mr-2"></i> Master Data
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center hover:text-blue-300 transition" href="transaksi.php">
                    <i class="fas fa-money-check-alt mr-2"></i> Transaksi
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center hover:text-blue-300 transition" href="rekap.php">
                    <i class="fas fa-chart-line mr-2"></i> Rekap
                </a>
            </li>
            <li>
                <a class="flex items-center hover:text-blue-300 transition" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-2"></i> LOGOUT
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 p-5 md:p-8">
        <h2 class="text-2xl font-bold mb-4">Selamat Datang di CrysTaliN!!</h2>
        <p class="mb-6 text-gray-700">Anda telah berhasil login. Ini merupakan halaman dashboard.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <!-- Panel informasi jumlah data -->
            <div class="bg-blue-600 text-white p-5 rounded-lg shadow-lg transition transform hover:scale-105">
                <h5 class="font-bold text-lg">Total Customers</h5>
                <p class="text-2xl"><?= $total_customers; ?></p>
            </div>
            <div class="bg-green-600 text-white p-5 rounded-lg shadow-lg transition transform hover:scale-105">
                <h5 class="font-bold text-lg">Total Categories</h5>
                <p class="text-2xl"><?= $total_categories; ?></p>
            </div>
            <div class="bg-yellow-600 text-white p-5 rounded-lg shadow-lg transition transform hover:scale-105">
                <h5 class="font-bold text-lg">Total Products</h5>
                <p class="text-2xl"><?= $total_products; ?></p>
            </div>
            <div class="bg-red-600 text-white p-5 rounded-lg shadow-lg transition transform hover:scale-105">
                <h5 class="font-bold text-lg">Total Orders</h5>
                <p class="text-2xl"><?= $total_orders; ?></p>
            </div>
        </div>

        <!-- Tabel data customers -->
        <h4 class="mb-4 font-bold text-xl">Recent Customers</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Phone</th>
                        <th class="border px-4 py-2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($customer = mysqli_fetch_assoc($customers)) { ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2"><?= $customer['id']; ?></td>
                            <td class="border px-4 py-2"><?= $customer['name']; ?></td>
                            <td class="border px-4 py-2"><?= $customer['phone']; ?></td>
                            <td class="border px-4 py-2"><?= $customer['email']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tabel data categories -->
        <h4 class="mb-4 font-bold text-xl">Recent Categories</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Category Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($category = mysqli_fetch_assoc($categories)) { ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2"><?= $category['id']; ?></td>
                            <td class="border px-4 py-2"><?= $category['name']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tabel data products -->
        <h4 class="mb-4 font-bold text-xl">Recent Products</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Product Name</th>
                        <th class="border px-4 py-2">Category ID</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = mysqli_fetch_assoc($products)) { ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2"><?= $product['id']; ?></td>
                            <td class="border px-4 py-2"><?= $product['name']; ?></td>
                            <td class="border px-4 py-2"><?= $product['category_id']; ?></td>
                            <td class="border px-4 py-2"><?= $product['price']; ?></td>
                            <td class="border px-4 py-2"><?= $product['stock']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tabel data orders -->
        <h4 class="mb-4 font-bold text-xl">Recent Orders</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Customer Name</th>
                        <th class="border px-4 py-2">Total Price</th>
                        <th class="border px-4 py-2">Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = mysqli_fetch_assoc($orders)) { ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2"><?= $order['id']; ?></td>
                            <td class="border px-4 py-2"><?= $order['customer_name']; ?></td>
                            <td class="border px-4 py-2"><?= $order['total_price']; ?></td>
                            <td class="border px-4 py-2"><?= $order['order_date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
