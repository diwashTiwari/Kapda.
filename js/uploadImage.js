document.addEventListener("DOMContentLoaded", function () {
  const input = document.querySelector(".image-upload-input");
  const preview = document.querySelector(".image-preview");

  input.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  });
});
