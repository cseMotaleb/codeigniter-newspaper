<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-28 00:03:36 --> 404 Page Not Found: Test/wp-login.php
ERROR - 2020-08-28 05:02:22 --> 404 Page Not Found: Test/wp-login.php
ERROR - 2020-08-28 05:26:00 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-08-28 07:04:59 --> 404 Page Not Found: Blog/wp-login.php
ERROR - 2020-08-28 10:10:17 --> 404 Page Not Found: Blog/wp-login.php
ERROR - 2020-08-28 14:54:09 --> 404 Page Not Found: Adminer-351php/index
ERROR - 2020-08-28 19:30:48 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-08-28 19:52:23 --> Severity: Warning --> mysqli::query(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-08-28 19:53:21 --> Severity: Warning --> mysqli::query(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-08-28 19:53:21 --> Severity: Warning --> mysqli::query(): Error reading result set's header /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-08-28 19:53:21 --> Severity: Warning --> mysqli::query(): Error reading result set's header /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-08-28 19:53:21 --> Query error: MySQL server has gone away - Invalid query: SELECT `rh_blog`.*, `rh_users`.`first_name` as `user_first_name`, `rh_users`.`last_name` as `user_last_name`, `rh_users`.`email` as `user_email`
FROM `rh_blog`
LEFT JOIN `rh_users` ON `rh_users`.`id` = `rh_blog`.`user_id`
LEFT JOIN `rh_blog_categories` ON `rh_blog_categories`.`blog_id` = `rh_blog`.`id`
WHERE `rh_blog`.`enabled` = 1
AND `rh_blog_categories`.`parent_id` = '509'
ORDER BY `rh_blog`.`popularity` DESC
 LIMIT 6
ERROR - 2020-08-28 19:53:21 --> Query error: MySQL server has gone away - Invalid query: SELECT `rh_blog`.*, `rh_users`.`first_name` as `user_first_name`, `rh_users`.`last_name` as `user_last_name`, `rh_users`.`email` as `user_email`
FROM `rh_blog`
LEFT JOIN `rh_users` ON `rh_users`.`id` = `rh_blog`.`user_id`
LEFT JOIN `rh_blog_categories` ON `rh_blog_categories`.`blog_id` = `rh_blog`.`id`
WHERE `rh_blog`.`enabled` = 1
AND `rh_blog_categories`.`parent_id` = '509'
ORDER BY `rh_blog`.`popularity` DESC
 LIMIT 6
ERROR - 2020-08-28 19:53:21 --> Severity: error --> Exception: Call to a member function num_rows() on bool /home/mancitra24/public_html/application/models/blog/Blog_model.php 689
ERROR - 2020-08-28 19:53:21 --> Severity: error --> Exception: Call to a member function num_rows() on bool /home/mancitra24/public_html/application/models/blog/Blog_model.php 689
ERROR - 2020-08-28 19:55:40 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-08-28 19:55:46 --> Unable to connect to the database
ERROR - 2020-08-28 19:55:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-08-28 19:55:46 --> Unable to connect to the database
ERROR - 2020-08-28 19:55:46 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-08-28 19:55:46 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-08-28 19:55:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-08-28 19:55:46 --> Unable to connect to the database
ERROR - 2020-08-28 19:55:46 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-08-28 19:55:46 --> Unable to connect to the database
ERROR - 2020-08-28 19:55:46 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-08-28 19:55:46 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-08-28 22:34:19 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-08-28 23:28:50 --> 404 Page Not Found: Wp-loginphp/index
