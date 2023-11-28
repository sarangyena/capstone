function clearForm() {
    document.getElementById("myForm").reset();
}
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
function up(input){
    input.value = input.value.toUpperCase();
}
function num(input){
    var regex = /[^0-9-]/g;
    input.value = input.value.replace(regex, '');
}
function letters(input){
    up(input);
    var regex = /[^A-Z-\s]/g;
    input.value = input.value.replace(regex, '');
}
function reloadPage() {
    location.reload(); // This line reloads the current page
}
function compute(){
    console.log('success');
}