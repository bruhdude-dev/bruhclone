<?php
require_once('inc/connect.php');
requireAuth();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
        showJSONError(400, 1234321, 'The CSRF check failed.');
    }
    $stmt = $db->prepare('SELECT nickname, email, has_mh, nnid, mh, profile_comment, site_theme, birthday, country, website, genre FROM users WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    if($stmt->error) {
        showJSONError(500, 1203091, 'An error occurred while grabbing your theme settings from the database.');
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $edits = [];
    $sessionEdits = [];
    foreach($_POST as $key => &$value) {
        if(array_key_exists($key, $row) && $row[$key] !== $value) {
            switch($key) {
                case 'site_theme':
				    if(!in_array($value, ['0', '1', '2'])) {
                        showJSONError(400, 1038843, 'Your site theme setting is invalid.');
                    }
                    if($value === '1') {
                        $sessionEdits['site_theme'] = 1;
                        if(empty($row['site_theme'])) {
							$edits[] = 'site_theme = null';
							$sessionEdits['site_theme'] = null;
                        } else {
							$edits[] = 'site_theme = "' . $db->real_escape_string($row['site_theme']) . '"';
							$sessionEdits['site_theme'] = $row['site_theme'];
                        }
                    } else {
						$edits[] = 'site_theme = 0';
                        $sessionEdits['site_theme'] = 0;
                    }
                    break;
                default:
                    goto next;
            }
            $edits[] = $key . ' = "' . $db->real_escape_string($value) . '"';
            next:
        }
    }
    if(count($edits) > 0) {
        $stmt = $db->prepare('UPDATE users SET ' . implode(', ', $edits) . ' WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        if($stmt->error) {
            showJSONError(500, 3928989, 'There was an error while saving your theme settings.');
        }
    }
    if(count($sessionEdits) > 0) {
        foreach($sessionEdits as $key => &$value) {
            $_SESSION[$key] = $value;
        }
    }
} else {
    $title = 'Theme Settings';
    require_once('inc/header.php');
    $row = initUser($_SESSION['username']);
    ?><div class="main-column messages">
        <div class="post-list-outline">
            <h2 class="label">Theme Settings</h2>
            <form class="setting-form" action="/settings/profile" method="post">
                <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                <ul class="settings-list">
                <li class="theme-settings">
                    <p class="settings-label">Here, you can set your site theme. You will be able to suggest themes in the coming soon <b>Suggestions Community</b>.</p>
                        <p class="settings-label">Default Pack</p>
                        <label><input type="radio" name="site_theme" value="0"<?=$row['site_theme'] === 0 ? ' checked' : ''?>> Light</label>
                        <label><input type="radio" name="site_theme" value="1"<?=$row['site_theme'] === 1 ? ' checked' : ''?>> Dark</label>
                    <p class="settings-label">bruhclone Pack</p>

                    <p class="settings-label">Uncategorized</p>
                    <label><input type="radio" name="site_theme" value="2"<?=$row['site_theme'] === 2 ? ' checked' : ''?>> Neon</label>
                    </li>
                </ul>
                <div class="form-buttons">
                    <input type="submit" class="black-button apply-button" value="Save Settings">
                </div>
            </form>
        </div>
    </div><?php
    require_once('inc/footer.php');
}
?>