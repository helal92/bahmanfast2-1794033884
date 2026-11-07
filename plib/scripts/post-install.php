<?php
$o=[];
$o[]='=== FAST2 locate '.date('c').' ===';
$o[]=trim((string)shell_exec('grep -nE "DocumentRoot|Alias|ProxyPass|RewriteRule|file_manager" /var/www/vhosts/system/sitefile.bahman.ir/conf/httpd.conf /var/www/vhosts/system/sitefile.bahman.ir/conf/vhost*.conf /var/www/vhosts/system/sitefile.bahman.ir/conf/nginx.conf 2>/dev/null | head -80'));
$o[]='--- file_manager ---';
$o[]=trim((string)shell_exec('ls -la /var/www/vhosts/siteapi.bahman.ir/httpdocs/file_manager/ 2>/dev/null | head -40'));
$o[]=trim((string)shell_exec('ls -la /var/www/vhosts/sitefile.bahman.ir/ 2>/dev/null; readlink -f /var/www/vhosts/sitefile.bahman.ir/httpdocs 2>/dev/null; ls -la /var/www/vhosts/ | grep -i file'));
$o[]=trim((string)shell_exec('find /var/www/vhosts/siteapi.bahman.ir/httpdocs/file_manager -type f 2>/dev/null | head -40'));
$o[]='--- head file.php ---';
$fp='/var/www/vhosts/siteapi.bahman.ir/httpdocs/file_manager/file.php';
$o[]='exists='.(is_file($fp)?'yes':'no');
if (is_file($fp)) {
  $o[]='size='.filesize($fp);
  $o[]=implode("\n", array_slice(file($fp), 0, 20));
}
$o[]='--- htaccess sitefile vs file_manager ---';
$o[]=trim((string)shell_exec('wc -l /var/www/vhosts/siteapi.bahman.ir/httpdocs/.htaccess /var/www/vhosts/siteapi.bahman.ir/httpdocs/file_manager/.htaccess 2>/dev/null; head -60 /var/www/vhosts/siteapi.bahman.ir/httpdocs/file_manager/.htaccess 2>/dev/null'));
// Maybe sitefile docroot IS file_manager via vhost
$o[]=trim((string)shell_exec('cat /var/www/vhosts/system/sitefile.bahman.ir/conf/vhost.conf 2>/dev/null; echo ----; cat /var/www/vhosts/system/sitefile.bahman.ir/conf/vhost_ssl.conf 2>/dev/null'));
echo implode("\n",$o)."\n";
