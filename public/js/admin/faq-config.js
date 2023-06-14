var editFaqs = document.querySelectorAll(".open_edit_faq_modal");
for (var i = 0; i < editFaqs.length; i++) {
    editFaqs[i].addEventListener("click", function () {
        console.log("this is clicked");
        var faq_id = $(this).data("faq-edit-id");
        console.log(faq_id);
        $("#editFaqsModal").modal("show");
        $("#faq-id").val(faq_id);

        fetch("/faq/" + faq_id)
            .then((response) => response.json())
            .then((data) => {
                $("#editQuestion").val(data.faqs_title);
                $("#editAnswer").text(data.faqs_subtext);
            });
    });
}

var deleteFaqs = document.querySelectorAll(".open_delete_faq_modal");
for (var i = 0; i < deleteFaqs.length; i++) {
    deleteFaqs[i].addEventListener("click", function () {
        var faq_id = $(this).data("faq-delete-id");
        var faq_name = $(this).data("faq-delete-name");
        console.log(faq_id);
        console.log(faq_name);
        $("#deleteFaqsModal").modal("show");
        $("#deleteFaqsModal #faq-id_delete").val(faq_id);
        $("#deleteFaqsModal #faqName").text(faq_name);
    });
}
