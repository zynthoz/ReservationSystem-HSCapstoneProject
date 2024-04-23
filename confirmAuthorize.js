function confirmUpdate(message, id, type) {
    event.preventDefault(); // Prevent the form from submitting initially
    var popup = document.createElement("div");
    popup.className = "popup";
    var content = document.createElement("div");
    content.className = "popup-content show";
    content.innerHTML = `<a href="">${message}</a>`;
    popup.appendChild(content);
    document.body.appendChild(popup);

    // Add event listener for the popup link
    content.addEventListener("click", function() {
        document.body.removeChild(popup); // Remove the popup
        if (type === "accept") {
            window.location.href = `?accept=${id}`;
        } else if (type === "reject") {
            window.location.href = `?reject=${id}`;
        }
    });
}