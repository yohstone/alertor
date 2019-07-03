<?php

/**
* alertor.php 报警器
*
* @version    v0.01
* @createtime 2019/07/03
* @updatetime 
* @author     yjl(steve stone)
* @copyright  Copyright (c) yjl(steve stone)
* @info
* 当系统出现问题时，创建邮件对象，通过SMTP服务器发送邮件,实现报警功能
* 
*/

require_once('./smtp.class.php');
require_once('./mail.class.php');

// 设置时区
date_default_timezone_set('PRC');

while(1){
	$proxy_file = '../ProxyPool/ProxyPool/proxyPool.dat';
	$proxy_size = filesize($proxy_file);
	
	// 判断代理池模块是否正常 
	if($proxy_size < 10){ // 以代理池文件大小小于10字节为异常条件
		$warn_info = date('Y-m-d H:i:s '). "代理池小于10字节，可能存在问题，请注意检查！\r\n";
		$mail = new Mail();
		$res  = $mail->sendMail($warn_info);
		file_put_contents('alertor.log', $warn_info. $res, FILE_APPEND); // 保存日志
	}
	break;
	sleep(3600); // 一个小时检查一次
}




?>
