<?php


namespace Binomedev\Navigator;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Traits\Macroable;

class NavItem implements Arrayable
{
    use Macroable;

    protected $name;
    protected $url;
    protected $isActive = false;
    protected $children = [];
    protected $isDivider;
    protected $isVisible = true;
    protected $icon;
    protected $id;
    protected $routeName;

    /**
     * NavItem constructor.
     * @param string $name
     * @param string|Closure $url
     * @param string|null $icon
     */
    public function __construct(string $name, $url = '#', string $icon = null)
    {
        $this->name = $name;
        $this->id = strtolower(str_replace(' ', '-', $name));
        $this->url = $url;
        $this->icon = $icon;
        $this->setActiveState($url);
    }

    protected function setActiveState($url)
    {
        if ($url === '#') {
            $this->isActive = $this->hasAnyActiveChild();
        } else {
            $this->isActive = $this->routeName
                ? request()->routeIs($this->routeName)
                : request()->fullUrlIs(trim($url, '/'));
        }
    }

    public function hasAnyActiveChild(): bool
    {
        // Check if any child is active
        if (! $this->hasChildren()) {
            return false;
        }

        foreach ($this->children as $child) {
            if ($child->isActive()) {
                return true;
            }
        }

        return false;
    }

    public function hasChildren(): bool
    {
        return ! empty($this->children);
    }

    /**
     * NavItem constructor.
     * @param string $name
     * @param string|Closure $url
     * @param string|null $icon
     * @return NavItem
     */
    public static function make(...$args): NavItem
    {
        return new static(...$args);
    }

    public static function route($name, $route, $params = []): NavItem
    {
        $instance = new static($name, route($route, $params));
        $instance->routeName = $route;

        return $instance;
    }

    public static function divider(): NavItem
    {
        $item = new self(null);
        $item->asDivider();

        return $item;
    }

    public function asDivider(): NavItem
    {
        $this->isDivider = true;

        return $this;
    }

    public function hasIcon(): bool
    {
        return ! is_null($this->icon);
    }

    public function setVisible($state = true): NavItem
    {
        $this->isVisible = $state;

        return $this;
    }

    /**
     * Add a child nav item
     *
     * Closure must return an array.
     * A request instance is passed as an argument to the closure.
     * Closure and Array parameter will be merged with the current children array
     *
     * @param NavItem|Closure|array $item
     * @return $this
     */
    public function add($items): NavItem
    {
        if (is_array($items)) {
            $this->children = array_merge($this->children, $items);

            return $this;
        }

        if ($items instanceof Closure) {
            $this->add(
                (array) $items(request())
            );

            return $this;
        }

        $this->children[] = $items;
        if ($items->isActive()) {
            $this->isActive = true;
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'routeName' => $this->routeName(),
            'url' => $this->url(),
            'icon' => $this->icon(),
            'isActive' => $this->isActive(),
            'hasActiveChild' => $this->hasAnyActiveChild(),
            'isDivider' => $this->isDivider(),
            'isVisible' => $this->isVisible(),
            'children' => $this->children(),
        ];
    }

    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return value($this->name);
    }

    public function routeName()
    {
        return $this->routeName;
    }

    /**
     * @return mixed
     */
    public function url(): string
    {
        if ($this->url === '#') {
            return 'javascript:;';
        }

        return value($this->url);
    }

    public function icon($icon = null): ?NavItem
    {
        if (is_null($icon)) {
            return $this->icon;
        }

        $this->icon = $icon;

        return $this;
    }

    /**
     * @param string|null $class
     * @return bool|mixed|null
     */
    public function isActive($class = null)
    {
        if (is_null($class)) {
            return $this->isActive;
        }

        return $this->isActive ? $class : null;
    }

    public function isDivider()
    {
        return $this->isDivider;
    }

    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    public function children(): array
    {
        return $this->children;
    }
}
