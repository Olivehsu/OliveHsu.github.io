
//check the priority and redirect to the page
function redirectToTaskPage(priority) {
    if (priority === "Not Urgent & Not Important") {
        const userConfirmed = confirm("This task is neither urgent nor important. Are you sure you want to add it?");
        if (!userConfirmed) {
            return; 
        }
    }
    window.location.href = `../server/add_task.php?priority=${encodeURIComponent(priority)}`;
}