<?php

defined('_JEXEC') or die;

// var_dump($this->baseurl);
// var_dump($this->document);
// var_dump($this->state);
// var_dump($this->print);
// var_dump($this->params);
// var_dump($this->item);

// foreach($this as $k => $v)
// {
	// var_dump($k);
// }

$item = $this->item;

$uri = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));
$c_uri = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid));

// $asdasdasd = JCategories::getInstance('content')->get(8);

// var_dump($asdasdasd);

$articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

$app = JFactory::getApplication();
$appParams = $app->getParams();
$articles->setState('params', $appParams);
$articles->setState('filter.published', 1);
$articles->setState('filter.category_id', $item->catid);
$articles->setState('list.ordering', 'ordering');
$articles->setState('list.direction', 'ASC');

$services = $articles->getItems();

// var_dump($item);

$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select('name, image, webpage')->from('#__contact_details')->where('id = 1');
$db->setQuery($query);
$author = $db->loadObject();

?>
<div class="">
	<div class="uk-grid" data-uk-grid-match data-uk-grid-margin>
		<aside class="uk-width-1-5 uk-hidden-small">
			<div class="uk-panel fl-panel-tab" itemscope itemtype="https://schema.org/ItemList">
				<h2 class="uk-panel-title" itemprop="name"><?php echo JHTML::link($c_uri, $item->category_title); ?></h2>
				<ul class="uk-tab uk-tab-left target">
					<?php foreach($services as $service)
					{
						static $i = 0;
						$i++;
						
						$class = $service->id == $item->id ? ' class="uk-active"' : '';
						$s_uri = JRoute::_(ContentHelperRoute::getArticleRoute($service->id, $service->catid, $service->language));
						
						echo
							'<li '. $class . 'itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'
							. JHtml::link($s_uri, '<span itemprop="name">' . $service->title . '</span>', 'itemprop="url"')
							.'<meta itemprop="position" content="'.$i.'">'
							. '</li>';
					}
					?>
				</ul>
			</div>
		</aside>
		<article class="uk-width-4-5" itemscope itemtype="https://schema.org/Article">
			<div class="uk-panel">
				<?php if ($image && $image_alignment == 'none') : ?>
					<?php if ($url) : ?>
						<a href="<?php echo $url; ?>" title="<?php echo $image_caption; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>"></a>
					<?php else : ?>
						<img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
					<?php endif; ?>
				<?php endif; ?>
				
				<h1 class="uk-text-center" itemprop="headline name"><?php echo $item->title; ?></h1>
				
				<link itemprop="url mainEntityOfPage" href="<?php echo Juri::current(); ?>">
				<meta itemprop="dateCreated" content="<?php echo substr($item->created, 0, 10); ?>">
				<meta itemprop="datePublished" content="<?php echo substr($item->publish_up, 0, 10); ?>">
				<meta itemprop="dateModified" content="<?php echo substr($item->modified, 0, 10); ?>">
				
				<meta itemprop="version" content="<?php echo $item->version; ?>">
				
				<?php if ($author) : ?>
				<span itemprop="author publisher" itemscope itemtype="https://schema.org/Organization" hidden>
					<meta itemprop="name" content="<?php echo $author->name; ?>">
					<link itemprop="url" href="<?php echo $author->webpage ? $author->webpage: Juri::root(); ?>">
					<link itemprop="logo" href="<?php echo $author->image; ?>">
				</span>
				<?php endif; ?>
				
				<?php if($images['icon']) : ?>
				<link itemprop="image thumbnailUrl" href="<?php echo $images['icon']; ?>">
				<?php endif; ?>
				
				<?php if($item->text) : ?>
					<div itemprop="description articleBody text" id="description"><?php echo $item->text; ?></div>
				<?php endif; ?>
				
				<?php if ($images['show_gallery1'] && count($images['gallery1']))
				{
					$gallery .= '<ul class="uk-grid uk-grid-collapse uk-grid-width-1-3  uk-grid-width-small-1-5 uk-flex uk-flex-center uk-margin-bottom" data-uk-grid-margin>';
					
					$a_attribs = array();
					$a_attribs['class'] = 'uk-position-cover';
					$a_attribs['data-uk-lightbox'] = '{group:\'g1\'}';
					$a_attribs['itemprop'] = 'contentUrl url';
					
					
					$i_attribs = array();
					$i_attribs['class'] = 'uk-overlay-scale';
					$i_attribs['width'] = '256';
					$i_attribs['height'] = '192';
					$i_attribs['itemprop'] = 'thumbnail';
					
					foreach($images['gallery1'] as $img)
					{
						$gallery .= '<li><div class="uk-panel"><figure class="uk-overlay uk-overlay-hover" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
						
						$i_a = $i_attribs;
						$i_a['title'] = $img['alt'];
						
						// $gallery .= '<figure>';
						
						$gallery .= JHtml::image('thumbs/'. $i_attribs['width'] .'x'. $i_attribs['height'] .'/' . $img['src'], $img['alt'], $i_a, false, -1);
						
						// $gallery .= '<figcaption hidden>'.$img['alt'].'</figcaption>';
						
						// $gallery .= '</figure>';
						
						$gallery .= '<div class="uk-overlay-panel uk-overlay-background uk-overlay-fade"></div>';
						// echo '<div class="uk-overlay-panel uk-overlay-bottom uk-overlay-fade fl-object-phumb" itemprop="name">'. $img['alt'] .'</div>';
						
						// $a_attribs['title'] = $i_a['title'];
						$gallery .= JHtml::link($img['src'], '<figcaption itemprop="name" hidden>'.$img['alt'].'</figcaption>', $a_attribs);
						
						$gallery .= '</figure></div></li>';
					}
					
					$gallery .= '</ul>';
					
					echo $gallery;
				}
				?>
			</div>
		</article>
	</div>
</div>
