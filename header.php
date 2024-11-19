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
</body>
</html>



