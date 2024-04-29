"use strict";

window.addEventListener('load', function () {

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
                    const invalidPhoneCount = data.invalidPhoneCount
                    const infoAmount = data.duplicateAmount

                    if (sucessAmount > 0) {
                        showSuccessMessage(sucessAmount)
                    }
                    if (infoAmount > 0) {
                        showInfoToast(infoAmount)
                    }
                    if (invalidPhoneCount > 0) {
                        showErrorMessage(invalidPhoneCount)

                        const invalidPhoneDataContainer = document.getElementById('invalid-phone-data-container')

                        const htmlTemplate = `
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <div class="flex justify-between items-center mr-4">
                            <p>
                                Erro ao inserir<strong> ${invalidPhoneCount}</strong> contatos por conterem números inválidos.
                            </p>
                            <button id="download-invalid-phone-button margin-left-4"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline ml-4 text-sm">
                                Download CSV
                            </button>
                            <button class="absolute top-0 right-0 px-2 py-1 text-sm"
                                    onclick="this.parentElement.parentElement.style.display='none'">
                                X
                            </button>
                        </div>
                    </div>
                        `

                        invalidPhoneDataContainer.insertAdjacentHTML('beforeend', htmlTemplate)
                    }

                    //download invalid phone data via csv
                    const invalidPhoneData = data.invalidPhoneData

                    const DownloadInvalidPhoneButton = document.getElementById('download-invalid-phone-button')


                    DownloadInvalidPhoneButton.addEventListener('click', function () {
                        try {
                            const csv = Papa.unparse(invalidPhoneData)
                            const blob = new Blob([csv], { type: 'text/csv' })
                            const url = URL.createObjectURL(blob)
                            const a = document.createElement('a')
                            const currentDate = new Date().toISOString().slice(0, 10)

                            a.setAttribute('href', url)
                            a.setAttribute('download', `invalid_phone_data_${currentDate}.csv`)
                            a.click()

                        } catch (error) {
                            console.error(error)
                            toastr.error('An error occurred while downloading the invalid phone data.')
                        }
                    })

                    //hide loading spinner
                    loadingSpinner.style.display = 'none';
                    submitButton.disabled = false;

                    // Clear the form fields after successful submission
                    this.reset();

                })
                .catch(error => {
                    // Display error message
                    toastr.error('An error occurred while uploading the CSV file.');
                    console.error(error);
                });
        });
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
                            < tr >
                <td>${item.name}</td>
                <td>${item.phone}</td>
            </tr >
                            `
            table.insertAdjacentHTML('beforeend', rowTemplate)

        })
    }

})
