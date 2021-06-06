<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-09-04 01:51:30 --> 404 Page Not Found: Wp-content/plugins
ERROR - 2020-09-04 05:08:07 --> Severity: Warning --> Empty row packet body /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-09-04 05:08:07 --> Severity: Warning --> mysqli::query(): (00000/0):  /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 307
ERROR - 2020-09-04 05:08:08 --> Query error:  - Invalid query: SELECT `rh_blog`.*, `rh_users`.`first_name` as `user_first_name`, `rh_users`.`last_name` as `user_last_name`, `rh_users`.`email` as `user_email`
FROM `rh_blog`
LEFT JOIN `rh_users` ON `rh_users`.`id` = `rh_blog`.`user_id`
WHERE `rh_blog`.`title` LIKE '%প্রমিত উচ্চারণ, আবৃত্তি,অনুষ্ঠান ঘোষণা ,উপস্থাপনা ও সংবাদ উপস্থাপনা বিষয়ক কর্মশালা%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%প্রমিত%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%প্রমিত%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%উচ্চারণ,%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%উচ্চারণ,%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%আবৃত্তি,অনুষ্ঠান%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%আবৃত্তি,অনুষ্ঠান%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%ঘোষণা%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%ঘোষণা%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%,উপস্থাপনা%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%,উপস্থাপনা%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%ও%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%ও%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%সংবাদ%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%সংবাদ%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%উপস্থাপনা%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%উপস্থাপনা%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%বিষয়ক%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%বিষয়ক%' ESCAPE '!'
OR  `rh_blog`.`title` LIKE '%কর্মশালা%' ESCAPE '!'
OR  `rh_blog`.`details` LIKE '%কর্মশালা%' ESCAPE '!'
AND `rh_blog`.`enabled` = 1
ORDER BY `rh_blog`.`id` DESC
 LIMIT 9
ERROR - 2020-09-04 05:08:08 --> Severity: error --> Exception: Call to a member function num_rows() on bool /home/mancitra24/public_html/application/models/blog/Blog_model.php 655
ERROR - 2020-09-04 05:10:32 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:10:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:10:33 --> Unable to connect to the database
ERROR - 2020-09-04 05:10:33 --> Unable to connect to the database
ERROR - 2020-09-04 05:10:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:10:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:10:33 --> Unable to connect to the database
ERROR - 2020-09-04 05:10:33 --> Unable to connect to the database
ERROR - 2020-09-04 05:10:33 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 05:10:33 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 05:10:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 05:10:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 05:21:24 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:21:24 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=2192 /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:21:24 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:21:24 --> Unable to connect to the database
ERROR - 2020-09-04 05:21:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): Connection refused /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:21:27 --> Unable to connect to the database
ERROR - 2020-09-04 05:21:27 --> Query error: Connection refused - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 05:21:27 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 05:23:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:23:03 --> Unable to connect to the database
ERROR - 2020-09-04 05:23:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 05:23:03 --> Unable to connect to the database
ERROR - 2020-09-04 05:23:03 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 05:23:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 08:35:23 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:35:23 --> Unable to connect to the database
ERROR - 2020-09-04 08:35:23 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:35:23 --> Unable to connect to the database
ERROR - 2020-09-04 08:35:23 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 08:35:23 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 08:35:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:35:33 --> Unable to connect to the database
ERROR - 2020-09-04 08:35:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:35:33 --> Unable to connect to the database
ERROR - 2020-09-04 08:35:33 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 08:35:33 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
ERROR - 2020-09-04 08:37:03 --> Severity: Warning --> mysqli::real_connect(): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:37:03 --> Severity: Warning --> mysqli::real_connect(): Error while reading greeting packet. PID=20366 /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:37:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2006): MySQL server has gone away /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:37:03 --> Unable to connect to the database
ERROR - 2020-09-04 08:37:03 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/mancitra24/public_html/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2020-09-04 08:37:03 --> Unable to connect to the database
ERROR - 2020-09-04 08:37:03 --> Query error: No such file or directory - Invalid query: SELECT *
FROM `rh_routes`
ERROR - 2020-09-04 08:37:03 --> Severity: error --> Exception: Call to a member function result() on bool /home/mancitra24/public_html/application/config/routes.php 75
