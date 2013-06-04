MySQLHandler 1.1
=============================

A complete MySQL package for PHP. Includes all MySQL methods you need for your PHP project.

* Connection handling
* Results available as XML, dictionary or default Result Set
* Error handling
* Full interface for optional custom extensions
 
## Changelog
### Version 1.1
* Minor bugfixes and example

### Version 1.0
* Initial release
 
## Usage
Edit the configuration in `Database.class.php`

```php
  private $server   = 'localhost';
  private $database = 'test';
  private $username = 'user';
  private $password = 'password';
  private $use_permanent_connection = false;
  private $xml_encoding = 'ISO-8859-1';
```
See example in `example.php` on how to use the methods.
