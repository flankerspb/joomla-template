<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class = "jshop" id = "jshop_menu_order">
  <ul class="uk-subnav uk-subnav-line">
    <?php foreach($this->steps as $k=>$step) : ?>
      <li class = "jshop_order_step <?php echo $this->cssclass[$k]?>">
        <?php echo $step;?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>