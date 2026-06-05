<?php declare(strict_types=1);

use Ngomafortuna\Validate\Validate;
use PHPUnit\Framework\TestCase;

final class ValidateTest extends TestCase
{
    private Validate $validator;
    private array $data;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'full_name' => 'Rosa Fortuna <?php echo 123; ?>',
            'email' => 'rosa.fortuna@mtec.ao',
            'url' => 'https://www.mtec.ao',
            'url2' => 'http://www.mtec.ao',
            'invalid_email' => 'rosa@invalido@dominio.com',
            'invalid_url' => 'htp:/mtec',
            'description' => 'Your description - Sua descrição',
            'script' => '<?php echo 123; ?>',
            'edge' => 24,
            'edge_invalid' => '24 anos',
            'receive_newsletter' => 'on',
            'receive_newsletter_invalid' => 'talvez',
            'genre' => 'F'
        ];

        $this->validator = new Validate();
    }

    public function test_validate_string(): void
    {
        $result = $this->validator->get([
            'description' => 's'
        ], $this->data);

        $this->assertEquals($this->data, $result);
    }

    public function test_validate_string_with_special_chars(): void
    {
        $result = $this->validator->get([
            'full_name' => 's'
        ], $this->data);

        $this->data['full_name'] = 'Rosa Fortuna &#60;?php echo 123; ?&#62;';

        $this->assertEquals($this->data, $result);
    }

    public function test_validate_int(): void
    {
        $result = $this->validator->get([
            'edge' => 'i'
        ], $this->data);

        $this->assertEquals($this->data, $result);
    }

    public function test_validate_email(): void
    {
        $result = $this->validator->get([
            'email' => 'e'
        ], $this->data);

        $this->assertEquals($this->data, $result);
    }

    public function test_validate_url(): void
    {
        $result = $this->validator->get([
            'url' => 'u'
        ], $this->data);

        $this->assertEquals($this->data, $result);
    }

    public function test_validate_email_invalid_returns_null(): void
    {
        $result = $this->validator->get([
            'invalid_email' => 'e'
        ], $this->data);

        $expected = $this->data;
        $expected['invalid_email'] = null;

        $this->assertEquals($expected, $result);
    }

    public function test_validate_url_invalid_returns_null(): void
    {
        $result = $this->validator->get([
            'invalid_url' => 'u'
        ], $this->data);

        $expected = $this->data;
        $expected['invalid_url'] = null;

        $this->assertEquals($expected, $result);
    }

    public function test_validate_integer_invalid_returns_null(): void
    {
        $result = $this->validator->get([
            'edge_invalid' => 'i'
        ], $this->data);

        $expected = $this->data;
        $expected['edge_invalid'] = null;

        $this->assertEquals($expected, $result);
    }

    public function test_validate_boolean_returns_one_for_true_values(): void
    {
        $result = $this->validator->get([
            'receive_newsletter' => 'b'
        ], $this->data);

        $expected = $this->data;
        $expected['receive_newsletter'] = 1;

        $this->assertEquals($expected, $result);
    }

    public function test_validate_boolean_invalid_returns_null(): void
    {
        $result = $this->validator->get([
            'receive_newsletter_invalid' => 'b'
        ], $this->data);

        $expected = $this->data;
        $expected['receive_newsletter_invalid'] = null;

        $this->assertEquals($expected, $result);
    }
}