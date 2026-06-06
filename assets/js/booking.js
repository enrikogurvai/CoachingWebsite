document.addEventListener("DOMContentLoaded", () => {
    const selectTrener = document.getElementById("trener");
    if (!selectTrener) return;

    const urlParams = new URLSearchParams(window.location.search);
    const trenerSlug = urlParams.get('trener');

    if (trenerSlug) {
        const options = selectTrener.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].getAttribute("data-slug") === trenerSlug) {
                selectTrener.selectedIndex = i;
                break;
            }
        }
    }
});