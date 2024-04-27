<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo CSV - ASC Brazi</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .header-color {
            background-color: var(--e-global-color-primary);
        }

        .send_button{
            background-color: var(--e-global-color-primary);

            
        }
        
        .send_button:hover{
            background-color: var(--e-global-color-ec068f9);
        }

        :root  {
            --e-global-color-primary: #66197E;
            --e-global-color-secondary: #0073AD;
            --e-global-color-text: #5E5E5E;
            --e-global-color-accent: #66197E;
            --e-global-color-ec068f9: #E7B829;
        }

    </style>
</head>


<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <img src="https://assets.kmaleon.com.br/files/products/5bf36504ba53c6351509bf81/1542677764600.png"
                    alt="SquareLogo" class="
                w-100
                h-18
                mx-auto
                mb-4
                object-cover
                border-2
                p-1
                bg-white
             ">
                <img src="https://assets.kmaleon.com.br/files/products/5bf36504ba53c6351509bf81/1542677764600.png"
                    alt="Avatar" class="
                w-20
                h-20
                mx-auto
                mb-4
                rounded-full
                object-cover
                border-2
                border-gray-500
                p-1
                bg-white
             ">

                <h2 class="text-xl font-bold">Sidebar</h2>
                <!-- Add sidebar content here -->
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class=" text-white py-4 px-6 header-color">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold ">Header - <span>ASC</span></h1>
                </div>
                <!-- Add header content here -->
            </header>
            <!-- Main Content Area -->
            <div class="container mx-auto mt-10 px-4">
                <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">
                    <h2 class="text-2xl font-semibold text-center mb-4">Upload de contatos da campanha</h2>
                    <form action="functions.php" method="POST" name="upload_excel" enctype="multipart/form-data">
                        <div class="container mx-auto mt-5">
                            <div class="max-w-lg mx-auto">
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <h2 class="text-xl font-semibold mb-4">Upload de Arquivo CSV</h2>
                                    <form action="functions.php" method="POST" name="upload_excel"
                                        enctype="multipart/form-data">
                                        <div class="mb-4">
                                            <label for="fileInput"
                                                class="block text-gray-700 text-sm font-bold mb-2">Selecione o arquivo
                                                CSV:</label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                type="file" id="fileInput" name="fileInput" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="campaign"
                                                class="block text-gray-700 text-sm font-bold mb-2">Campanha:</label>
                                            <input type="text"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="campaign" name="campaign" required>
                                        </div>
                                        <button type="submit" name="Import"
                                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline send_button">Enviar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container mx-auto mt-10">
                    <h1 class="text-2xl font-semibold">Contacts List</h1>
                    <!-- PHP script to fetch and display data -->
                    <?php include 'fetch_data.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- No Bootstrap JS needed with Tailwind CSS -->
</body>

</html>