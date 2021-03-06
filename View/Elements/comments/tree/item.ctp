<?php
/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$_actionLinks = array();
if (!empty($displayUrlToComment)) {
	$_actionLinks[] = sprintf('<a href="%s">%s</a>', $urlToComment . '/' . $comment['Comment']['slug'], __d('comments', 'View'));
}

if (!empty($allowAddByAuth)) {
	$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Reply'), array_merge($url, array('comment' => $comment['Comment']['id'], '#' => 'comment' . $comment['Comment']['id'])));
	$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Quote'), array_merge($url, array('comment' => $comment['Comment']['id'], 'quote' => 1, '#' => 'comment' . $comment['Comment']['id'])));
	if (!empty($isAdmin)) {
		if (empty($comment['Comment']['approved'])) {
			$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Publish'), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggleApprove', '#' => 'comment' . $comment['id'])));
		} else {
			$_actionLinks[] = $this->CommentWidget->link(__d('comments', 'Unpublish'), array_merge($url, array('comment' => $comment['Comment']['id'], 'comment_action' => 'toggleApprove', '#' => 'comment' . $comment['Comment']['id'])));
		}
	}
}

$_userLink = $comment[$userModel]['id'];
?>
<div class="comment">
	<div class="header">
		<strong><a name="comment<?php echo $comment['Comment']['id'];?>"><?php echo $comment['Comment']['title'];?></a></strong>
		<span style="float: right"><?php echo join('&nbsp;', $_actionLinks);?></span>
		<br/>
		<span class="byTime"><?php echo $_userLink; ?> <?php echo __d('comments', 'posted'); ?> <?php echo $this->Time->timeAgoInWords($comment['Comment']['created']); ?></span>
	</div>
	<div class="body">
		<?php echo $this->Cleaner->bbcode2js($comment['Comment']['body']);?>
	</div>
</div>