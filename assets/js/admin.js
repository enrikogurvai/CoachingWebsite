document.addEventListener("DOMContentLoaded", () => {
    const deleteLinks = document.querySelectorAll(".confirm-delete");
    
    deleteLinks.forEach(link => {
        link.addEventListener("click", (event) => {
            const potvrdenie = confirm("Naozaj chcete vymazať tohto trénera? Táto akcia je nevratná.");
            if (!potvrdenie) {
                event.preventDefault();
            }
        });
    });
});