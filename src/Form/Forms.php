<?php
namespace Trendwerk\AcfForms\Form;

use BadMethodCallException;
use InvalidArgumentException;

final class Forms
{
    private static $instance;

    private $forms;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function add($name, array $options)
    {
        if (strlen($name) === 0) {
            throw new BadMethodCallException('Form name should be at least one character long.');
        }

        if (! isset($options['acfForm']) || ! isset($options['acfForm']['field_groups'])) {
            throw new BadMethodCallException('acfForm[field_groups] is a required property.');
        }

        $this->forms[$name] = $options;
    }

    public function get($name)
    {
        if (! isset($this->forms[$name])) {
            throw new InvalidArgumentException(sprintf('Requested form \'%s\' is not registered.', $name));
        }

        return $this->forms[$name];
    }
}
