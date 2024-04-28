"use strict";

window.addEventListener('load', function () {
    console.log('loaded')

    function initializePage() {
        console.log('Page initialized')
        setEventListener()
    }
    initializePage()

    function setEventListener() {

        console.log('event listener set')
        const uploadForm = document.getElementById('uploadForm')

        //show loading spinner
        const loadingSpinner = document.getElementById('loading-spinner')
        const submitButton = document.getElementById('submit-button')

        uploadForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission behavior

            // Display the loading spinner
            loadingSpinner.style.display = 'block';
            //add tailwind disabled class to button
            submitButton.classList.add('disabled')
            submitButton.disabled = true;

            const formData = new FormData(this)
            formData.append('Import', 'true')

            formData.forEach((value, key) => {
                console.log(key + ': ' + value);
            });

            fetch('./functions.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Display success message from response

                    const sucessAmount = data.successAmount
                    const invalidPhoneCount = data.errorAmount
                    const infoAmount = data.duplicateAmount

                    if (sucessAmount > 0) {
                        showSuccessMessage(sucessAmount)
                    }
                    if (infoAmount > 0) {
                        showInfoToast(infoAmount)
                    }
                    if (invalidPhoneCount > 0) {
                        showErrorMessage(invalidPhoneCount)
                    }

                    //hide loading spinner
                    loadingSpinner.style.display = 'none';
                    submitButton.disabled = false;

                    // Clear the form fields after successful submission
                    uploadForm.reset

                })
                .catch(error => {
                    // Display error message
                    toastr.error('An error occurred while uploading the CSV file.');
                    console.error(error);
                });
        });
    }

    const showToastButton = document.getElementById('show-toast');


    showToastButton.addEventListener('click', function () {

        console.log('clicked')
        toastr["success"](
            `teste contatos foram inseridos com sucesso!`
        )

    })

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


    function showSuccessMessage(amount) {

        toastr["success"](
            `${amount} contatos foram inseridos com sucesso!`
        )

    }

    function showInfoToast(amount) {

        toastr["info"](
            `${amount} contatos já existem na base de dados!`)


    }

    function showErrorMessage(amount) {

        toastr.error(
            `${amount} contatos não foram inseridos por conterem números inválidos!`)
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

})
