$(document).ready(function() {
    // Show/hide register form
    $("#register-link").click(function() {
        $(".login-form").hide();
        $(".register-form").show();
    });

    $("#login-link").click(function() {
        $(".register-form").hide();
        $(".login-form").show();
    });

    // Logout functionality
    $("#logout-btn").click(function() {
        // Perform logout operations here
    });

    // Fetch contact list and populate table
    function fetchContacts() {
        // Perform AJAX request to fetch contacts
        $.ajax({
            url: "fetch_contacts.php", // Endpoint to fetch contacts from database
            method: "GET",
            dataType: "json",
            success: function(response) {
                // Clear existing table data
                $("#contact-list").empty();

                // Append fetched data to table
                $.each(response, function(index, contact) {
                    $("#contact-list").append(`<tr>
                        <td>${contact.id}</td>
                        <td>${contact.no_hp}</td>
                        <td>${contact.owner}</td>
                        <td>${contact.aksi}</td>
                    </tr>`);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Fetch contacts on page load
    fetchContacts();
});

function editContact(contactId) {
    window.location.href = "./edit_contact.php?id=" + contactId;
}

