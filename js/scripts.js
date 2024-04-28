window.onload = function () {

    function initializePage() {
        console.log('Page initialized')
        setEventListener()
    }
    initializePage()

    function setEventListener() {

        console.log('event listener set')
        const uploadButton = document.getElementById('upload-button')
        const uploadInput = document.getElementById('upload-input')

        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission behavior
            // e.stopPropagation();
            return console.log('form submitted')
            // Create FormData object to send form data asynchronously
            // var formData = new FormData(this);

            // // Submit the form data using Fetch API
            //  fetch(
            //     './functions.php', {
            //     method: 'POST',
            //     body: formData
            // })
            //     .then(response => {
            //         if (!response.ok) {
            //             throw new Error('Network response was not ok');
            //         }
            //         return response.json();
            //     })
            //     .then(data => {
            //         // Display success message from response

            //         const sucessAmount = data.successAmount
            //         const invalidPhoneCount = data.errorAmount
            //         const infoAmount = data.duplicateAmount

            //         if (sucessAmount > 0) {
            //             showSuccessMessage(sucessAmount)
            //         }
            //         if (infoAmount > 0) {
            //             showInfoToast(infoAmount)
            //         }
            //         if (invalidPhoneCount > 0) {
            //             showErrorMessage(invalidPhoneCount)
            //         }

            //         // Clear the form fields after successful submission
            //         // document.getElementById('uploadForm').reset

            //     })
            //     .catch(error => {
            //         // Display error message
            //         toastr.error('An error occurred while uploading the CSV file.');
            //         console.error(error);
            //     });
        });
    }


    function showSuccessMessage(amount) {

        const showToastButton = document.getElementById('show-toast');

        showToastButton.addEventListener('click', function () {

            console.log('clicked')
            toastr["success"](
                `${amount} contatos foram inseridos com sucesso!`
            )

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        })
    }

    function showInfoToast(amount) {

        const showToastButton = document.getElementById('show-toast');

        showToastButton.addEventListener('click', function () {

            console.log('clicked')
            toastr["info"](`${amount} contatos já existem na base de dados!`)

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        })
    }

    function showErrorMessage(amount) {
        toastr.error(`${amount} contatos não foram inseridos por conterem números inválidos!`)
    }

    //implementar inserção de intems com telefone inválido em uma tabela de relatorio

    function insertInvalidPhoneItem(itemList) {
        const table = document.getElementById('invalid-phone-table')

        itemList.forEach(item => {
            rowTemplate = `
            <tr>
                <td>${item.name}</td>
                <td>${item.phone}</td>
            </tr>
            `
            table.insertAdjacentHTML('beforeend', rowTemplate)

        })
    }

}
