<?php
$title = 'Feed';
$selected = 'feed';
require_once('inc/header.php');
$is_general = true;
require_once('inc/connect.php'); // this doesn't work
require_once('elements/user-sidebar.php'); // this doesn't work
?>
<div class="feed-main community-top post-list-outline">
<!--notice thingy:--><div style="padding:15px 35px 15px 15px;margin-bottom:20px;border: 1px solid #bcdbf1;border-radius:4px;color: #31758f;background-color: #d1e6f5;"><?php print(FEED_NOTICE); ?></div>
    <form id="post-form" method="post" action="/posts" class="for-identified-user folded" data-post-subtype="default">
        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
        <div class="feeling-selector js-feeling-selector"><label class="symbol feeling-button feeling-button-normal checked"><input type="radio" name="feeling_id" value="0" checked><span class="symbol-label">normal</span></label><label class="symbol feeling-button feeling-button-happy"><input type="radio" name="feeling_id" value="1"><span class="symbol-label">happy</span></label><label class="symbol feeling-button feeling-button-like"><input type="radio" name="feeling_id" value="2"><span class="symbol-label">like</span></label><label class="symbol feeling-button feeling-button-surprised"><input type="radio" name="feeling_id" value="3"><span class="symbol-label">surprised</span></label><label class="symbol feeling-button feeling-button-frustrated"><input type="radio" name="feeling_id" value="4"><span class="symbol-label">frustrated</span></label><label class="symbol feeling-button feeling-button-puzzled"><input type="radio" name="feeling_id" value="5"><span class="symbol-label">puzzled</span></label></div>
        <div class="textarea-with-menu">
            <div class="textarea-container">
                <textarea name="body" class="textarea-text textarea" maxlength="2000" placeholder="Share your thoughts in a post to <?php print(SITE_NAME); ?>." data-open-folded-form data-required></textarea>
            </div>
        </div>
        <details class="select-from-album-button headline">
            <a class="right" data-modal-open="#about-tags"><strong>Help</strong></a>
            <div id="about-tags" class="dialog none">
                <div class="dialog-inner">
                    <div class="window">
                        <h1 class="window-title">About Tags</h1>
                        <div class="window-body">
                            <p class="window-body-content">A post can optionally have up to 20 tags, each of up to 20 characters of length. These tags will be displayed on your post's page, and are useful in helping people interested in these topics find your post. To add tags to your post, simply enter a comma-seperated list of tags (spaces after commas are optional) such as "art,gaming,spongebob". Please note that using tags deceptively may get your post removed.</p>
                            <div class="form-buttons">
                                <input type="button" class="olv-modal-close-button black-button" value="Close">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <summary class="timestamp-container left"><p class="post-tag post-official-tag symbol left">Tags</p></summary>
            <input type="text" class="textarea-line url-form" maxlength="438" name="tags" placeholder="A list of tags, seperated by commas">
        </details>
        <label class="file-button-container">
            <span class="input-label">Image
                <span>PNG, JPEG and GIF files are allowed.</span>
            </span>
            <input accept="image/*" type="file" class="file-button">
            <input type="hidden" name="image">
        </label>
        <div class="post-form-footer-options">
            <div class="post-form-footer-option-inner post-form-spoiler js-post-form-spoiler">
                <label class="spoiler-button symbol"><input type="checkbox" name="sensitive_content" value="1"> Sensitive</label>
            </div>
        </div>
        <div class="form-buttons">
            <input type="submit" class="black-button post-button disabled" value="Send" data-community-id="1" data-post-content-type="text" data-post-with-screenshot="nodata" disabled>
        </div>
    </form>
    <div class="body-content" id="community-post-list">
        <?php
        $stmt = $db->prepare('SELECT posts.id, created_by, posts.created_at, community, name, icon, feeling, body, image, yt, sensitive_content, username, nickname, avatar, has_mh, level, (SELECT COUNT(*) FROM empathies WHERE target = posts.id AND type = 0) AS empathy_count, (SELECT COUNT(*) FROM replies WHERE post = posts.id AND status = 0) AS reply_count, (SELECT COUNT(*) FROM empathies WHERE target = posts.id AND type = 0 AND source = ?) AS empathy_added FROM posts LEFT JOIN users ON created_by = users.id LEFT JOIN communities ON communities.id = community WHERE ((created_by IN (SELECT target FROM follows WHERE source = ?) OR created_by = ?) OR (community IN (SELECT community FROM community_favorites WHERE user = ?))) AND IF(level < ? OR IF(community IS NULL, 0, (SELECT IFNULL(level, 0) FROM community_admins WHERE user = ? AND community = community LIMIT 1) < (SELECT IFNULL(level, 0) FROM community_admins WHERE user = created_by AND community = community LIMIT 1)), 1, created_by NOT IN (SELECT target FROM blocks WHERE source = ? UNION SELECT source FROM blocks WHERE target = ?)) AND posts.status = 0 AND (community IS NULL OR privacy = 0 OR (SELECT COUNT(*) FROM community_members WHERE user = ? AND community = communities.id AND status = 1) = 1) ORDER BY posts.id DESC LIMIT 20 OFFSET ?');
        $stmt->bind_param('iiiiiiiiii', $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['level'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_GET['offset']);
        $stmt->execute();
        if($stmt->error) {
            showNoContent('An error occurred while grabbing posts.');
        } else {
            $result = $stmt->get_result();
            if($result->num_rows === 0) {
                if($_GET['offset'] === '0') {
                    ?><div class="no-content">
                        <p>Your feed is currently empty. Why not follow some people?<br>You can find some users to follow in your recommendations.</p>
                    </div><?php
                }
            } else {
                echo '<div class="list post-list js-post-list" data-next-page-url="?offset=' . ($_GET['offset'] + 20) . '">';
                $_GET['type'] = null;
                while($row = $result->fetch_assoc()) {
                    require('elements/post.php');
                }
                echo '</div>';
            }
        }
        ?>
    </div>
</div><?php
showMiniFooter();
?>
