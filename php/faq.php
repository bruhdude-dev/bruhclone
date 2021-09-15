<?php
$title = 'FAQ';
require_once('inc/header.php');
if(!empty($_SESSION['username'])) {
    $row = initUser($_SESSION['username'], true);
} else {
    $is_general = true;
    require_once('elements/user-sidebar.php');
}
?>
<div class="main-column post-list-outline" id="help">
    <h2 class="label">Frequently Asked Questions/FAQ</h2>
    <div id="guide" class="help-content">
	<p>If you have any questions you may be able to get answers for them here.</p>
            <div class="num2">
            <h3>But why?</h3>
	    <p>bruhclone was made as a place for people who want to use a chill clone instead of super-active/active clones like Clonemii. Also because I wanted to lol.</p>
            <h3>Why does bruhclone show the 500 internal server error when nothing is going on sometimes?</h3>
            <p>that's fixed <!--It is simply because of our host. We plan to move to a better host some day, but we don't know if we actually will.--></p>
	    <h3>Why are signups closed?</h3>
	    <p><br></p>
	    <h3>Can I be an administrator or moderator?</h3>
	    <p>no</p>
	    <h3>Someone stole stuff I made on here. How do I take it down?</h3>
	    <p><a href="/users/pa_parappa">If you see anyone stealing stuff you made, please contact me so I can take it down for you.</a></p>
	    <h3>Why does the 500 internal server error display when maintenance is going on?</h3>
	    <p>Because of our source not having a proper maintenance mode, we make it so the server cannot connect to the database so actions by users cannot be made.</p>
	    <h3>PLEASE STOP FILLING THE ROOM UP WITH CLONES PLEASE I CAN'T EVEN BREATH STOP PLEASE NO</h3>
	    <p><img src="https://cdn.discordapp.com/emojis/817895748493639720.png?v=1" style="height:50px;"></p>
        </div>
    </div>
</div>
<?php
require_once('inc/footer.php');
?>