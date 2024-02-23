<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
    <base href="http://localhost/Project/TEST_3/" />
    <link rel="stylesheet" href="../TEST_3/public/css/verifyEmail.css" />
</head>

<body>
    <div class="container">
        <h4>Enter OTP Code</h4>
        <form method="post">
            <div class="input-field">
                <input type="number" name="digit1" />
                <input type="number" name="digit2" disabled />
                <input type="number" name="digit3" disabled />
                <input type="number" name="digit4" disabled />
                <input type="number" name="digit5" disabled />
                <input type="number" name="digit6" disabled />
            </div>
            <button type="submit" name="btnVerify">Verify OTP</button>
        </form>
    </div>
</body>

</html>

<script>
    const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");

    // iterate over all inputs
    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            // This code gets the current input element and stores it in the currentInput variable
            // This code gets the next sibling element of the current input element and stores it in the nextInput variable
            // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
            const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

            // if the value has more than one character then clear it
            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }
            // if the next input is disabled and the current value is not empty
            //  enable the next input and focus on it
            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            // if the backspace key is pressed
            if (e.key === "Backspace") {
                // iterate over all inputs again
                inputs.forEach((input, index2) => {
                    // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
                    // and the previous element exists, set the disabled attribute on the input and focus on the previous element
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }
            //if the fourth input( which index number is 3) is not empty and has not disable attribute then
            //add active class if not then remove the active class.
            if (!inputs[5].disabled && inputs[5].value !== "") {
                button.classList.add("active");
                return;
            }
            button.classList.remove("active");
        });
    });

    //focus the first input which index is 0 on window load
    window.addEventListener("load", () => inputs[0].focus());
</script>