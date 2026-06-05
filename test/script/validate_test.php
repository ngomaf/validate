<?php

// Test path (caminha ou url para teste)
// http://your-url/test/validateTest.php

require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use Ngomafortuna\Validate\Validate;

$validate = new Validate;

$data = [
    'full_name' => 'Rosa Fortuna <?php echo 123; ?>',
    'description' => 'Your description - Sua descrição',
    'script' => '<?php echo 123; ?>',
    'edge' => 24,
    'genre' => 'F'
];

$cleanDate = $validate->get([
    'full_name' => 's',
    'description' => 's',
    'script' => '*',
    'edge' => 'i',
    'genre' => 's'
], $data);

var_dump($cleanDate);

/**
 * array(5) {
 *  ["full_name"]=>
 *  string(39) "Rosa Fortuna &#60;?php echo 123; ?&#62;"
 *  ["description"]=>
 *  string(34) "Your description - Sua descrição"
 *  ["script"]=>
 *  string(18) "<?php echo 123; ?>"
 *  ["edge"]=>
 *  int(24)
 *  ["genre"]=>
 *  string(1) "F"
 *}
 */