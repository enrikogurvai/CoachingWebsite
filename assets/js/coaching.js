document.addEventListener("DOMContentLoaded", () => {
    const redirectButtons = document.querySelectorAll(".coach-redirect-btn");
    
    redirectButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            const coachSlug = event.currentTarget.getAttribute("data-slug");
            
            if (coachSlug) {
                window.location.href = `index.php?page=rezervacie&trener=${coachSlug}`;
            }
        });
    });
});