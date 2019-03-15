<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php $this -> archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('含关键词 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); $this -> options -> title(); ?></title>
<?php if($this -> options -> favicon): ?>
    <link rel="icon" href="<?php $this -> options -> favicon(); ?>" sizes="192x192"/>
<?php else: ?>
    <link rel="icon" href="<?php $this -> options -> themeUrl('img/icon.png'); ?>" sizes="192x192"/>
<?php endif; ?>
<?php if($this -> options -> cdn_set == '0'): ?>
    <link href="<?php $this -> options -> themeUrl('static/kico.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php $this -> options -> themeUrl('static/single.css'); ?>" rel="stylesheet" type="text/css"/>
<?php else: ?>
    <link href="https://cdn.jsdelivr.net/gh/Dreamer-Paul/Single@<?php echo Single::$version; ?>/static/kico.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/gh/Dreamer-Paul/Single@<?php echo Single::$version; ?>/static/single.css" rel="stylesheet" type="text/css"/>
<?php endif; ?>
    <link href="<?php $this->options->themeUrl('css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1"/>
<?php if($this -> options -> background): ?>
    <style>body:before{content: ''; background-image: url(<?php $this -> options -> background(); ?>)}</style>
<?php endif; ?>
<?php if($this -> options -> custom_css): ?>
    <style><?php $this -> options -> custom_css(); ?></style>
<?php endif; ?>
    <meta property="og:site_name" content="<?php $this -> options -> title(); ?>">
    <meta property="og:title" content="<?php $this -> archiveTitle(array(
            'category' => _t('%s'),
            'search'   => _t('含关键词 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ), ""); ?>"/>
<?php $this -> header('generator=&template=&pingback=&xmlrpc=&wlw='); ?>
</head>
<body<?php Single::is_night() ?>>
<header>
    <div class="head-title">
        <h4><?php $this -> options -> title(); ?></h4>
    </div>
    <div class="head-action">
        <div class="toggle-btn"></div>
        <div class="light-btn"></div>
        <div class="search-btn"></div>
    </div>
    <form class="head-search" method="post">
        <input type="text" name="s" placeholder="搜索什么？">
    </form>
    <ul class="head-menu">
        <li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
        <!-- <li class="has-child">
            <a>分类</a>
                <ul class="sub-menu">
                <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                <?php while($categorys->next()): ?>
                    <?php if ($categorys->levels === 0): ?>
                        <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                        <?php if (empty($children)) { ?>
                            <li <?php if($this->is('category', $categorys->slug)): ?> class="active"<?php endif; ?>>
                                <a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name(); ?>">
                                 ○ <?php $categorys->name(); ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" data-target="#"> ○ <?php $categorys->name(); ?> <b class="caret"></b></a>
                            </li>
                        <?php } ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        </li> -->
        <?php $this->widget('Widget_Contents_Page_List')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
    </ul>
</header>