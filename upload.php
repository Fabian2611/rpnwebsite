<?php
$target_dir = "songs/";
// Create directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["song"]) && $_FILES["song"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["song"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an MP3
        if ($fileType != "mp3") {
            $message = "Error: Only .mp3 files are allowed.";
        } else {
            // Try to upload file
            if (move_uploaded_file($_FILES["song"]["tmp_name"], $target_file)) {
                $message = "The file ". htmlspecialchars(basename($_FILES["song"]["name"])). " has been uploaded.";
            } else {
                $message = "Error: There was an error uploading your file.";
            }
        }
    } else {
        $message = "Error: No file uploaded or upload error.";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Status</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: sans-serif; padding: 2rem; text-align: center; }
        .message { margin-bottom: 1rem; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <div class="message">
        <?php echo $message; ?>
    </div>
    <a href="upload.html">Back to upload</a>
</body>
</html>
