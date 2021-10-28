
# Requirements
  - php 7.4 or newer versions
  - Mcrypt extensions for [php7.4](https://pecl.php.net/package/mcrypt/1.0.3/windows) or other versions
  - Gd2 extension is required


# Login 
- password hashing example `strtoupper(md5('123456'.'|'.$info_user['mem_id']))`