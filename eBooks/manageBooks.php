<?php
// Include your database connection
require_once '../connectTeacherJohn.php';

$message = '';

// --- Handle Form Submissions (Insert or Update) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['book_id'] ?? '';
    $title = $_POST['title'] ?? '';
    $url = $_POST['url'] ?? '';
    $image_path = $_POST['image_path'] ?? '';
    $topic = $_POST['topic'] ?? '';
    $level = $_POST['level'] ?? '';
    $language = $_POST['language'] ?? 'EN';

    if (empty($id)) {
        // No ID means it is a NEW record
        $stmt = $conn->prepare("INSERT INTO ebooks (title, url, image_path, topic, level, language) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $url, $image_path, $topic, $level, $language);
        
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>New book added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error adding book: " . $conn->error . "</div>";
        }
        $stmt->close();
    } else {
        // An ID exists, so UPDATE the existing record
        $stmt = $conn->prepare("UPDATE ebooks SET title=?, url=?, image_path=?, topic=?, level=?, language=? WHERE id=?");
        $stmt->bind_param("ssssssi", $title, $url, $image_path, $topic, $level, $language, $id);
        
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Book updated successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error updating book: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
}

// --- Fetch all existing books to populate the table below ---
$books = [];
$result = $dbServer->query("SELECT * FROM ebooks ORDER BY title ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage eBooks Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage eBooks</h2>
        <a href="library.php" class="btn btn-outline-primary">View Live Library</a>
    </div>

    <?= $message ?>

    <!-- Data Entry / Edit Form -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0" id="formTitle">Add a New Book</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="manageBooks.php">
                <!-- Hidden field to hold ID during updates -->
                <input type="hidden" id="book_id" name="book_id" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" required placeholder="e.g., Python for Beginners">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">URL (Link)</label>
                        <input type="text" id="url" name="url" class="form-control" required placeholder="e.g., https://...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image Path</label>
                        <input type="text" id="image_path" name="image_path" class="form-control" required placeholder="e.g., images/python.jpeg">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Topics (Comma-separated)</label>
                        <input type="text" id="topic" name="topic" class="form-control" placeholder="e.g., Programming, AI">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Level</label>
                        <input type="text" id="level" name="level" class="form-control" placeholder="e.g., G7, G10, All">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Language</label>
                        <select id="language" name="language" class="form-select">
                            <option value="EN">EN</option>
                            <option value="KH">KH</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success" id="saveBtn">Save Book</button>
                <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear Form / Add New</button>
            </form>
        </div>
    </div>

    <!-- Existing Books Table -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Existing Books</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Topic(s)</th>
                            <th>Level</th>
                            <th>Language</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $b): ?>
                            <tr>
                                <td class="align-middle"><?= $b['id'] ?></td>
                                <td class="align-middle"><img src="<?= htmlspecialchars($b['image_path']) ?>" alt="icon" style="width: 30px; height: 30px; object-fit: contain;"></td>
                                <td class="align-middle">
                                    <a href="<?= htmlspecialchars($b['url']) ?>" target="_blank"><?= htmlspecialchars($b['title']) ?></a>
                                </td>
                                <td class="align-middle"><?= htmlspecialchars($b['topic']) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($b['level']) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($b['language']) ?></td>
                                <td class="align-middle">
                                    <!-- Pass the JSON-encoded book data directly into the JavaScript function -->
                                    <button onclick='loadEdit(<?= json_encode($b) ?>)' class="btn btn-sm btn-info text-white">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Loads book data into the form when an "Edit" button is clicked
    function loadEdit(book) {
        document.getElementById('formTitle').innerText = "Edit Book: " + book.title;
        document.getElementById('formTitle').parentElement.classList.replace('bg-primary', 'bg-warning');
        document.getElementById('formTitle').parentElement.classList.replace('text-white', 'text-dark');
        
        document.getElementById('book_id').value = book.id;
        document.getElementById('title').value = book.title;
        document.getElementById('url').value = book.url;
        document.getElementById('image_path').value = book.image_path;
        document.getElementById('topic').value = book.topic;
        document.getElementById('level').value = book.level;
        document.getElementById('language').value = book.language;
        
        document.getElementById('saveBtn').innerText = "Update Book";
        document.getElementById('saveBtn').classList.replace('btn-success', 'btn-warning');
        
        // Scroll smoothly to the form
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Clears the form to prepare for a new insertion
    function clearForm() {
        document.getElementById('formTitle').innerText = "Add a New Book";
        document.getElementById('formTitle').parentElement.classList.replace('bg-warning', 'bg-primary');
        document.getElementById('formTitle').parentElement.classList.replace('text-dark', 'text-white');
        
        document.getElementById('book_id').value = '';
        document.getElementById('title').value = '';
        document.getElementById('url').value = '';
        document.getElementById('image_path').value = '';
        document.getElementById('topic').value = '';
        document.getElementById('level').value = '';
        document.getElementById('language').value = 'EN';
        
        document.getElementById('saveBtn').innerText = "Save Book";
        document.getElementById('saveBtn').classList.replace('btn-warning', 'btn-success');
    }
</script>

</body>
</html>