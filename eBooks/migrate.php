<?php
// 1. Load the existing HTML file
$html = file_get_contents('googleBooks page.txt');

// 2. Suppress HTML5 parsing warnings and load into DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="UTF-8">' . $html); 
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// 3. Find all <a> tags that contain a <button> inside them
$links = $xpath->query("//a[descendant::button[contains(@class, 'book')]]");

echo "<h3>Generated SQL Query</h3>";
echo "<pre style='background:#f4f4f4; padding:15px; border-radius:5px;'>";
echo "INSERT INTO ebooks (title, url, image_path, topic, level, language) VALUES\n";

$values = [];

foreach ($links as $a) {
    // Extract URL
    $url = $a->getAttribute('href');
    if (empty(trim($url))) continue; // Skip empty links

    // Extract Image Path
    $imgNode = $xpath->query(".//img", $a)->item(0);
    $image_path = $imgNode ? $imgNode->getAttribute('src') : '';

    // Extract Title from the button text
    $buttonNode = $xpath->query(".//button", $a)->item(0);
    $rawText = $buttonNode ? $buttonNode->textContent : '';
    // Clean up extra spaces and newlines
    $title = trim(preg_replace('/\s+/', ' ', $rawText));

    // --- Smart Inference Logic ---
    
    // Determine Language (Look for "KH", "Khmer", or actual Khmer unicode characters)
    $language = 'EN';
    if (preg_match('/KH|Khmer/i', $title) || preg_match('/\p{Khmer}/u', $title)) {
        $language = 'KH';
    }

    // Determine Level (Look for G7, G8... G12)
    $level = 'All';
    if (preg_match('/G\s*([7-9]|1[0-2])/', $title, $matches)) {
        $level = 'G' . $matches[1];
    }

    // Determine Topic based on keywords
    $topic = 'General';
    if (preg_match('/Python|Scratch|HTML|Javascript|Code|Vibe/i', $title)) $topic = 'Programming';
    elseif (preg_match('/AI|Machine learning/i', $title)) $topic = 'AI';
    elseif (preg_match('/Cybersecurity|សន្តិសុខសាយប័រ/i', $title)) $topic = 'Cybersecurity';
    elseif (preg_match('/App|MIT|Game/i', $title)) $topic = 'App Development';
    elseif (preg_match('/Canva|Pixlr|Photo|Design/i', $title)) $topic = 'Design';
    elseif (preg_match('/Arduino|Microbit|Electronics|Sensor|អេឡិចត្រូនិច/i', $title)) $topic = 'Electronics';
    elseif (preg_match('/Drive|Email|Sheets|Stats/i', $title)) $topic = 'Office Tools';

    // Escape strings for safe SQL insertion
    $cleanTitle = addslashes($title);
    $cleanUrl = addslashes($url);
    $cleanImg = addslashes($image_path);

    $values[] = "('$cleanTitle', '$cleanUrl', '$cleanImg', '$topic', '$level', '$language')";
}

// 4. Output the final concatenated SQL string
echo implode(",\n", $values) . ";";
echo "</pre>";
?>