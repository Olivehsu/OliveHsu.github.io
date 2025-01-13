
// get the url function
function getURLParameter(name) {
    const params = new URLSearchParams(window.location.search);
    return params.get(name);
}

// set the priority to the form
document.addEventListener("DOMContentLoaded", function () {
    const priority = getURLParameter("priority"); // transfer the priority
    if (priority) {
        document.getElementById("priority").value = priority; // set to the form
    }
});