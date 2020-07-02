<script>
function isEmptyValue(value){
	var pattern = /\S/;
	return ret = (pattern.test(value)) ? (true) : (false);
}
</script>
<form class="fl-form-search" name = "searchForm" method = "post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit = "return isEmptyValue(jQuery('#jshop_search').val())">
	
	<input type="hidden" name="setsearchdata" value="1">
	<input type="hidden" name = "category_id" value="<?php print $category_id?>" />
	<input type="hidden" name = "search_type" value="<?php print $search_type;?>" />
	
	<input type="text" class="fl-search-input" placeholder="Поиск" name="search" id="jshop_search" value="<?php print htmlspecialchars($search)?>" /><button class="fl-search-submit" type="submit"></button>
	
</form>