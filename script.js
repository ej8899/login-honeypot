function showPasswordStep() {
    const email = document.getElementById('username').value;
    if (email) {
        document.getElementById('emailStep').style.display = 'none';
        document.getElementById('passwordStep').style.display = 'block';
    }
}

function submitForm() {
    fetch('https://api64.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById('ipAddress').value = data.ip;
            document.getElementById('loginForm').submit();
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
            // Optionally, handle the error (e.g., display a message to the user)
        });
}
