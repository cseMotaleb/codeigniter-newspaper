<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-09-10 04:04:57 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-09-10 09:48:51 --> 404 Page Not Found: Humanstxt/index
ERROR - 2020-09-10 09:48:51 --> 404 Page Not Found: Adstxt/index
ERROR - 2020-09-10 10:39:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 10:39:17 --> Unable to connect to the database
ERROR - 2020-09-10 10:39:17 --> Severity: Warning --> mysqli::real_connect(): (HY000/1040): Too many connections /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 10:39:17 --> Unable to connect to the database
ERROR - 2020-09-10 10:39:17 --> Query error: Too many connections - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-10 10:39:17 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-10 11:07:51 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:07:52 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=14803 /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:07:52 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:07:52 --> Unable to connect to the database
ERROR - 2020-09-10 11:07:52 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:07:52 --> Unable to connect to the database
ERROR - 2020-09-10 11:07:52 --> Query error: Connection refused - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-10 11:07:52 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-10 11:07:57 --> Severity: Warning --> mysqli::query(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-09-10 11:08:05 --> Severity: Warning --> mysqli::query(): Error reading result set's header /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-09-10 11:08:05 --> Query error: MySQL server has gone away - Invalid query: SELECT `rh_blog`.*, `rh_users`.`first_name` as `user_first_name`, `rh_users`.`last_name` as `user_last_name`, `rh_users`.`email` as `user_email`
FROM `rh_blog`
LEFT JOIN `rh_users` ON `rh_users`.`id` = `rh_blog`.`user_id`
LEFT JOIN `rh_blog_categories` ON `rh_blog_categories`.`blog_id` = `rh_blog`.`id`
WHERE `rh_blog`.`enabled` = 1
AND `rh_blog_categories`.`parent_id` = '509'
ORDER BY `rh_blog`.`popularity` DESC
 LIMIT 6
ERROR - 2020-09-10 11:08:05 --> Severity: error --> Exception: Call to a member function num_rows() on bool /home/mancitra24/public_html/application/models/blog/Blog_model.php 689
ERROR - 2020-09-10 11:09:21 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:09:42 --> Unable to connect to the database
ERROR - 2020-09-10 11:09:42 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:09:42 --> Unable to connect to the database
ERROR - 2020-09-10 11:09:42 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-10 11:09:42 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-10 11:10:47 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:10:47 --> Unable to connect to the database
ERROR - 2020-09-10 11:10:47 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-10 11:10:47 --> Unable to connect to the database
ERROR - 2020-09-10 11:10:47 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-10 11:10:47 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-10 15:16:09 --> 404 Page Not Found: Wp-content/plugins
ERROR - 2020-09-10 19:56:47 --> 404 Page Not Found: Wp-content/plugins
ERROR - 2020-09-10 21:42:47 --> 404 Page Not Found: Xmlrpcphp/index
ERROR - 2020-09-10 21:42:48 --> 404 Page Not Found: Wordpress/xmlrpc.php
ERROR - 2020-09-10 21:42:48 --> 404 Page Not Found: Blog/xmlrpc.php
ERROR - 2020-09-10 21:42:49 --> 404 Page Not Found: PhpMyAdmin/index.php
ERROR - 2020-09-10 21:42:50 --> 404 Page Not Found: Pma/index.php
ERROR - 2020-09-10 21:42:50 --> 404 Page Not Found: Phpmyadmin/index.php
