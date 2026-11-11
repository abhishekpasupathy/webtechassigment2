$(function () {
  $("#registrationForm").on("submit", function (event) {
    let valid = true;
    $(".field").removeClass("invalid");
    $(".error-message, .consent-error").text("");

    $("#registrationForm input[required], #registrationForm select[required], #registrationForm textarea[required]").each(function () {
      if (this.type === "checkbox" ? !this.checked : !String($(this).val() || "").trim()) {
        valid = false;
        $(this).closest(".field").addClass("invalid").find(".error-message").text("This field is required.");
        if (this.type === "checkbox") $(".consent-error").text("Please confirm that your information is accurate.");
      }
    });

    const email = $("#email").val().trim();
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      valid = false;
      $("#email").closest(".field").addClass("invalid").find(".error-message").text("Enter a valid email address.");
    }
    const phone = $("#phone").val().trim();
    if (phone && !/^\+?[0-9\s()\-]{7,20}$/.test(phone)) {
      valid = false;
      $("#phone").closest(".field").addClass("invalid").find(".error-message").text("Enter a valid phone number.");
    }

    if (!valid) {
      event.preventDefault();
      const $first = $(".field.invalid").first();
      if ($first.length) $("html, body").animate({ scrollTop: $first.offset().top - 100 }, 250);
    }
  });
});