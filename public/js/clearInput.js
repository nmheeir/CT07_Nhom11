function clearInputs() {
    var inputs = document.querySelectorAll('input, textarea, select');

    inputs.forEach(function(input) {
        if (input.type === 'text' || input.type === 'textarea' || input.type === 'select-one') {
            input.value = '';
        } else if (input.type === 'checkbox' || input.type === 'radio') {
            input.checked = false;
        }
    });
}
