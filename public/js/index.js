$('#logout').click(function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        $('#logout-form').submit();
    }
});
