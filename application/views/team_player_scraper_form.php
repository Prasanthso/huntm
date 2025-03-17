<!DOCTYPE html>
<html>
<head>
    <title>Team Player Scraper</title>
</head>
<body>
    <h1>Team Player Scraper</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="<?php echo base_url('teamplayerscraper/scrape'); ?>">
        <label for="url">Match URL:</label>
        <input type="url" id="url" name="url" required value="<?php echo isset($_POST['url']) ? htmlspecialchars($_POST['url']) : ''; ?>">

        <label for="team">Select Team:</label>
        <select id="team" name="team">
            <option value="left" <?php echo ($selectedTeam == 'left') ? 'selected' : ''; ?>>Afghanistan Team</option>
            <option value="right" <?php echo ($selectedTeam == 'right') ? 'selected' : ''; ?>>England Team</option>
        </select>

        <label for="options">Select details to display:</label>
        <select id="options" name="options">
            <option value="name" <?php echo ($selectedOption == 'name') ? 'selected' : ''; ?>>Batsmen Name</option>
            <option value="status" <?php echo ($selectedOption == 'status') ? 'selected' : ''; ?>>Batsmen Name & Status</option>
            <option value="bowler" <?php echo ($selectedOption == 'bowler') ? 'selected' : ''; ?>>Bowler Name</option>
            <option value="coach" <?php echo ($selectedOption == 'coach') ? 'selected' : ''; ?>>Coach Name</option>
        </select>
        
        <button type="submit" name="submit">Get Details</button>
    </form>

    <?php if (!empty($playersList)) { ?>
        <h2>Player Details</h2>
        <ul>
            <?php foreach ($playersList as $player) { ?>
                <li><?php echo $player; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>
