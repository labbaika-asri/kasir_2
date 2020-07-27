$(document).ready(function () {
    /* Function Rupiah */
    function rupiah(number, prefix) {
        var number_string = number.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            rest = split[0].length % 3,
            rupiah = split[0].substr(0, rest),
            thousand = split[0].substr(rest).match(/\d{3}/gi);

        // put dot if input be housand
        if (thousand) {
            separator = rest ? "." : "";
            rupiah += separator + thousand.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
    // remove Rupiah
    function removeRupiah(rupiah) {
        let result = rupiah.replace("Rp. ", "");
        for (var i = 0; i < result.length; i++) {
            if (result.indexOf(".")) {
                result = result.replace(".", "");
            }
        }
        return parseInt(result);
    }
    // Function for username valid
    function usernameValid(element) {
        if (element.val().length >= 3) {
            element.addClass("is-valid");
            element.removeClass("is-invalid");
        } else if (element.val().length === 0) {
            element.addClass("is-invalid");
            element.removeClass("is-valid");
        } else {
            element.addClass("is-invalid");
            element.removeClass("is-valid");
        }
    }
    // Function for paswword valid
    function passwordValid(password, rePassword) {
        if (password.val().length > 7) {
            password.addClass("is-valid");
            password.removeClass("is-invalid");
            if (rePassword.val() != "" && rePassword.val() == password.val()) {
                password.addClass("is-valid");
                password.removeClass("is-invalid");
                rePassword.addClass("is-valid");
                rePassword.removeClass("is-invalid");
            } else if (rePassword.val() == "") {
                password.addClass("is-valid");
                password.removeClass("is-invalid");
            } else {
                rePassword.addClass("is-invalid");
                rePassword.removeClass("is-valid");
            }
        } else {
            password.addClass("is-invalid");
            password.removeClass("is-valid");
        }
    }
    // Function for repaswword valid
    function rePasswordValid(rePassword, password) {
        if (rePassword.val().length > 7) {
            if (password.val() != "" && password.val() == rePassword.val()) {
                rePassword.addClass("is-valid");
                rePassword.removeClass("is-invalid");
                password.addClass("is-valid");
                password.removeClass("is-invalid");
            } else if (password.val() == "") {
                rePassword.addClass("is-valid");
                rePassword.removeClass("is-invalid");
            } else {
                rePassword.addClass("is-invalid");
                rePassword.removeClass("is-valid");
            }
        } else {
            rePassword.addClass("is-invalid");
            rePassword.removeClass("is-valid");
        }
    }
    // Function submit chacked
    function SubmitChecked(button, ...data) {
        let result = data.map((d) => d.hasClass("is-valid"));
        if (result.includes(false)) {
            button.prop("disabled", true);
        } else {
            button.prop("disabled", false);
        }
    }
    // Function for show alert
    function flashAlert(flashData, link) {
        if (flashData) {
            flashData = flashData.split("-");
            Swal.fire({
                icon: flashData[0],
                title: flashData[1],
                text: flashData[2],
                onDestroy: () => (document.location.href = link),
            });
        }
    }
    // FunctionResetModal
    function modalReset(
        modalName,
        removeClass = false,
        deleteInput = false,
        inputTotal = null,
        nameInputItem = null,
        buttonPlus = null,
        buttonMinus = null
    ) {
        const input = modalName.find("input");
        input.val("");

        if (removeClass) {
            input.removeClass("is-valid");
            input.removeClass("is-invalid");
        }

        if (inputTotal && deleteInput && input.length !== inputTotal) {
            const memory = modalName.find(
                `input[name^=memory${nameInputItem}]`
            );
            const purchasePrice = modalName.find(
                `input[name^=purchasePrice${nameInputItem}]`
            );
            const sellingPrice = modalName.find(
                `input[name^=sellingPrice${nameInputItem}]`
            );
            for (let i = memory.length; i > 1; i--) {
                memory[i - 1].remove();
                purchasePrice[i - 1].remove();
                sellingPrice[i - 1].remove();
            }
            buttonPlus.removeClass("d-none");
            buttonPlus.prop("disabled", false);
            buttonMinus.addClass("d-none");
            buttonMinus.prop("disabled", true);
        }
    }
    // Fuction for button plus
    function btnPlus(
        buttonPlus,
        purchasePriceContainer,
        buttonMinus,
        name,
        inputCount
    ) {
        let memoryInput = $(`
                <input
                    type="text"
                    class="form-control small-input d-inline-block mb-lg-0 mr-2"
                    id="memory${name}${inputCount}"
                    name="memory${name}${inputCount}"
                    required
                ></input>
            `);

        let purchasePriceInput = $(`   
                <input 
                    type="text" 
                    class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                    id="purchasePrice${name}${inputCount}" 
                    name="purchasePrice${name}${inputCount}" 
                    required
                ></input>
            `);
        purchasePriceInput.on("keyup", function () {
            $(this).val(rupiah($(this).val(), "Rp. "));
        });

        let sellingPriceInput = $(`
                <input 
                    type="text" 
                    class="form-control small-input d-inline-block mb-2 mr-2 rupiah-format"
                    id="sellingPrice${name}${inputCount}" 
                    name="sellingPrice${name}${inputCount}" 
                    required
                ></input>
            `);
        sellingPriceInput.on("keyup", function () {
            $(this).val(rupiah($(this).val(), "Rp. "));
        });

        memoryInput.insertBefore(buttonPlus);
        purchasePriceContainer.append(purchasePriceInput);
        sellingPriceInput.insertBefore(buttonMinus);

        inputCount++;

        if (inputCount >= 5) {
            buttonPlus.addClass("d-none");
            buttonPlus.prop("disabled", true);
        }

        if (inputCount >= 2) {
            buttonMinus.removeClass("d-none");
            buttonMinus.prop("disabled", false);
        }
    }
    // resetInputStock
    function resetInputStock() {
        $("#visibilityInputStock input").val("");
        $("#visibilityInputStock input").removeClass("is-invalid");
        $("#visibilityInputStock select").removeClass("is-invalid");
        $("#visibilityInputStock option[value!='']").remove();
        $("#visibilityInputStock").addClass("d-none");
    }
    // resetInputStock
    function resetCashier() {
        $("#visibilityCashier input").val("");
        $("#visibilityCashier input").removeClass("is-invalid");
        $("#visibilityCashier select").removeClass("is-invalid");
        $("#visibilityCashier option[value!='']").remove();
        $("#qtyCashier").prop("disabled", true);
        $("#qtyCashier").prop("placeholder", "");
        $("#visibilityCashier").addClass("d-none");
    }
    // make select option
    function optionInput(id, data) {
        if (data === undefined) data = id;
        return `<option value="${id}">${data}</option>`;
    }
    // show Result Input Stock
    function showResultInputStock(dataResult) {
        // Reset result
        $("#visibilityResultInputStock tbody").children().remove();
        for (let i = 0; i < dataResult.length; i++) {
            let serialNumber = Date.now() + `${i}`;
            let rowResultInputStock = `
                <tr>
                    <th scope="row" class="align-middle text-center order">
                        ${i + 1}
                    </th>
                    <td>
                        <input type="number" class="form-control" 
                        id="serialNumberResultInputStock${i + 1}" 
                        name="serialNumberResultInputStock${i + 1}" 
                        autocomplete="off" 
                        value = "${serialNumber}" 
                        required>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="brandResultInputStock${i + 1}" 
                        name="brandResultInputStock${i + 1}" 
                        value="${dataResult[i][0]}" 
                        readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="typeResultInputStock${i + 1}" 
                        name="typeResultInputStock${i + 1}" 
                        value="${dataResult[i][1]}" 
                        readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="colorResultInputStock${i + 1}" 
                        name="colorResultInputStock${i + 1}" 
                        value="${dataResult[i][2]}" 
                        readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="memoryResultInputStock${i + 1}" 
                        name="memoryResultInputStock${i + 1}" 
                        value="${dataResult[i][3]}" 
                        readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="purchasePriceResultInputStock${i + 1}" 
                        name="purchasePriceResultInputStock${i + 1}" 
                        value="${dataResult[i][4]}" 
                        readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                        id="sellingPriceResultInputStock${i + 1}" 
                        name="sellingPriceResultInputStock${
                            i + 1
                        }"                       
                        value="${dataResult[i][5]}" 
                        readonly>
                    </td>
                    <td class="align-middle">
                        <span class="btn btn-danger btn-sm btn-delete-input-stock text-light" data-index="${i}">
                            <i class="fas fa-times"></i>
                        </span>
                    </td>
                </tr>`;
            $("#visibilityResultInputStock tbody").append(rowResultInputStock);
        }

        // Delete Result Stock
        $(".btn-delete-input-stock").on("click", function () {
            dataResult.splice($(this).data("index"), 1);
            if (dataResult.length < 1) {
                $("#visibilityResultInputStock").addClass("d-none");
                $("#submitInputStock").prop("disabled", true);
                showResultInputStock(dataResult);
            } else {
                showResultInputStock(dataResult);
            }
        });
    }
    // function min max
    function minMax(value, max) {
        if (value > max) {
            return max;
        } else if (value < max) {
            return "1";
        } else {
            return value;
        }
    }
    // show result cashier
    function showResultCashier(dataResult) {
        // Reset result casher
        $("#visibilityResultCashier tbody tr").not("#amountPaid").remove();

        for (let i = 0; i < dataResult.length; i++) {
            let rowResultCashier = $(`
                <tr>
                    <th scope="row" class="align-middle text-center">
                        ${i + 1}
                    </th>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="brandResultCashier${i + 1}"
                            name="brandResultCashier${i + 1}" 
                            value="${dataResult[i][0]}"
                            readonly >
                    </td>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="typeResultCashier${i + 1}"
                            name="typeResultCashier${i + 1}" 
                            value="${dataResult[i][1]}"
                            readonly >
                    </td>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="colorResultCashier${i + 1}"
                            name="colorResultCashier${i + 1}"
                            value="${dataResult[i][2]}"
                            readonly >
                    </td>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="memoryResultCashier${i + 1}"
                            name="memoryResultCashier${i + 1}" 
                            value="${dataResult[i][3]}"
                            readonly >
                    </td>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="sellingPriceResultCashier${i + 1}"
                            name="sellingPriceResultCashier${i + 1}" 
                            value="${dataResult[i][4]}"
                            readonly >
                    </td>
                    <td>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="qtyResultCashier${i + 1}"
                            name="qtyResultCashier${i + 1}" 
                            value="${dataResult[i][6]}"
                            min="1"
                            max="${dataResult[i][5]}"
                            data-index="${i}" 
                            required >
                    </td>
                    <td>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="totalPriceResultCashier${i + 1}"
                            readonly>
                    </td>
                    <td class="align-middle">
                        <span class="btn btn-danger btn-sm btn-close text-light btn-delete-cashier" data-index="${i}" >
                            <i class="fas fa-times"></i>
                        </span>
                    </td>
                </tr>                  
            `);

            rowResultCashier.insertBefore(
                $("#visibilityResultCashier tbody #amountPaid")
            );
            // set total Price
            $(`#totalPriceResultCashier${i + 1}`).val(
                rupiah(
                    (
                        removeRupiah(dataResult[i][4]) *
                        parseInt(dataResult[i][6])
                    ).toString(),
                    "Rp."
                )
            );
            // Quantity result casir event
            $(`#qtyResultCashier${i + 1}`).on("change", function () {
                if ($(this).val()) {
                    $(this).val(minMax($(this).val(), $(this).attr("max")));
                } else {
                    $(this).val("1");
                }

                dataResultCashier[$(this).data("index")][6] = $(this).val();

                $(`#totalPriceResultCashier${$(this).data("index") + 1}`).val(
                    rupiah(
                        (
                            removeRupiah(dataResult[$(this).data("index")][4]) *
                            parseInt(dataResult[$(this).data("index")][6])
                        ).toString(),
                        "Rp."
                    )
                );

                let totalPrice = [];
                $(`input[id^=totalPriceResultCashier]`).each(function () {
                    totalPrice.push(removeRupiah($(this).val()));
                });
                totalPrice = totalPrice.reduce((x, y) => x + y, 0);

                $("#amountPaidResultCashier").val(
                    rupiah(totalPrice.toString(), "Rp. ")
                );
            });
        }

        // Delete result Cashier
        $(".btn-delete-cashier").on("click", function () {
            dataResult.splice($(this).data("index"), 1);
            if (dataResult.length < 1) {
                $("#visibilityResultCashier").addClass("d-none");
                $("#submitCashier").prop("disabled", true);
                showResultCashier(dataResult);
            } else {
                showResultCashier(dataResult);
            }
        });

        // set amount paid
        let totalPrice = [];
        $(`input[id^=totalPriceResultCashier]`).each(function () {
            totalPrice.push(removeRupiah($(this).val()));
        });
        totalPrice = totalPrice.reduce((x, y) => x + y, 0);

        $("#amountPaidResultCashier").val(
            rupiah(totalPrice.toString(), "Rp. ")
        );
    }
    // Autocomplete data items
    let dataItems = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        // prefetch: "../controllers/ajax/data_items.php",
        remote: {
            url: "../controllers/ajax/search_data_items.php?keyword=%QUERY",
            wildcard: "%QUERY",
        },
    });
    // Autocomplete data stock
    let dataStocks = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,

        // prefetch: "../controllers/ajax/data_items.php",
        remote: {
            url: "../controllers/ajax/search_data_stocks.php?keyword=%QUERY",
            wildcard: "%QUERY",
        },
    });
    // data result input stock
    let dataResultInputStock = [];
    // data result cashier
    let dataResultCashier = [];

    // View employe event
    $(".employe").ready(function () {
        // Flash Data
        let flashData = $(".flash-data-employe").data("flashdata");
        let link = $(".flash-data-employe").data("link");
        flashAlert(flashData, link);
        // Add Employe Modal
        const addEmployeButton = $(
            "#addNewEmployeModal button[name='addNewEmployeButton']"
        );
        const addEmployeUsername = $("#addNewEmployeUsername");
        const addEmployePassword = $("#addNewEmployePassword");
        const addEmployeRePassword = $("#addNewEmployeRePassword");
        const addEmployeModal = $(".add-employe-modal");
        // Reset Modal add employe
        $(".add-employe-modal-button").on("click", function () {
            modalReset(addEmployeModal, true);
            addEmployeButton.prop("disabled", true);
        });
        // Add Employe Username Validation
        addEmployeUsername.on("keyup", function () {
            const value = $(this).val().trim();
            $(this).val(value);
            usernameValid($(this));
            SubmitChecked(
                addEmployeButton,
                addEmployeUsername,
                addEmployePassword,
                addEmployeRePassword
            );
        });
        // Add Employe Password Validation
        addEmployePassword.on("keyup", function () {
            passwordValid($(this), addEmployeRePassword);
            SubmitChecked(
                addEmployeButton,
                addEmployeUsername,
                addEmployePassword,
                addEmployeRePassword
            );
        });
        // Add Employe Repeat Password Validation
        addEmployeRePassword.on("keyup", function () {
            rePasswordValid($(this), addEmployePassword);
            SubmitChecked(
                addEmployeButton,
                addEmployeUsername,
                addEmployePassword,
                addEmployeRePassword
            );
        });
        // Add Employe Reset Event
        $("#addNewEmployeModal button[type='reset']").on("click", function () {
            modalReset(addEmployeModal, true);
            addEmployeButton.prop("disabled", true);
        });
        // Change Employe Password Modal
        const changeEmployePassswordButton = $(
            "#changeEmployePasswordModal button[name='changeEmployePasswordButton']"
        );
        const changeEmployePassword = $("#changeEmployePassword");
        const changeEmployeRePassword = $("#changeEmployeRePassword");
        const changeEmployePasswordModal = $(".change-password-employe-modal");
        // Reset Modal
        $(".change-employe-password-link").on("click", function () {
            modalReset(changeEmployePasswordModal, true);
            changeEmployePassswordButton.prop("disabled", true);
        });
        // Change Employe Password Validation
        changeEmployePassword.on("keyup", function () {
            passwordValid($(this), changeEmployeRePassword);
            SubmitChecked(
                changeEmployePassswordButton,
                changeEmployePassword,
                changeEmployeRePassword
            );
        });
        // Change Employe Repeat Password Validation
        changeEmployeRePassword.on("keyup", function () {
            rePasswordValid($(this), changeEmployePassword);
            SubmitChecked(
                changeEmployePassswordButton,
                changeEmployePassword,
                changeEmployeRePassword
            );
        });
        // Change Employe Reset Event
        $("#changeEmployePasswordModal button[type='reset']").on(
            "click",
            function () {
                modalReset(changeEmployePasswordModal, true);
                changeEmployePassswordButton.prop("disabled", true);
            }
        );
        // Change Employe Password
        const changePasswordLink = $(".change-employe-password-link");
        changePasswordLink.on("click", function () {
            const employeUsername = $(this)
                .parent()
                .children("p[data-employeusername]")
                .data("employeusername");

            const modalTitle = $("#changeEmployePasswordModal .modal-title");
            const inputEmployeUsername = $(
                "#changeEmployePasswordModal #changeEmployePasswordUsername"
            );
            modalTitle.html(`Change ${employeUsername} Password`);
            inputEmployeUsername.val(employeUsername);
        });
        // Delete Employe
        const deleteLink = $(".delete-employe-link");
        deleteLink.on("click", function (e) {
            e.preventDefault();
            let id = $(this).data("employeid");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "../controllers/ajax/delete_employe.php",
                        type: "POST",
                        data: { id: id },
                        typeData: "json",
                    }).done(function (data) {
                        let flashData;
                        let link =
                            "http://localhost/kasir.v2/views/admin.php?menu=employe";
                        if (data > 0) {
                            flashData =
                                "success-Successfull!-The employe was delete successfully";
                        } else {
                            flashData =
                                "error-Unsuccessfull!-The employe was not delected successfully.";
                        }
                        flashAlert(flashData, link);
                    });
                }
            });
        });
    });

    // View profile event
    $(".profile").ready(function () {
        // Flash Data
        let flashData = $(".flash-data-profile").data("flashdata");
        let link = $(".flash-data-profile").data("link");
        flashAlert(flashData, link);
        // Change password modal
        const changePasswordButton = $(
            "#changePasswordModal button[name='changePassword']"
        );
        const changePassword = $("#password");
        const changeRePassword = $("#rePassword");
        const changePasswordModal = $(".change-password-modal");

        // Reset change password modal
        $(".change-password-profile").on("click", function () {
            modalReset(changePasswordModal, true);
            changePasswordButton.prop("disabled", true);
        });
        // Change Password Validation
        changePassword.on("keyup", function () {
            passwordValid($(this), changeRePassword);
            SubmitChecked(
                changePasswordButton,
                changePassword,
                changeRePassword
            );
        });
        // Change Repeat Password Validation
        changeRePassword.on("keyup", function () {
            rePasswordValid($(this), changePassword);
            SubmitChecked(
                changePasswordButton,
                changePassword,
                changeRePassword
            );
        });
        // Change Password Reset Event
        $("#changePasswordModal button[type='reset']").on("click", function () {
            modalReset(changeEmployePasswordModal, true);
            changePasswordButton.prop("disabled", true);
        });
    });

    // View stock event
    $(".stock").ready(function () {
        // Change format rupiah
        $(".rupiah-format").on("keyup", function () {
            $(this).val(rupiah($(this).val(), "Rp. "));
        });
        // Flash Data
        let flashData = $(".flash-data-stock").data("flashdata");
        let link = $(".flash-data-stock").data("link");
        flashAlert(flashData, link);

        // Input Item
        const buttonPlusInputItem = $(".btn-plus-input-item");
        const purchasePriceContainerInputItem = $(
            ".purchase-price-container-input-item"
        );
        const buttonMinusInputItem = $(".btn-minus-input-item");
        const modalInputItem = $(".input-item-modal");
        const totalInputItem = 6;
        const nameInputItem = "InputItem";
        // Delete space in brand input
        $("#brandInputItem").on("keyup", function () {
            $(this).val($(this).val().trim());
        });
        // Modal reset input item
        $(".button-input-item-modal").on("click", function () {
            modalReset(
                modalInputItem,
                false,
                true,
                totalInputItem,
                nameInputItem,
                buttonPlusInputItem,
                buttonMinusInputItem
            );
        });
        // Button plus function
        buttonPlusInputItem.on("click", function () {
            let countInputItem = $("input[name^=memoryInputItem]").length + 1;
            btnPlus(
                buttonPlusInputItem,
                purchasePriceContainerInputItem,
                buttonMinusInputItem,
                nameInputItem,
                countInputItem
            );
            countInputItem++;
        });
        // Button minus function
        buttonMinusInputItem.on("click", function () {
            let countInputItem = $("input[name^=memoryInputItem]").length;
            $(`#memory${nameInputItem}${countInputItem}`).remove();
            $(`#purchasePrice${nameInputItem}${countInputItem}`).remove();
            $(`#sellingPrice${nameInputItem}${countInputItem}`).remove();

            if (countInputItem <= 2) {
                buttonMinusInputItem.addClass("d-none");
                buttonMinusInputItem.prop("disabled", true);
            }

            if (countInputItem <= 5) {
                buttonPlusInputItem.removeClass("d-none");
                buttonPlusInputItem.prop("disabled", false);
            }
        });

        // Update Item
        const buttonPlusUpdateItems = $(".btn-plus-update-items");
        const purchasePriceContainerUpdateItems = $(
            ".purchase-price-container-update-items"
        );
        const buttonMinusUpdateItems = $(".btn-minus-update-items");
        const modalUpdateItems = $(".update-items-modal");
        const totalUpdateItems = 9;
        const nameUpdateItems = "UpdateItems";
        const buttonUpdateItems = [
            modalUpdateItems.find(".modal-footer button[type='reset']"),
            modalUpdateItems.find(
                ".modal-footer button.button-delete-update-items"
            ),
            modalUpdateItems.find(".modal-footer #submitUpdateItems"),
        ];
        // Modal reset
        $(".button-update-items-modal").on("click", function () {
            modalReset(
                modalUpdateItems,
                false,
                true,
                totalUpdateItems,
                nameUpdateItems,
                buttonPlusUpdateItems,
                buttonMinusUpdateItems
            );
            $("#visibilityUpdateItems").addClass("d-none");
            buttonUpdateItems.forEach((b) => {
                b.addClass("d-none");
                b.prop("disabled", true);
            });
        });
        // Delete space in update brand input
        $("#brandUpdateItems").on("keyup", function () {
            $(this).val($(this).val().trim());
        });
        // Button plus function
        buttonPlusUpdateItems.on("click", function () {
            let countUpdateItems =
                $("input[name^=memoryUpdateItems]").length + 1;
            btnPlus(
                buttonPlusUpdateItems,
                purchasePriceContainerUpdateItems,
                buttonMinusUpdateItems,
                nameUpdateItems,
                countUpdateItems
            );
            countUpdateItems++;
        });
        // Button minus function
        buttonMinusUpdateItems.on("click", function () {
            countUpdateItems = $("input[name^=memoryUpdateItems]").length;
            $(`#memory${nameUpdateItems}${countUpdateItems}`).remove();
            $(`#purchasePrice${nameUpdateItems}${countUpdateItems}`).remove();
            $(`#sellingPrice${nameUpdateItems}${countUpdateItems}`).remove();

            if (countUpdateItems <= 2) {
                buttonMinusUpdateItems.addClass("d-none");
                buttonMinusUpdateItems.prop("disabled", true);
            }

            if (countUpdateItems <= 5) {
                buttonPlusUpdateItems.removeClass("d-none");
                buttonPlusUpdateItems.prop("disabled", false);
            }
        });
        // Update items auto complete
        $("#searchUpdateItems").typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1,
            },
            {
                source: dataItems,
            }
        );
        // get Data form Asyn
        $("#searchUpdateItems").on("keyup", function () {
            $.ajax({
                url: "../controllers/ajax/check_data_items.php",
                method: "post",
                data: { keyword: $(this).val() },
            }).done(function (data) {
                $("#visibilityUpdateItems").addClass("d-none");
                buttonUpdateItems.forEach((b) => {
                    b.addClass("d-none");
                    b.prop("disabled", true);
                });

                if (data) {
                    $("#visibilityUpdateItems").removeClass("d-none");
                    buttonUpdateItems.forEach((b) => {
                        b.removeClass("d-none");
                        b.prop("disabled", false);
                    });

                    let obj = JSON.parse(data);

                    // Reset input
                    modalUpdateItems
                        .find("#visibilityUpdateItems input")
                        .val("");

                    let count = modalUpdateItems.find("input").length;

                    if (count !== 9) {
                        const memory = modalUpdateItems.find(
                            `input[name^=memoryUpdateItems]`
                        );
                        const purchasePrice = modalUpdateItems.find(
                            `input[name^=purchasePriceUpdateItems]`
                        );
                        const sellingPrice = modalUpdateItems.find(
                            `input[name^=sellingPriceUpdateItems]`
                        );

                        for (
                            let i = $(
                                ".update-items-modal input[name^=memoryUpdateItems]"
                            ).length;
                            i > 1;
                            i--
                        ) {
                            memory[i - 1].remove();
                            purchasePrice[i - 1].remove();
                            sellingPrice[i - 1].remove();
                        }
                        buttonPlusUpdateItems.removeClass("d-none");
                        buttonPlusUpdateItems.prop("disabled", false);
                        buttonMinusUpdateItems.addClass("d-none");
                        buttonMinusUpdateItems.prop("disabled", true);
                    }

                    //Set data id, brand, type, color
                    $("#typeIdUpdateItems").val(obj.id);
                    $("#brandUpdateItems").val(obj.brand);
                    $("#typeUpdateItems").val(obj.type);
                    $("#colorUpdateItems").val(obj.color);

                    // Set data memori, price
                    modalUpdateItems
                        .find("#memoryUpdateItems1")
                        .val(obj.memoryPrice[0].memory);
                    modalUpdateItems
                        .find("#purchasePriceUpdateItems1")
                        .val(rupiah(obj.memoryPrice[0].purchase_price, "Rp. "));
                    modalUpdateItems
                        .find("#sellingPriceUpdateItems1")
                        .val(rupiah(obj.memoryPrice[0].selling_price, "Rp. "));

                    for (let i = 1; i < obj.memoryPrice.length; i++) {
                        btnPlus(
                            buttonPlusUpdateItems,
                            purchasePriceContainerUpdateItems,
                            buttonMinusUpdateItems,
                            nameUpdateItems,
                            i + 1
                        );
                        modalUpdateItems
                            .find(`input[name=memoryUpdateItems${i + 1}]`)
                            .val(obj.memoryPrice[i].memory);
                        modalUpdateItems
                            .find(
                                `input[name=purchasePriceUpdateItems${i + 1}]`
                            )
                            .val(
                                rupiah(
                                    obj.memoryPrice[i].purchase_price,
                                    "Rp. "
                                )
                            );
                        modalUpdateItems
                            .find(`input[name=sellingPriceUpdateItems${i + 1}]`)
                            .val(
                                rupiah(obj.memoryPrice[i].selling_price, "Rp. ")
                            );
                    }
                }
            });
        });
        // Delete item
        const buttonDeleteUpdateItems = $(".button-delete-update-items");
        buttonDeleteUpdateItems.on("click", function () {
            let id = $("#typeIdUpdateItems").val();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "../controllers/ajax/delete_items.php",
                        type: "POST",
                        data: { id: id },
                        typeData: "json",
                    }).done(function (data) {
                        let flashData;
                        let link =
                            "http://localhost/kasir.v2/views/admin.php?menu=stock";
                        if (data > 0) {
                            flashData =
                                "success-Successfull!-The items was delete successfully";
                        } else {
                            flashData =
                                "error-Unsuccessfull!-The items was not delected successfully.";
                        }
                        flashAlert(flashData, link);
                    });
                }
            });
        });
        // Search stock
        $("#searchStock").on("keyup", function () {
            $.ajax({
                url: "../controllers/ajax/search_stock.php",
                data: { keyword: $(this).val() },
                type: "get",
            }).done(function (data) {
                $("#tbodyStock").html(data);
            });
        });
        // print to pdf stock
        $("#printStock").on("click", function () {
            window.open("../controllers/Print_Stock.php", "_blank");
        });
    });

    // View input Stock
    $(".input-stock").ready(function () {
        // Flash Data
        let flashData = $(".flash-data-input-stock").data("flashdata");
        let link = $(".flash-data-input-stock").data("link");
        flashAlert(flashData, link);
        // Search Input stok autocomplete
        $("#searchItemsInputStock").typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1,
            },
            {
                source: dataItems,
            }
        );
        // get Data form Asyn
        $("#searchItemsInputStock").on("keyup", function () {
            $.ajax({
                url: "../controllers/ajax/check_data_items.php",
                method: "post",
                data: { keyword: $(this).val() },
            }).done(function (data) {
                if (data) {
                    // Reset input
                    resetInputStock();
                    $("#visibilityInputStock").removeClass("d-none");

                    let obj = JSON.parse(data);

                    //Set brand, type
                    $("#brandInputStock").val(obj.brand);
                    $("#typeInputStock").val(obj.type);

                    // set data colors
                    let colors = obj.color.split(", ");
                    for (let i = 0; i < colors.length; i++) {
                        $("#colorInputStock").append(optionInput(colors[i]));
                    }

                    // set data memory
                    for (let i = 0; i < obj.memoryPrice.length; i++) {
                        $("#memoryInputStock").append(
                            optionInput(
                                obj.memoryPrice[i].id,
                                obj.memoryPrice[i].memory
                            )
                        );
                    }
                }
            });
        });
        // Set data price
        $("#memoryInputStock").on("change", function () {
            if ($(this).val()) {
                $.ajax({
                    url: "../controllers/ajax/check_data_items_price.php",
                    method: "post",
                    data: {
                        memoryId: $(this).val(),
                    },
                    dataType: "json",
                }).done(function (data) {
                    $("#purchasePriceInputStock").val(
                        rupiah(data.purchase_price, "Rp. ")
                    );
                    $("#sellingPriceInputStock").val(
                        rupiah(data.selling_price, "Rp. ")
                    );
                });
            } else {
                $("#purchasePriceInputStock").val("");
                $("#sellingPriceInputStock").val("");
            }
        });
        // button clear input stock
        $(".clear-input-stock").on("click", function () {
            resetInputStock();
            $("#searchItemsInputStock").val("");
            $("#searchItemsInputStock").focus();
        });
        // data input input Stock
        let inputInputStock = [
            $("#brandInputStock"),
            $("#typeInputStock"),
            $("#colorInputStock"),
            $("#memoryInputStock"),
            $("#purchasePriceInputStock"),
            $("#sellingPriceInputStock"),
            $("#qtyInputStock"),
        ];
        // color select vaidation
        $("#colorInputStock").on("change", function () {
            if ($(this).val()) {
                $(this).removeClass("is-invalid");
            } else {
                $(this).addClass("is-invalid");
            }
        });
        // memory select validaton
        $("#memoryInputStock").on("change", function () {
            if ($(this).val()) {
                $(this).removeClass("is-invalid");
                $("#purchasePriceInputStock").removeClass("is-invalid");
                $("#sellingPriceInputStock").removeClass("is-invalid");
            } else {
                $(this).addClass("is-invalid");
            }
        });
        // qty input
        $("#qtyInputStock").on("keyup", function () {
            if ($(this).val()) {
                $(this).removeClass("is-invalid");
            } else {
                $(this).addClass("is-invalid");
            }
        });
        // button submit input stock
        $(".submit-input-stock").on("click", function () {
            if (
                $("#brandInputStock").val() &&
                $("#typeInputStock").val() &&
                $("#colorInputStock").val() &&
                $("#memoryInputStock").val() &&
                $("#purchasePriceInputStock").val() &&
                $("#sellingPriceInputStock").val() &&
                $("#qtyInputStock").val()
            ) {
                $("#submitInputStock").prop("disabled", false);

                let data = [
                    $("#brandInputStock").val(),
                    $("#typeInputStock").val(),
                    $("#colorInputStock").val(),
                    $(
                        `#memoryInputStock option[value=${$(
                            "#memoryInputStock"
                        ).val()}]`
                    ).text(),
                    $("#purchasePriceInputStock").val(),
                    $("#sellingPriceInputStock").val(),
                ];

                for (let i = 0; i < $("#qtyInputStock").val(); i++) {
                    dataResultInputStock.push(data);
                }

                showResultInputStock(dataResultInputStock);
                $("#visibilityResultInputStock").removeClass("d-none");
                $("#qtyInputStock").val("");
            } else {
                inputInputStock.forEach((data) => {
                    if (!data.val()) {
                        data.addClass("is-invalid");
                    } else {
                        data.removeClass("is-invalid");
                    }
                });
            }
        });
        // Button clear data
        $(".button-clear-data-input-stock").on("click", function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    dataResultInputStock = [];
                    showResultInputStock(dataResultInputStock);
                    $("#visibilityResultInputStock").addClass("d-none");
                    $("#submitInputStock").prop("disabled", true);
                }
            });
        });
    });

    // View cashier
    $(".cashier").ready(function () {
        // Flash Data
        let flashData = $(".flash-data-cashier").data("flashdata");
        let link = $(".flash-data-cashier").data("link");
        flashAlert(flashData, link);
        // Cashier auto complete
        $("#searchCashier").typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1,
            },
            {
                source: dataStocks,
            }
        );
        // data input Cashier
        let inputInputCashier = [
            $("#brandCashier"),
            $("#typeCashier"),
            $("#colorCashier"),
            $("#memoryCashier"),
            $("#sellingPriceCashier"),
            $("#qtyCashier"),
        ];
        // get data brand type and color form async
        $("#searchCashier").on("keyup", function () {
            $.ajax({
                url: "../controllers/ajax/check_data_stock_color.php",
                method: "post",
                data: { keyword: $(this).val() },
            }).done(function (data) {
                if (data) {
                    // Reset input
                    resetCashier();
                    $("#visibilityCashier").removeClass("d-none");

                    obj = JSON.parse(data);

                    $("#brandCashier").val(obj.brand);
                    $("#typeCashier").val(obj.type);

                    for (let i = 0; i < obj.colors.length; i++) {
                        $("#colorCashier").append(optionInput(obj.colors[i]));
                    }
                }
            });
        });
        // get data memory from async
        $("#colorCashier").on("change", function () {
            if ($(this).val()) {
                $(this).removeClass("is-invalid");
                let brandType =
                    $("#brandCashier").val() + " " + $("#typeCashier").val();
                $.ajax({
                    url:
                        "../controllers/ajax/check_data_stock_color_memory.php",
                    method: "post",
                    data: {
                        brandType: brandType,
                        color: $(this).val(),
                    },
                }).done(function (data) {
                    if (data) {
                        // reset option memory
                        $(
                            "#visibilityCashier #memoryCashier option[value!='']"
                        ).remove();
                        $("#sellingPriceCashier").val("");
                        $("#qtyCashier").val("");
                        $("#qtyCashier").prop("disabled", true);
                        $("#qtyCashier").prop("placeholder", "");

                        let memory = JSON.parse(data);

                        for (let i = 0; i < memory.length; i++) {
                            $("#memoryCashier").append(optionInput(memory[i]));
                        }
                    }
                });
            } else {
                $(
                    "#visibilityCashier #memoryCashier option[value!='']"
                ).remove();
                $("#sellingPriceCashier").val("");
                $("#qtyCashier").val("");
                $("#qtyCashier").prop("disabled", true);
                $("#qtyCashier").prop("placeholder", "");
                $("#memoryCashier").removeClass("is-invalid");
                $("#sellingPriceCashier").removeClass("is-invalid");
                $("#qtyCashier").removeClass("is-invalid");
            }
        });
        // get data price from async
        $("#memoryCashier").on("change", function () {
            if ($(this).val()) {
                $(this).removeClass("is-invalid");
                $("#sellingPriceCashier").removeClass("is-invalid");
                $("#qtyCashier").removeClass("is-invalid");

                let brandType =
                    $("#brandCashier").val() + " " + $("#typeCashier").val();
                $.ajax({
                    url:
                        "../controllers/ajax/check_data_stock_color_memory_price.php",
                    method: "post",
                    data: {
                        brandType: brandType,
                        color: $("#colorCashier").val(),
                        memory: $(this).val(),
                    },
                }).done(function (data) {
                    if (data) {
                        let obj = JSON.parse(data);

                        $("#qtyCashier").prop("disabled", false);

                        $("#sellingPriceCashier").val(
                            rupiah(obj.selling_price, "Rp. ")
                        );

                        $("#qtyCashier").prop("max", obj.stock);
                        $("#qtyCashier").prop(
                            "placeholder",
                            "Max " + obj.stock
                        );
                    }
                });
            } else {
                $("#sellingPriceCashier").val("");
                $("#qtyCashier").val("");
                $("#qtyCashier").prop("disabled", true);
                $("#qtyCashier").prop("placeholder", "");
            }
        });
        // qtyCashier event
        $("#qtyCashier").on("keyup", function () {
            $(this).removeClass("is-invalid");
            if ($(this).val()) {
                $(this).val(minMax($(this).val(), $(this).attr("max")));
            }
        });
        // button submit cashier event
        $(".button-submit-cashier").on("click", function () {
            if (
                $("#brandCashier").val() &&
                $("#typeCashier").val() &&
                $("#colorCashier").val() &&
                $("#memoryCashier").val() &&
                $("#sellingPriceCashier").val() &&
                $("#qtyCashier").val()
            ) {
                let data = [
                    $("#brandCashier").val(),
                    $("#typeCashier").val(),
                    $("#colorCashier").val(),
                    $("#memoryCashier").val(),
                    $("#sellingPriceCashier").val(),
                    $("#qtyCashier").attr("max"),
                    $("#qtyCashier").val(),
                ];

                // insert data result cashier
                if (dataResultCashier.length > 0) {
                    let is_same = false;
                    for (let i = 0; i < dataResultCashier.length; i++) {
                        let brand = dataResultCashier[i][0];
                        let type = dataResultCashier[i][1];
                        let color = dataResultCashier[i][2];
                        let memory = dataResultCashier[i][3];
                        let sellingPrice = dataResultCashier[i][4];
                        let stock = dataResultCashier[i][5];

                        if (
                            $("#brandCashier").val() === brand &&
                            $("#typeCashier").val() === type &&
                            $("#colorCashier").val() === color &&
                            $("#memoryCashier").val() === memory &&
                            $("#sellingPriceCashier").val() === sellingPrice &&
                            $("#qtyCashier").attr("max") === stock
                        ) {
                            dataResultCashier[i][6] = $("#qtyCashier").val();
                            is_same = true;
                            i = i + dataResultCashier.length;
                        }
                    }
                    if (!is_same) {
                        dataResultCashier.push(data);
                    }
                } else {
                    dataResultCashier.push(data);
                }

                $("#visibilityResultCashier").removeClass("d-none");
                showResultCashier(dataResultCashier);
                $("#submitCashier").prop("disabled", false);
                $("#qtyCashier").val("");
            } else {
                inputInputCashier.forEach((data) => {
                    if (!data.val()) {
                        data.addClass("is-invalid");
                    } else {
                        data.removeClass("is-invalid");
                    }
                });
            }
        });
        // Button clear input Casher
        $(".button-clear-cashier").on("click", function () {
            resetCashier();
            $("#searchCashier").val("");
            $("#searchCashier").focus();
        });
        // button clear all result
        $(".button-clear-all-result-cashier").on("click", function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    dataResultCashier = [];
                    showResultCashier(dataResultCashier);
                    $("#visibilityResultCashier").addClass("d-none");
                    $("#submitCashier").prop("disabled", true);
                }
            });
        });
    });

    // view report
    $(".report").ready(function () {
        const reportButton = [$("#thisDay"), $("#thisMonth"), $("#thisYear")];
        const dateInput = [$("#firstDate"), $("#endDate")];
        // first reload set data
        if ($("#thisDay").hasClass("active")) {
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisDay",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        } else if ($("#thisMonth").hasClass("active")) {
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisMonth",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        } else if ($("#thisYear").hasClass("active")) {
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisYear",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        }
        // this Day Button
        $("#thisDay").on("click", function () {
            reportButton.forEach((btn) => btn.removeClass("active"));
            dateInput.forEach((e) => e.val(""));
            $(this).addClass("active");
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisDay",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        });
        // this Month Button
        $("#thisMonth").on("click", function () {
            reportButton.forEach((btn) => btn.removeClass("active"));
            dateInput.forEach((e) => e.val(""));
            $(this).addClass("active");
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisMonth",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        });
        // this Year Button
        $("#thisYear").on("click", function () {
            reportButton.forEach((btn) => btn.removeClass("active"));
            dateInput.forEach((e) => e.val(""));
            $(this).addClass("active");
            $.get(
                "../controllers/ajax/result_report.php?selectedReport=" +
                    $("#selectReport").val() +
                    "&button=thisYear",
                function (data) {
                    $("#resultReport").html(data);
                }
            );
        });
        // selected event
        $("#selectReport").on("change", function () {
            let button;
            let firstDate;
            let endDate;
            if ($("#thisDay").hasClass("active")) {
                button = "thisDay";
            } else if ($("#thisMonth").hasClass("active")) {
                button = "thisMonth";
            } else if ($("#thisYear").hasClass("active")) {
                button = "thisYear";
            } else if (
                $("#firstDate").val().length === 10 &&
                $("#endDate").val().length === 10
            ) {
                firstDate = $("#firstDate").val();
                endDate = $("#endDate").val();
            } else if (
                $("#firstDate").val().length === 10 &&
                !$("#endDate").val()
            ) {
                firstDate = $("#firstDate").val();
                console.log(firstDate);
            }

            if (button) {
                $.get(
                    "../controllers/ajax/result_report.php?selectedReport=" +
                        $(this).val() +
                        "&button=" +
                        button,
                    function (data) {
                        $("#resultReport").html(data);
                    }
                );
            } else if (firstDate && endDate) {
                $.get(
                    "../controllers/ajax/result_report.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&firstDate=" +
                        firstDate +
                        "&endDate=" +
                        endDate,
                    function (data) {
                        reportButton.forEach((btn) =>
                            btn.removeClass("active")
                        );
                        $("#resultReport").html(data);
                    }
                );
            } else {
                $.get(
                    "../controllers/ajax/result_report.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&firstDate=" +
                        firstDate,
                    function (data) {
                        reportButton.forEach((btn) =>
                            btn.removeClass("active")
                        );
                        $("#resultReport").html(data);
                    }
                );
            }
        });
        // Datepicker default dateformat
        $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        // first Date
        $("#firstDate").datepicker({
            clearBtn: true,
            todayHighlight: true,
        });
        // end date
        $("#endDate").datepicker({
            clearBtn: true,
            todayHighlight: true,
        });
        // firstDate event
        $("#firstDate").on("change", function () {
            if ($(this).val().length === 10) {
                if ($("#endDate").val().length === 10) {
                    $.get(
                        "../controllers/ajax/result_report.php?selectedReport=" +
                            $("#selectReport").val() +
                            "&firstDate=" +
                            $(this).val() +
                            "&endDate=" +
                            $("#endDate").val(),
                        function (data) {
                            reportButton.forEach((btn) =>
                                btn.removeClass("active")
                            );
                            $("#resultReport").html(data);
                        }
                    );
                } else {
                    $.get(
                        "../controllers/ajax/result_report.php?selectedReport=" +
                            $("#selectReport").val() +
                            "&firstDate=" +
                            $(this).val(),
                        function (data) {
                            reportButton.forEach((btn) =>
                                btn.removeClass("active")
                            );
                            $("#resultReport").html(data);
                        }
                    );
                }
            }
        });
        // endDate event
        $("#endDate").on("change", function () {
            if (
                $(this).val().length === 10 &&
                $("#firstDate").val().length === 10
            ) {
                $.get(
                    "../controllers/ajax/result_report.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&firstDate=" +
                        $("#firstDate").val() +
                        "&endDate=" +
                        $(this).val(),
                    function (data) {
                        reportButton.forEach((btn) =>
                            btn.removeClass("active")
                        );
                        $("#resultReport").html(data);
                    }
                );
            }
        });
        // print to PDF button
        $("#printInputOutputStock").on("click", function () {
            let tab;
            if ($("#thisDay").hasClass("active")) {
                button = "thisDay";
            } else if ($("#thisMonth").hasClass("active")) {
                button = "thisMonth";
            } else if ($("#thisYear").hasClass("active")) {
                button = "thisYear";
            } else if (
                $("#firstDate").val().length === 10 &&
                $("#endDate").val().length === 10
            ) {
                firstDate = $("#firstDate").val();
                endDate = $("#endDate").val();
            } else if (
                $("#firstDate").val().length === 10 &&
                !$("#endDate").val()
            ) {
                firstDate = $("#firstDate").val();
                console.log(firstDate);
            }

            if (button) {
                tab = window.open(
                    "../controllers/Print_Input_Output_Stock.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&button=" +
                        button,
                    "_blank"
                );
            } else if (firstDate && endDate) {
                tab = window.open(
                    "../controllers/Print_Input_Output_Stock.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&firstDate=" +
                        firstDate +
                        "&endDate=" +
                        endDate,
                    "_blank"
                );
            } else {
                tab = window.open(
                    "../controllers/Print_Input_Output_Stock.php?selectedReport=" +
                        $("#selectReport").val() +
                        "&firstDate=" +
                        firstDate,
                    "_blank"
                );
            }
            tab.focus();
        });
    });
});
