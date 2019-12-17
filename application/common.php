<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function removeXSS($val){
    static $obj = null;
    if ($obj === null) {
        $obj = new HTMLPurifier();
    }

    // 返回过滤后的数据
    return $obj->purify($val);
}

/**
 * 邮箱发送函数
 * @param $to发给谁
 * @param $title 邮件标题
 * @param $content 内容
 * @return bool
 */
function sendMail($to, $title, $content)
{
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    $mail->CharSet='UTF-8';
    /*  邮件服务器上的账号是什么 */
    $mail->From = config('index_base.email_from');
    $mail->FromName = config('index_base.email_fromName');
    $mail->Host = config('index_base.email_smtp');
    $mail->Username = config('index_base.email_login');
    $mail->Password = config('index_base.email_pass');
    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());
}
