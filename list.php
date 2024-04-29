<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon.png" type="image/png" />

    <!-- Toastr JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Upload de Arquivo CSV - ASC Brazi</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- <script src="jquery-3.7.1.min.js"></script> -->

    <!-- Main CSS -->
    <link rel="stylesheet" href="./css/global.css">

    <style>
        .header-color {
            background-color: var(--e-global-color-primary);
        }
    </style>

</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <?php include 'sidebar.html'; ?>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class=" text-white py-4 px-6 header-color">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold ">Header - <span>ASC</span></h1>
                </div>
                <!-- Add header content here -->
            </header>

            <!-- Main Content Area-->
            <div class="container mx-auto mt-10 px-4 bg-white shadow-md rounded px-8 py-6">
                <h1 class="text-2xl font-semibold text-center mb-4">Lista de Contatos</h1>
                <div class="flex flex-wrap mx-3 mb-6">
                    <div class="w-90 mb-4">
                        <label for="contacts" class="block text-gray-700 text-sm font-bold mb-2">Selecione uma
                            Campanha</label>
                        <select id="contacts" name="contacts"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Selecione uma Campanha</option>
                        </select>
                    </div>

                    <table id="contacts-table" class="min-w-full bg-white shadow-md rounded-lg " style="">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Campanha</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sobrenome</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Telefone</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Endereço</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cidade</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CEP</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Data de Nascimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be displayed here -->
                        </tbody>
                    </table>

                    <div id='loadingSpinner' class="flex justify-center items-center w-full h-32 "
                        style="display: none;">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main JS -->
        <script type="text/javascript" src="js/list.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>


</html>