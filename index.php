<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon.png" type="image/png" />

    <!-- papa js-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

    <!-- Toastr JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Upload de Arquivo CSV - ASC Brazi</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- <script src="jquery-3.7.1.min.js"></script> -->

    <!-- Custom CSS -->

    <link rel="stylesheet" href="./css/global.css">

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


        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>


</head>


<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <?php include 'sidebar.html'; ?>

        <!-- Main Content -->
        <div class="flex-1 ml-60 overflow-y-auto">
            <!-- Header -->
            <header class=" text-white py-4 px-6 header-color">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold ">Header - <span>ASC</span></h1>
                </div>
                <!-- Add header content here -->
            </header>
            <!-- Main Content Area -->
            <div class="container mx-auto mt-10 px-4 
                
            ">
                <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">
                    <h2 class="text-2xl font-semibold text-center mb-4">Upload de contatos da campanha</h2>
                    <form id="uploadForm" action="functions.php" method="POST" name="upload_excel"
                        enctype="multipart/form-data">
                        <div class="container mx-auto mt-5">
                            <div class="max-w-lg mx-auto">
                                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                    <h2 class="text-xl font-semibold mb-4">
                                        Informações da campanha

                                    </h2>
                                    <form id="upload-form" action="functions.php" enctype="multipart/form-data"
                                        method="POST" name="upload_excel" enctype="multipart/form-data">
                                        <div class="mb-4">
                                            <label for="campaing"
                                                class="block text-gray-700 text-sm font-bold mb-2">Campanha:</label>
                                            <input type="text"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="campaing" name="campaing" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="fileInput"
                                                class="block text-gray-700 text-sm font-bold mb-2">Selecione o arquivo
                                                CSV:</label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                type="file" id="fileInput" name="fileInput" required>
                                        </div>
                                        <div id="sendButtonAndSpinnerWrapper" class="flex 
                                        justify-end  
                                        ">
                                            <div id='loadingSpinner' class="flex justify-center items-center w-full  "
                                                style="display: none;">
                                                <svg class="animate-spin ml-1 mr-3 h-5 w-5 text-black"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4">
                                                    </circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                            </div>

                                            <button id="submit-button" type="submit" name="Import"
                                                class="bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline send_button">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </form>
                </div>

                <div id="invalid-phone-data-container">



                </div>
            </div>

            <!-- Main JS -->
            <script type="text/javascript" src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>


</html>