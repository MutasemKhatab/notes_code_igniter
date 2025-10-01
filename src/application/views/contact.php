<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f6f7fb;color:#333;padding:20px}
        .container{max-width:600px;margin:40px auto;background:#fff;padding:20px;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.06)}
        h1{margin-top:0;font-size:22px}
        .field{margin-bottom:12px}
        label{display:block;font-weight:600;margin-bottom:6px}
        input[type=text],input[type=email],textarea{width:100%;padding:8px;border:1px solid #d6d9e6;border-radius:4px;font-size:14px}
        textarea{min-height:120px;resize:vertical}
        .btn{display:inline-block;padding:10px 16px;background:#2f80ed;color:#fff;border-radius:4px;text-decoration:none;border:none;cursor:pointer}
        .error{background:#ffe7e7;color:#9b1c1c;padding:8px;border-radius:4px;margin-bottom:12px}
        .success{background:#e6ffed;color:#116633;padding:8px;border-radius:4px;margin-bottom:12px}
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>

        <?php if (function_exists('validation_errors') && validation_errors()): ?>
            <div class="error"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

        <?php if (isset($this->session) && $this->session->flashdata('success')): ?>
            <div class="success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

    <?php echo form_open('contact/send'); ?>
            <?php
            // Include CSRF token if available (CodeIgniter)
            if (isset($this->security) && method_exists($this->security, 'get_csrf_token_name')) {
                echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" />';
            }
            ?>
            <div class="field">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="<?php echo set_value('name'); ?>" required>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?php echo set_value('email'); ?>" required>
            </div>

            <div class="field">
                <label for="message">Message</label>
                <textarea id="message" name="message" required><?php echo set_value('message'); ?></textarea>
            </div>

            <button type="submit" class="btn">Send Message</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>