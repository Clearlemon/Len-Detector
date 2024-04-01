<?php
// Plugin Name: 青柠社-主题环境检测器
// Plugin URI: https://tqlen.com
// Description: 启用插件后，点击开始检测来检测当前的服务器环境是否适配主题
// Author: Len
// Version: 12.2.7
// PHP Required: 7.4
// Author URI: https://tqlen.com


// 如果直接访问该文件，则退出
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate_String_Keep函数用于生成随机字符串并将其保存到WordPress选项中。
 * 
 * @return void
 */
function Generate_String_Keep()
{
    // 生成随机字符串
    $RandomBytes = random_bytes(16);
    $RandomString = bin2hex($RandomBytes);

    // 保存到 WordPress 选项中
    update_option('Generate_Key', $RandomString);
}

// 注册激活插件时执行的钩子
register_activation_hook(__FILE__, 'Generate_String_Keep');


/**
 * Plugin_Links函数用于为插件添加设置链接。
 * 
 * @param array $links 插件激活后的链接数组
 * @param string $file 插件文件路径
 * @return array 更新后的插件链接数组
 */
function Plugin_Links($links, $file)
{
    if (plugin_basename(__FILE__) == $file) {
        // 生成并保存随机字符串
        Generate_String_Keep();

        // 获取随机字符串
        $RandomString = get_option('Generate_Key');

        // 使用随机字符串创建链接
        $settings_link = '<a href="' . admin_url('admin-ajax.php?action=Detector_Page_Ajax&_wpnonce=' . wp_create_nonce('Detector_Page_Ajax_nonce') . '&random_string=' . $RandomString) . '" target="_blank" class="button button-primary" style="line-height: 1.5; min-height: auto;">开始检测 | Detect</a>';

        // 添加链接到插件设置
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'Plugin_Links', 10, 2);


/**
 * Detector_Page_Ajax函数用于处理Ajax请求，输出检测页面内容。
 * 
 * @return void
 */
function Detector_Page_Ajax()
{
    // 获取请求中的随机字符串

    $Request_Random_String = isset($_GET['random_string']) ? $_GET['random_string'] : '';
    // 获取当前存储的随机字符串
    $Generate_Key = get_option('Generate_Key');

    // 检查随机字符串是否匹配
    if ($Request_Random_String === $Generate_Key && current_user_can('manage_options')) {
        // 如果匹配，输出内容
        $plugin_data = get_plugin_data(__FILE__);
        $plugin_name = $plugin_data['Name'];
        $var = 1.0;
        $current_time = current_time('Y-m-d H:i:s');
?>
        <!DOCTYPE html>
        <html lang="zh">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $plugin_name ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
            <link rel="stylesheet" id="bootstrap" href="<?php echo plugin_dir_url(__FILE__); ?>Assets/bootstrap.min.css?ver=<?php echo $var ?>" media="all">
            <link rel="stylesheet" id="plugin" href="<?php echo plugin_dir_url(__FILE__); ?>Assets/index.css?ver=<?php echo $var ?>" media="all">

        </head>

        <body>
            <img class="bady-background-block" src="https://t.mwm.moe/pc">
            <div class="main-block">
                <p class="fs-3 text-center "><?php echo $plugin_name ?></p>
            </div>
            <div class="detector-block">
                <div class="card">
                    <img src="<?php echo plugin_dir_url(__FILE__); ?>Img/screenshot_Len.jpg" class="card-img-top" alt="柠檬主题">

                    <div class="card-body">
                        <h5 class="card-title">Len主题</h5>
                        <p class="card-text">
                            简约形的双边栏个人博客主题<br>
                            &emsp;&emsp;——The World is beautiful
                        </p>
                        <div class="but-block">
                            <a href="https://github.com/Clearlemon/Len-Free" class="btn btn-primary">Get Free</a>
                            <a href="#" class="btn btn-primary">Get Pro</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="<?php echo plugin_dir_url(__FILE__); ?>Img/screenshot_Maple.jpg" class="card-img-top" alt="枫主题">

                    <div class="card-body">
                        <h5 class="card-title">Maple主题</h5>
                        <p class="card-text">
                            一个不被约束的社区商城主题<br>
                            &emsp;&emsp;——The tide will ebb and flow</p>
                        <a href="#" class="btn btn-primary">Undeveloped</a>
                    </div>
                </div>
                <div class="card">
                    <img src="<?php echo plugin_dir_url(__FILE__); ?>Img/screenshot_Leaf.jpg" class="card-img-top" alt="叶主题">

                    <div class="card-body">
                        <h5 class="card-title">Leaf主题</h5>
                        <p class="card-text">
                            一款二次元倾向的主题？<br>
                            &emsp;&emsp;——Miracles are everywh
                        </p>
                        <a href="#" class="btn btn-primary">Undeveloped</a>
                    </div>
                </div>
                <div class="card">
                    <img src="<?php echo plugin_dir_url(__FILE__); ?>Img/screenshot_await.png" class="card-img-top" alt="叶主题">

                    <div class="card-body">
                        <h5 class="card-title">等待开发...</h5>
                        <p class="card-text">
                            或许这是一款不容错过的主题？<br>
                            &emsp;&emsp;——Waiting may not be a bad thing</p>
                        <a href="#" class="btn btn-primary">Undeveloped</a>
                    </div>
                </div>
            </div>
            <div class="detector-block-2">
                <ul class="prompt-title">
                    <div class="alert alert-dark" role="alert">
                        请选择你要检测的主题
                    </div>
                    <li class="">本检测器可以检测您的主机状况并判断是否能正常使用当前检测的主题。</li>
                    <li class="">如果有任何一项没法通过（红色），主题的部分功能就无法正常运作。</li>
                    <li class="">在您使用主题前或使用主题中遇到异常问题，可以先使用检测器检测是否能全通过（全绿）。</li>
                    <li class="">部分主题的PRO必须绿色的会在前面有个*标注</li>
                </ul>
                <div class="form-select-block">
                    <select id="selectBox" class="form-select" aria-label="Default select example">
                        <option selected>请选择你的要检测的主题</option>
                        <option value="option1">Len主题检测</option>
                        <option value="option2">Maple主题检测</option>
                        <option value="option3">Leaf主题检测</option>
                    </select>
                    <button type="button" class="btn btn-dark" onclick="showContent()">重新检测</button>
                </div>
                <p class="text-center"><?php echo $plugin_name, ' | ', $current_time  ?></p>
            </div>

            <div id="output" class="detector-substance">

            </div>

            <script>
                // 定义函数
                // 定义函数
                function showContent() {
                    // 获取选择框中选中的值
                    var selectedValue = document.getElementById("selectBox").value;
                    var outputDiv = document.getElementById("output");

                    // 使用Ajax调用PHP文件
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            outputDiv.innerHTML = this.responseText;
                        }
                    };

                    // 构建 Detector.php 文件的 URL
                    var detectorUrl = "<?php echo esc_url(plugins_url('Len-Detector/Detector.php', 'Len-Detector')); ?>";
                    // 构建完整的 URL，包括选项值
                    var url = detectorUrl + "?option=" + selectedValue;

                    // 发起 Ajax 请求
                    xmlhttp.open("GET", url, true);
                    xmlhttp.send();
                }

                // 在下拉选择框的 onchange 事件中调用 showContent 函数
                document.getElementById("selectBox").onchange = showContent;

                // 页面加载时调用一次 showContent 函数，以便在选择框初始状态时显示相应内容
                showContent();
            </script>
            <script src="<?php echo plugin_dir_url(__FILE__); ?>Assets/bootstrap.bundle.min.js?ver=<?php echo $var ?>" id="bootstrap"></script>
            <script src="<?php echo plugin_dir_url(__FILE__); ?>Assets/index.js?ver=<?php echo $var ?>" id="plugin"></script>

        </body>

        </html>
<?php
    } else {
        // 如果随机字符串不匹配，输出错误消息
        echo '无法访问此网页';
    }

    // 必须调用 wp_die() 来结束请求
    wp_die();
}
// 将 AJAX 处理函数挂钩到 WordPress 的特定动作
add_action('wp_ajax_Detector_Page_Ajax', 'Detector_Page_Ajax');
add_action('wp_ajax_nopriv_Detector_Page_Ajax', 'Detector_Page_Ajax');
