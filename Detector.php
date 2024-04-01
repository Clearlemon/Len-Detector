<?php
// 获取选项值
// 加载WordPress环境
$directory = __DIR__;
$parent_directory = dirname(dirname(dirname($directory))); // 获取三次父目录
require_once('' . $parent_directory . '/wp-load.php');

// 检查是否在WordPress环境下运行，若不是则终止脚本
if (!defined('ABSPATH')) {
    exit;
}
$option = $_GET['option'];

echo getContent($option);

// 定义 PHP 函数
function getContent($option)
{
    switch ($option) {
        case "option1":
            return  Len_Website_Information();
        case "option2":
            return Maple_Website_Information();
        case "option3":
            return Leaf_Website_Information();
        default:
            return; // 清空内容
    }
}

function Len_Website_Information()
{
    $site_title = get_bloginfo('name');
    $site_url = get_bloginfo('url');
    $wordpress_version = get_bloginfo('version');
    $php_version = phpversion();
    global $wpdb;
    $mysql_version = $wpdb->db_version();
    $upload_dir = wp_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];
    $wp_config_file = ABSPATH . 'wp-config.php';
    $file_contents = file_get_contents($wp_config_file);
    require_once($wp_config_file);
    $permalink_structure = get_option('permalink_structure');

?>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">站点信息</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">站点名称</div>
                <div class="detector-right"><?php echo $site_title; ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">站点网址</div>
                <div class="detector-right"><?php echo $site_url; ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Wordpress版本</div>
                <div class="detector-right"><?php echo $wordpress_version; ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">PHP版本</div>
                <div class="detector-right"><?php echo $php_version; ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Myql版本</div>
                <div class="detector-right"><?php echo $mysql_version; ?></div>
            </div>
        </ul>
    </fieldset>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">版本限制</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Wordpress最低版本</div>
                <div class="detector-right">
                    <?php limit($wordpress_version, '5.4'); ?>
                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">PHP最低版本</div>
                <div class="detector-right"><?php limit($php_version, '7.4'); ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Mysql最低版本</div>
                <div class="detector-right"><?php limit($mysql_version, '5.4'); ?>
                </div>
            </div>
        </ul>
    </fieldset>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">Wordpress配置</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">wp-content 目录可写</div>
                <div class="detector-right">
                    <?php
                    if (is_writable($upload_dir_path)) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                            </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                            </svg>';
                    }
                    ?>
                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">wp-config.php 文件无 BOM</div>
                <div class="detector-right">
                    <?php
                    if (strpos($file_contents, "\xEF\xBB\xBF") === 0) {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                                            <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                                            <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                                                        </svg>';
                    } else {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                                                            </svg>';
                    }
                    ?>
                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">wp-config.php 配置正确性</div>
                <div class="detector-right">

                    <?php
                    if (defined('DB_NAME') && defined('DB_USER') && defined('DB_PASSWORD') && defined('DB_HOST')) {
                        // 检查连接是否成功
                        if ($mysql_version) {
                            echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                    <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                                </svg>';
                        } else {
                            echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                    <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                    <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                                </svg>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">固定连接是否是数字型</div>
                <div class="detector-right">
                    <?php
                    if (strpos($permalink_structure, '/archives/%post_id%') === 0) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                    <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                                </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                    <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                    <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                                </svg>';
                    }
                    ?>

                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">域名与数据库匹配</div>
                <div class="detector-right">
                    <?php
                    // 获取当前WordPress站点的URL
                    $siteurl = get_option('siteurl');
                    // 检查siteurl是否为空
                    if (!empty($siteurl)) {
                        // 检查siteurl是否与当前域名匹配
                        $current_domain = $_SERVER['HTTP_HOST'];
                        if ($current_domain === wp_parse_url($siteurl, PHP_URL_HOST)) {
                            echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
            </svg>';
                        } else {
                            echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
            </svg>';
                        }
                    } else {
                        echo "无法获取WordPress站点的siteurl";
                    }
                    ?>
                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Wordpress伪静态</div>
                <div class="detector-right">
                    <?php
                    // 获取随机文章
                    $random_post = get_posts(array(
                        'numberposts' => 1,
                        'orderby' => 'rand',
                        'post_type' => 'post',
                        'post_status' => 'publish'
                    ));

                    // 如果有随机文章
                    if (!empty($random_post)) {
                        // 获取文章的 URL
                        $post_url = get_permalink($random_post[0]->ID);

                        // 发起 HTTP 请求，获取页面内容
                        $response = wp_remote_get($post_url);
                        $body = wp_remote_retrieve_body($response);

                        // 检查页面内容是否包含伪静态的标识
                        if (strpos($body, '/archives/') !== false) {
                            echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                    <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                                </svg>';
                        } else {
                            echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                    <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                    <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                                </svg>';
                        }
                    }
                    ?>
                </div>
            </div>
        </ul>
    </fieldset>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">PHP扩展</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Redis</div>
                <div class="detector-right">
                    <?php
                    // 检查Redis扩展是否加载
                    if (extension_loaded('redis')) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                            </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                            </svg>';
                    }
                    ?>

                </div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Imigack</div>
                <div class="detector-right">
                    <?php
                    if (extension_loaded('imigack')) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                            </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                            </svg>';
                    } ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Exif</div>
                <div class="detector-right">
                    <?php
                    if (extension_loaded('exif')) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                            </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                            </svg>';
                    } ?></div>
            </div>
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">Zip</div>
                <div class="detector-right">
                    <?php
                    if (extension_loaded('Zip')) {
                        echo '<svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
                                <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
                            </svg>';
                    } else {
                        echo '<svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
                                <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
                                <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
                            </svg>';
                    } ?></div>
            </div>
        </ul>
    </fieldset>
