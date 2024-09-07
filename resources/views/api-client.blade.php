<!DOCTYPE html>
<html>
<head>
    <title>Issue Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Issue Tracker</h1>

    <h2>Create Issue</h2>
    <form id="create-form">
        <input type="text" id="create-title" placeholder="Title" required>
        <textarea id="create-description" placeholder="Description" required></textarea>
        <button type="submit">Create Issue</button>
    </form>

    <h2>Read Issue</h2>
    <form id="read-form">
        <input type="number" id="read-id" placeholder="Issue ID" required>
        <button type="submit">Read Issue</button>
    </form>
    <pre id="read-result"></pre>

    <h2>Update Issue</h2>
    <form id="update-form">
        <input type="number" id="update-id" placeholder="Issue ID" required>
        <input type="text" id="update-title" placeholder="Title">
        <textarea id="update-description" placeholder="Description"></textarea>
        <button type="submit">Update Issue</button>
    </form>

    <h2>Delete Issue</h2>
    <form id="delete-form">
        <input type="number" id="delete-id" placeholder="Issue ID" required>
        <button type="submit">Delete Issue</button>
    </form>

    <script>
        // Function to handle form submission and API requests
        document.getElementById('create-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const title = document.getElementById('create-title').value;
            const description = document.getElementById('create-description').value;
            axios.post('/api/issues', { title, description })
                .then(response => alert('Issue created: ' + JSON.stringify(response.data)))
                .catch(error => console.error('Error creating issue:', error));
        });

        document.getElementById('read-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('read-id').value;
            axios.get(`/api/issues/${id}`)
                .then(response => document.getElementById('read-result').textContent = JSON.stringify(response.data, null, 2))
                .catch(error => console.error('Error reading issue:', error));
        });

        document.getElementById('update-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('update-id').value;
            const title = document.getElementById('update-title').value;
            const description = document.getElementById('update-description').value;
            axios.put(`/api/issues/${id}`, { title, description })
                .then(response => alert('Issue updated: ' + JSON.stringify(response.data)))
                .catch(error => console.error('Error updating issue:', error));
        });

        document.getElementById('delete-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('delete-id').value;
            axios.delete(`/api/issues/${id}`)
                .then(response => alert('Issue deleted: ' + JSON.stringify(response.data)))
                .catch(error => console.error('Error deleting issue:', error));
        });
    </script>
</body>
</html>
