document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.querySelector("form[action*='registracia']");
    
    if (registerForm) {
        const hesloInput = registerForm.querySelector("input[name='heslo']");
        const submitBtn = registerForm.querySelector("button[type='submit']");
        
        const errorMsg = document.createElement("small");
        errorMsg.style.color = "#ff4a4a";
        errorMsg.style.display = "none";
        errorMsg.style.marginTop = "-5px";
        errorMsg.textContent = "Heslo musí mať aspoň 6 znakov.";
        hesloInput.parentNode.insertBefore(errorMsg, hesloInput.nextSibling);

        hesloInput.addEventListener("input", () => {
            if (hesloInput.value.length < 6) {
                errorMsg.style.display = "block";
                submitBtn.disabled = true;
                submitBtn.style.opacity = "0.5";
            } else {
                errorMsg.style.display = "none";
                submitBtn.disabled = false;
                submitBtn.style.opacity = "1";
            }
        });
    }
});