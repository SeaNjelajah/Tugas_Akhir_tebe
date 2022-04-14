$('input[set=preview]').change(function(e) {
    target = document.querySelector(e.target.getAttribute('to'));
    target.src = URL.createObjectURL(e.target.files[0]);
});