
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('file-input').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-image').style.display = 'block';
            document.getElementById('upload-btn').style.display = 'none';
        }
        reader.readAsDataURL(file);
    });
});