<?php
}


function Maple_Website_Information()
{
?>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">未开发</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">未开发</div>
                <div class="detector-right">未开发</div>
            </div>
        </ul>
    </fieldset>
<?php
}

function Leaf_Website_Information()
{
?>
    <fieldset class="detector-substance-block-min">
        <legend class="title-blcok">未开发</legend>
        <ul class="list-group">
            <div class="list-group-item detector-div-leaft-right">
                <div class="detector-leaft">未开发</div>
                <div class="detector-right">未开发</div>
            </div>
        </ul>
    </fieldset>
    <?php
}


function limit($limit = '', $var = '')
{
    if (version_compare($limit, $var, '>')) {
    ?>
        <svg t="1711856349410" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6244" width="200" height="200">
            <path d="M512 0C228.430769 0 0 228.430769 0 512s228.430769 512 512 512 512-228.430769 512-512S795.569231 0 512 0z m256 413.538462l-271.753846 271.753846c-7.876923 7.876923-19.692308 11.815385-31.507692 11.815384-11.815385 0-23.630769-3.938462-31.507693-11.815384l-169.353846-169.353846c-15.753846-15.753846-15.753846-47.261538 0-63.015385 15.753846-15.753846 47.261538-15.753846 63.015385 0l137.846154 137.846154 240.246153-240.246154c15.753846-15.753846 47.261538-15.753846 63.015385 0 19.692308 15.753846 19.692308 47.261538 0 63.015385z" fill="#94C86C" p-id="6245"></path>
        </svg>
    <?php
    } else {
    ?>
        <svg t="1711867251968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4249" width="200" height="200">
            <path d="M512 0a512 512 0 0 0-512 512 512 512 0 0 0 512 512 512 512 0 0 0 512-512 512 512 0 0 0-512-512z" fill="#FD6B6D" p-id="4250"></path>
            <path d="M513.755429 565.540571L359.277714 720.018286a39.058286 39.058286 0 0 1-55.296-0.073143 39.277714 39.277714 0 0 1 0.073143-55.442286l154.331429-154.331428-155.062857-155.136a36.571429 36.571429 0 0 1 51.712-51.785143l365.714285 365.714285a36.571429 36.571429 0 1 1-51.785143 51.785143L513.755429 565.540571z m157.549714-262.582857a35.254857 35.254857 0 1 1 49.737143 49.737143l-106.057143 108.982857a35.254857 35.254857 0 1 1-49.883429-49.810285l106.203429-108.982858z" fill="#FFFFFF" p-id="4251"></path>
        </svg>
<?php
    }
}
