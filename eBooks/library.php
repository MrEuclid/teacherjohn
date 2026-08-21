<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-books Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Modern Circular/Pill Chip Styling */
        .chip-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .chip-group input[type="radio"] {
            display: none;
        }
        
        .chip-group label {
            display: inline-block;
            padding: 8px 20px;
            background-color: #f1f3f4;
            color: #3c4043;
            border: 2px solid transparent;
            border-radius: 50px; /* This creates the circular/pill shape */
            font-family: system-ui, -apple-system, sans-serif;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }
        
        .chip-group label:hover {
            background-color: #e8eaed;
        }
        
        .chip-group input[type="radio"]:checked + label {
            background-color: #e8f0fe;
            color: #1a73e8;
            border: 2px solid #1a73e8;
        }

        /* Filter Section Titles */
        .filter-title {
            text-align: center;
            font-weight: bold;
            color: #5f6368;
            margin-bottom: 10px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Restored Book Button Styling */
        .book {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            margin-bottom: 1em;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            transition: transform 0.2s;
        }
        
        .book:hover {
            transform: scale(1.05);
            color: white;
        }

      

        .book img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
    object-fit: contain;
    display: block;      /* Add this */
    max-width: 100%;     /* Add this */
}
    </style>
</head>
<body>

<div class="container-fluid mb-5">
    
    <!-- Header -->
    <div class="row mt-4 mb-4">
        <div class="col-12 text-center">
            <h2>
                <a href="index.php" class="btn btn-success me-3">Home</a>
                Teacher John eBooks
            </h2>
        </div>
    </div>

    <!-- Dynamic Filters Container -->
    <div class="row mb-4 bg-light p-4 rounded shadow-sm mx-2">
        <div class="col-md-4">
            <div class="filter-title">Topic</div>
            <div id="topic-filters" class="chip-group"></div>
        </div>
        <div class="col-md-4">
            <div class="filter-title">Language</div>
            <div id="lang-filters" class="chip-group"></div>
        </div>
        <div class="col-md-4">
            <div class="filter-title">Level</div>
            <div id="level-filters" class="chip-group"></div>
        </div>
    </div>

    <!-- Books Grid Container -->
    <div id="book-grid" class="row px-3">
        <div class="text-center mt-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p>Loading library...</p>
        </div>
    </div>

</div>
<script>
    let allBooks = [];
    
    // An array of button colors to randomly assign to books for a vibrant look
    const btnColors = ['btn-info', 'btn-danger', 'btn-success', 'btn-warning', 'btn-primary'];

    document.addEventListener('DOMContentLoaded', () => {
        fetch('ajax/getBooks.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('book-grid').innerHTML = `<div class="alert alert-danger text-center">${data.error}</div>`;
                    return;
                }
                allBooks = data;
                buildFilters();
                renderBooks();
            })
            .catch(err => {
                console.error("Error fetching books:", err);
                document.getElementById('book-grid').innerHTML = `<div class="alert alert-danger text-center">Failed to load books.</div>`;
            });
    });

    // Automatically generate filter chips, supporting comma-separated topics
    function buildFilters() {
        const topics = new Set(['All']);
        const languages = new Set(['All']);
        const levels = new Set(['All']);

        allBooks.forEach(book => {
            // Split comma-separated topics and add them individually
            if (book.topic) {
                const topicList = book.topic.split(',').map(t => t.trim());
                topicList.forEach(t => {
                    if (t) topics.add(t);
                });
            }
            if (book.language) languages.add(book.language.trim());
            if (book.level) levels.add(book.level.trim());
        });

        createChipGroup('topic-filters', 'topic', Array.from(topics));
        createChipGroup('lang-filters', 'language', Array.from(languages));
        createChipGroup('level-filters', 'level', Array.from(levels));
    }

    function createChipGroup(containerId, groupName, items) {
        const container = document.getElementById(containerId);
        let html = '';
        
        items.sort().forEach((item, index) => {
            const id = `filter_${groupName}_${index}`;
            const checked = item === 'All' ? 'checked' : '';
            html += `
                <input type="radio" id="${id}" name="${groupName}" value="${item}" ${checked} onchange="renderBooks()">
                <label for="${id}">${item}</label>
            `;
        });
        
        container.innerHTML = html;
    }

    // Filter and display the books, checking inside comma-separated strings
    function renderBooks() {
        const selectedTopic = document.querySelector('input[name="topic"]:checked')?.value || 'All';
        const selectedLang = document.querySelector('input[name="language"]:checked')?.value || 'All';
        const selectedLevel = document.querySelector('input[name="level"]:checked')?.value || 'All';

        const filteredBooks = allBooks.filter(book => {
            // Check if the selected topic is included in the book's comma-separated topic list
            let matchTopic = false;
            if (selectedTopic === 'All') {
                matchTopic = true;
            } else if (book.topic) {
                const topicList = book.topic.split(',').map(t => t.trim());
                matchTopic = topicList.includes(selectedTopic);
            }

            const matchLang = (selectedLang === 'All' || book.language === selectedLang);
            const matchLevel = (selectedLevel === 'All' || book.level === selectedLevel);
            
            return matchTopic && matchLang && matchLevel;
        });

        const grid = document.getElementById('book-grid');
        
        if (filteredBooks.length === 0) {
            grid.innerHTML = `<div class="col-12 text-center mt-5 text-muted"><h4>No books found matching these filters.</h4></div>`;
            return;
        }

        let html = '';
        filteredBooks.forEach((book, index) => {
            // Pick a color based on the index
            const colorClass = btnColors[index % btnColors.length]; 
            
            html += `
                <div class="col-6 col-md-4 col-lg-3 text-center mb-3">
                    <a href="${book.url}" target="_blank" class="book btn ${colorClass} shadow-sm">
                        <img src="${book.image_path}" alt="${book.title} icon">
                        <span>${book.title}</span>
                    </a>
                </div>
            `;
        });

        grid.innerHTML = html;
    }
</script>
</body>
</html>