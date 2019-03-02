<?php

class Single {
    static $name = "Single";
    static $version = "2.0";

    static $author = "", $authorCache = "";

    // 更新检测
    static function update(){
        $update = file_get_contents("https://api.paugram.com/update/?name=" . self::$name . "&current=" . self::$version . "&site=" . $_SERVER['HTTP_HOST'], false, stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "timeout" => 10
            )
        )));
        $update = json_decode($update, true);

        if(isset($update["name"])) self::$name = $update["name"];
?>
        <style>.dreamer-paul{ text-align:center; margin:1em 0; } .dreamer-paul > *{ margin:0 0 1rem } .buttons a{ background:#467b96; color:#fff; border-radius:4px; padding:.5em .75em; display:inline-block }</style>
        <div class="dreamer-paul">
            <h2><?php echo self::$name . " (" . self::$version . ")" ?></h2>
            <p>By: <a href='https://github.com/Dreamer-Paul'>Dreamer-Paul</a></p>
            <p class="buttons">
<?php if(isset($update['docs'])): ?>
                <a href="<?php echo $update['docs'] ?>">项目介绍</a>
<?php endif; ?>
<?php if(isset($update['link'])): ?>
                <a href="<?php echo $update['link'] ?>">更新日志</a>
<?php endif; ?>
            </p>
<?php if(isset($update['text'])): ?>
            <p><?php echo $update['text'] ?></p>
<?php endif; ?>
<?php if(isset($update['message'])): ?>
            <p><?php echo $update['message'] ?></p>
<?php endif; ?>
        </div>
<?php
    }

    // 夜间模式
    static function is_night() {
        if(!empty($_COOKIE["night"])){
            if($_COOKIE["night"] == "true") echo ' class="neon"';
        }
    }

    // 时间转换
    static function tran_time($ts){
        $dur = time() - $ts;

        if($dur < 0){
            return $ts;
        }
        else if($dur < 60){
            return $dur . ' 秒前';
        }
        else if($dur < 3600){
            return floor($dur / 60) . ' 分钟前';
        }
        else if($dur < 86400){
            return floor($dur / 3600) . ' 小时前';
        }
        else if($dur < 604800){
            return floor($dur / 86400) . ' 天前';
        }
        else if($dur < 2592000){
            return floor($dur / 604800) . " 周前";
        }
        else if($dur < 31557600){
            return floor($dur / 2592000) . " 个月前";
        }
        else{
            return date("Y.m.d", $ts);
        }
    }
}