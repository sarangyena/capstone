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
function computes(){
    var days = +document.getElementById('days').value;
    var rate = +document.getElementById('rate').value;
    var late = +document.getElementById('late').value;
    var salary = document.getElementById('salary');
    salary.value = rate*days+late;
    var salary = +salary.value;
    var ratePerHour = document.getElementById('rph');
    ratePerHour.value = rate/8+rate/8*0.2;
    var hours = +document.getElementById('hours').value;
    var otPay = document.getElementById('otPay');
    otPay.value = ratePerHour.value * hours;
    var otPay = +otPay.value;
    var holiday = +document.getElementById('holiday').value;
    var allowances = +document.getElementById('allowance').value;
    var philHealth = +document.getElementById('philHealth').value;
    var sss = +document.getElementById('sss').value;
    var advance = +document.getElementById('advance').value;
    var amount = document.getElementById('amount');
    amount.value = salary+otPay+holiday+allowances-philHealth-sss-advance;
}
function reloadPage() {
    location.reload(); // This line reloads the current page
}
