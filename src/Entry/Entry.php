<?php
namespace Trendwerk\AcfForms\Entry;

final class Entry
{
    private $id;
    private $keys = [
        'fieldGroups' => '_fieldGroups',
    ];

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function find($id)
    {
        return new static($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getField($field)
    {
        return get_field($field, $this->id);
    }

    public function getFieldGroups()
    {
        return array_filter((array) get_post_meta($this->id, $this->keys['fieldGroups'], true));
    }

    public function setFieldGroups(array $fieldGroups)
    {
        update_post_meta($this->id, $this->keys['fieldGroups'], $fieldGroups);
    }
}
