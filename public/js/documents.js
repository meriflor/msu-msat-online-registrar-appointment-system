/*Gi via script nlng ang pgtawag sa modal para mabutngan pa ug conditions
Ang pgtawag ni sa modal specific sa documents nga part*/
var checkboxes = document.querySelectorAll("input[name=documents]");

// Get the modal element
var modal = document.getElementById("req-purposes-modal");
var torDoc = document.getElementById("Transcript");
var collegeForm = document.getElementById("college-form");

// Loop through each checkbox and add an event listener
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        if (this.checked) {
            if (this === torDoc && this.checked) {
                collegeForm.style.display = "block";
            }
            $("#req-purposes-modal").modal("show");
        } else {
            if (this === torDoc) {
                collegeForm.style.display = "none";
            }
            $("#req-purposes-modal").modal("hide");
        }
    });
});

var backButton = document.getElementById("back-btn");

// Add event listener to back button
backButton.addEventListener("click", function () {
    // Uncheck all checkboxes
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });
});

/*collegeForm na div madisplay specifically if TOR ang gicheck nga checkbox*/
var aTransferSchool = document.getElementById("ATransferSchool");
var bTransferSchool = document.getElementById("BTransferSchool");

var aTransfer = document.getElementsByName("isATransfer");
var bTransfer = document.getElementsByName("isBTransfer");

function updateATransfer() {
    if (aTransfer[0].checked && aTransfer[0].value === "yes") {
        aTransferSchool.style.display = "block";
    } else {
        aTransferSchool.style.display = "none";
    }
}
for (var i = 0; i < aTransfer.length; i++) {
    aTransfer[i].addEventListener("change", updateATransfer);
}

function updateBTransfer() {
    if (bTransfer[0].checked && bTransfer[0].value === "yes") {
        bTransferSchool.style.display = "block";
    } else {
        bTransferSchool.style.display = "none";
    }
}
for (var i = 0; i < bTransfer.length; i++) {
    bTransfer[i].addEventListener("change", updateBTransfer);
}
