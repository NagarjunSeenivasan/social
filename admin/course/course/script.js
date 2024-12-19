document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.querySelector(".submit-btn");

    submitBtn.addEventListener("mouseover", function () {
        submitBtn.style.transform = "translateY(-5px)";
        submitBtn.style.boxShadow = "0 5px 15px rgba(0, 0, 0, 0.2)";
    });

    submitBtn.addEventListener("mouseout", function () {
        submitBtn.style.transform = "translateY(0)";
        submitBtn.style.boxShadow = "none";
    });
});
