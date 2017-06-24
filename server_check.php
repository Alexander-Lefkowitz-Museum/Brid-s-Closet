<?php
/*
  Copyright 2003 - 2007 Chain Reaction Ecommerce, Inc.
  Released under the GNU General Public License Version 2
  CRE Loaded, Chain Reaction Works, and all logos are trademarks of Chain Reaction Ecommerce, Inc.  all rights reserved.
*/
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="LTR" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>CRE Loaded Server Check</title>
</head>
<body>
<?php
  define('TEXT_FAILED', 'Failed');
  define('TEXT_SUCCESS', 'Success');
  define('TEXT_ON', 'On');
  define('TEXT_OFF', 'Off');
  define('TEXT_REQUIRED', 'Required Functions');
  define('TEXT_PAYMENT', 'Required for Paymnet handling');
  define('TEXT_RECOMMEND', 'Recommend for full functionality');
  define('TEXT_CONFIG', 'Configuration Options<br />Maybe set using .htaccess or php.ini');
  function checkINI($option) {
    $value = strtolower( trim( ini_get( $option ) ) );
      
    if ( $value == 'on' ) $value = TEXT_ON;
    elseif ( $value == 'off' )  $value = TEXT_OFF;
    elseif ( $value == '1' )  $value = TEXT_ON;
    elseif ( $value == '0' ) $value = TEXT_OFF;
    else $value = TEXT_OFF;
      
    return $value;
  }
?>
  <div align="center">
    <h2>CRE Loaded Server Configuration Check</h2>
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="2" cellspacing="2" cellpadding="3">
          <tr>
            <th colspan="2"><?php echo TEXT_REQUIRED; ?></th>
          </tr>
          <tr>
            <td><a href="http://www.php.net/downloads.php" target="php">PHP >= 4.3.1</a></td>
            <td align="left">
              <?php echo ( phpversion() < '4.3.3' ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.mysql.php" target="php">PHP MySQL</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('mysql') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
<?php
  if ( phpversion() > '5.0' ) {
?>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.mysqli.php" target="php">PHP MySQLi</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('mysqli') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
<?php
  }
?>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.pcre.php" target="php">PHP PCRE</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('pcre') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.zlib.php" target="php">PHP ZLIB</a></td>
            <td align="left">
              <?php echo ( !function_exists( 'gzencode' ) ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.curl.php" target="php">PHP cURL</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('curl') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.image.php" target="php">PHP GD</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('gd') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="2" cellspacing="2" cellpadding="2">
          <tr>
            <th colspan="2"><?php echo TEXT_PAYMENT; ?></th>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.mcrypt.php" target="php">PHP Mcrypt</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('mcrypt') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.openssl.php" target="php">PHP OPENSSL</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('openssl') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="2" cellspacing="2" cellpadding="3">
          <tr>
            <th colspan="2"><?php echo TEXT_RECOMMEND; ?></th>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.exif.php" target="php">PHP EXIF</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('exif') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td><a href="http://www.php.net/manual/en/ref.ftp.php" target="php">PHP FTP</a></td>
            <td align="left">
              <?php echo ( !extension_loaded('ftp') ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><table border="2" cellspacing="2" cellpadding="3">
          <tr>
            <th colspan="3"><?php echo TEXT_CONFIG; ?></th>
          </tr>
          <tr>
            <td>register_globals</td>
            <td><?php echo ($ini_setting = checkINI('register_globals')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting != 'On'  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td>safe_mode</td>
            <td><?php echo ($ini_setting = checkINI('safe_mode')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting == TEXT_ON  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td>file_uploads</td>
            <td><?php echo ($ini_setting = checkINI('file_uploads')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting != TEXT_ON  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td>session.auto_start</td>
            <td><?php echo ($ini_setting = checkINI('session.auto_start')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting == TEXT_ON  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td>magic_quotes</td>
            <td><?php echo ($ini_setting = checkINI('magic_quotes')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting == TEXT_ON  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
          <tr>
            <td>allow_url_fopen</td>
            <td><?php echo ($ini_setting = checkINI('allow_url_fopen')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting != TEXT_ON  ) ? TEXT_FAILED : TEXT_SUCCESS; ?>
            </td>
          </tr>
<?php
  if ( phpversion() > '5.0' ) {
?>
          <tr>
            <td>register_long_arrays </td>
            <td><?php echo ($ini_setting = checkINI('register_long_arrays')); ?></td>
            <td align="left">
              <?php echo ( $ini_setting == TEXT_ON  ) ? TEXT_SUCCESS : TEXT_FAILED; ?>
            </td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>    
    </table>
  </div>
</body>
</html>