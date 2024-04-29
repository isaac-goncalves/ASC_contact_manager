<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Toastr JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Upload de Arquivo CSV - ASC Brazi</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- <script src="jquery-3.7.1.min.js"></script> -->

    <!-- Custom CSS -->
    <style>
        .header-color {
            background-color: var(--e-global-color-primary);
        }

        .send_button {
            background-color: var(--e-global-color-primary);

        }

        .send_button:hover {
            background-color: var(--e-global-color-ec068f9);
        }

        .send_button>:disabled {
            background-color: var(--e-global-color-ec068f9);
        }

        :root {
            --e-global-color-primary: #66197E;
            --e-global-color-secondary: #0073AD;
            --e-global-color-text: #5E5E5E;
            --e-global-color-accent: #66197E;
            --e-global-color-ec068f9: #E7B829;
            --e-global-color-sidebar: #0C3972;
        }

        .sidebar {
            background-color: var(--e-global-color-sidebar);
        }
    </style>

</head>


<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 sidebar text-white">
            <div class="p-4">
                <img src="https://assets.kmaleon.com.br/files/products/5bf36504ba53c6351509bf81/1542677764600.png"
                    alt="SquareLogo" class="
                w-100
                h-15
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

                <!-- Add sidebar content here -->
                <?php include 'sidebar.html'; ?>

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

            <div class="container mx-auto mt-10
            px-4 bg-white shadow-md rounded px-8 py-6
            ">
                <h1 class="text-2xl font-semibold 
                text-center mb-4
                ">Contacts List</h1>
                <!-- PHP script to fetch and display data -->


                <!-- make an campanha SEARCH AND  select with search using select 2  -->

                <div class="flex justify-center">

                    <div class="w-90">
                        <label for="contacts" class="block text-sm font-medium text-gray-700">Selecione uma
                            Campanha</label>

                        <select id="contacts" name="contacts" class="select2 w-full mt-1">
                            <option value="1">Campanha 1</option>
                            <option value="2">Campanha 2</option>
                            <option value="3">Campanha 3</option>
                            <option value="4">Campanha 4</option>
                            <option value="5">Campanha 5</option>
                        </select>

                        <?php
                        include 'fetch_data.php';
                        ?>

                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function () {
                    $('.select2').select2();
                });

            </script>

            <!-- Select2 -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

            <script type="text/javascript" src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            <!-- No Bootstrap JS needed with Tailwind CSS -->
</body>


</html>