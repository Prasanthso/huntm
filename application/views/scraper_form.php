<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Scraper</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        input { padding: 10px; width: 300px; margin: 10px; }
        button { padding: 10px; background-color: blue; color: white; border: none; cursor: pointer; }
        button:hover { background-color: darkblue; }
    </style>
</head>
<body>
    <h2>Enter a URL to Scrape Tables</h2>
    <form method="post" action="<?php echo base_url('scraper/scrape'); ?>">
        <input type="text" name="url" placeholder="Enter website URL" required>
        <button type="submit">Scrape</button>
    </form>
</body>
</html>
