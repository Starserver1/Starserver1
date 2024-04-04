<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        // Upload file to GitHub
        $githubUsername = 'alirezadep992@gmail.com';
        $githubToken = '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';
        $githubRepository = 'Starserver1';
        $githubFilePath = 'uploads/' . $file['name'];

        $githubUrl = "https://api.github.com/repos/$githubUsername/$githubRepository/contents/$githubFilePath";
        $content = file_get_contents($uploadFile);
        $data = array(
            'message' => 'Upload file',
            'content' => base64_encode($content)
        );

        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n" .
                            "Authorization: token $githubToken\r\n",
                'method' => 'PUT',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($githubUrl, false, $context);

        echo "File uploaded to GitHub successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
