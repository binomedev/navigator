<?php

namespace Binomedev\Navigator;


use Illuminate\Support\Traits\Macroable;

class Navigator
{
    use Macroable;

    /**
     * @var array
     */
    private $menus = [];

    /**
     * @param string $name
     * @param array|NavItem $item
     * @return $this
     */
    public function menu(string $name, $item): Navigator
    {
        if (is_array($item)) {
            $menus[$name] = $item;
            return $this;
        }

        $menus[$name][] = $item;
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasItems(string $name): bool
    {
        return $this->count($name) > 0;
    }

    /**
     * @param string $name
     * @return int
     */
    public function count(string $name): int
    {
        return count($this->get($name));
    }

    /**
     * @param string $name
     * @param array $default
     * @return array|mixed
     */
    public function get(string $name, $default = []): array
    {
        if ($this->has($name)) {
            return $this->menus[$name];
        }

        return $default;
    }

    public function all()
    {
        return $this->menus;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->menus);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isEmpty(string $name): bool
    {
        return $this->count($name) === 0;
    }
}
