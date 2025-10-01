<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'About'; ?></title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 2rem; color: #333; }
        .card { max-width: 700px; margin: 0 auto; padding: 1.5rem; border: 1px solid #e0e0e0; border-radius: 6px; background: #fff; }
        h1 { margin-top: 0; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .meta { color: #666; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'About This App'; ?></h1>

        <p class="meta">A minimal CodeIgniter view located at application/views/about.php.</p>

        <p>
            This is a simple about page. Replace this content with details about your project,
            team, or application purpose.
        </p>

        <ul>
            <li><strong>Version:</strong> <?php echo isset($version) ? htmlspecialchars($version) : '1.0.0'; ?></li>
            <li><strong>Author:</strong> <?php echo isset($author) ? htmlspecialchars($author) : 'Your Name'; ?></li>
        </ul>

        <p>
            <a href="<?php echo isset($home_url) ? htmlspecialchars($home_url) : site_url(); ?>">Back to home</a>
        </p>
    </div>
</body>
</html>