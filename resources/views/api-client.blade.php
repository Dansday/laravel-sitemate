<!DOCTYPE html>
<html>
<head>
    <title>Issue Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #007bff;
            font-size: 1.5em;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
            color: #333;
            font-size: 1.2em;
        }
        form {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        input[type="text"], input[type="number"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }
        button:hover {
            background-color: #0056b3;
        }
        .issue {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            cursor: pointer;
        }
        .issue-content {
            display: none;
            margin-top: 10px;
        }
        .issue-actions {
            margin-top: 10px;
        }
        pre {
            background: #fff;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.2em;
            }
            h2 {
                font-size: 1.1em;
            }
            input[type="text"], input[type="number"], textarea {
                width: calc(100% - 16px);
            }
            button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 10px;
            }
            h1 {
                font-size: 1em;
            }
            h2 {
                font-size: 1em;
            }
            input[type="text"], input[type="number"], textarea {
                width: calc(100% - 12px);
            }
            button {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Issue Tracker</h1>

        <h2>Issues List</h2>
        <div id="issues-list">
            <!-- Issue items will be loaded here -->
        </div>

        <h2>Create Issue</h2>
        <form id="create-form">
            <input type="text" id="create-title" placeholder="Title" required>
            <textarea id="create-description" placeholder="Description" required></textarea>
            <button type="submit">Create Issue</button>
        </form>
    </div>

    <script>
        // Function to fetch issues and display them
        function fetchIssues() {
            axios.get('/api/issues')
                .then(response => {
                    const issues = response.data;
                    const issuesList = document.getElementById('issues-list');
                    issuesList.innerHTML = '';
                    issues.forEach(issue => {
                        const issueDiv = document.createElement('div');
                        issueDiv.className = 'issue';
                        issueDiv.innerHTML = `
                            <div class="issue-title">${issue.title}</div>
                            <div class="issue-content" id="issue-content-${issue.id}">
                                <pre>${issue.description}</pre>
                                <div class="issue-actions">
                                    <button onclick="updateIssue(${issue.id})">Update</button>
                                    <button onclick="deleteIssue(${issue.id})">Delete</button>
                                </div>
                            </div>
                        `;
                        issueDiv.addEventListener('click', function() {
                            const content = document.getElementById(`issue-content-${issue.id}`);
                            content.style.display = content.style.display === 'none' ? 'block' : 'none';
                        });
                        issuesList.appendChild(issueDiv);
                    });
                })
                .catch(error => console.error('Error fetching issues:', error));
        }

        // Function to handle creating an issue
        document.getElementById('create-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const title = document.getElementById('create-title').value;
            const description = document.getElementById('create-description').value;
            axios.post('/api/issues/create', { title, description })
                .then(response => {
                    alert('Issue created: ' + JSON.stringify(response.data));
                    fetchIssues();  // Refresh the issue list
                })
                .catch(error => console.error('Error creating issue:', error));
        });

        // Function to handle updating an issue
        function updateIssue(id) {
            const title = prompt('Enter new title:');
            const description = prompt('Enter new description:');
            if (title && description) {
                axios.put(`/api/issues/update/${id}`, { title, description })
                    .then(response => {
                        alert('Issue updated: ' + JSON.stringify(response.data));
                        fetchIssues();  // Refresh the issue list
                    })
                    .catch(error => console.error('Error updating issue:', error));
            }
        }

        // Function to handle deleting an issue
        function deleteIssue(id) {
            if (confirm('Are you sure you want to delete this issue?')) {
                axios.delete(`/api/issues/delete/${id}`)
                    .then(response => {
                        alert('Issue deleted: ' + JSON.stringify(response.data));
                        fetchIssues();  // Refresh the issue list
                    })
                    .catch(error => console.error('Error deleting issue:', error));
            }
        }

        // Fetch issues when the page loads
        fetchIssues();
    </script>
</body>
</html>
