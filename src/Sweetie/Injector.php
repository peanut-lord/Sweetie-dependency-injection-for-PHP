<?php
// +----------------------------------------------------------+
// | Sweetie Dependency Injection 2012                        |
// +----------------------------------------------------------+

namespace Sweetie;
use Sweetie\Binder;

/**
 * Responsible to inject the according classes into the properties of the class
 *
 * @author Christopher Marchfelder <marchfelder@googlemail.com>
 * @license MIT
 */
abstract class Injector
{

    /**
     * The Binder of Sweetie
     *
     * @var Sweetie\Binder
     */
    protected $_binder = null;

    /**
     * A stack for object ids
     *
     * @var array
     */
    private $_idStack = array();

    /**
     * Generates the injector
     *
     * @param Sweetie\Binder $binder
     *
     * @return void
     */
    public function __construct(Binder $binder)
    {
        $this->_binder = $binder;
    }

    /**
     * Returns if the given ref-string is actual a ID
     *
     * @param string $id
     *
     * @return bool
     */
    protected function _isIDReference($id)
    {
        $pos = strpos($id, '@id:');
        return $pos !== false && $pos === 0;
    }

    /**
     * Returns only the class from an ID reference
     *
     * @param string $id
     *
     * @return string
     */
    protected function _getIDFromReference($id)
    {
        return substr($id, 4);
    }

    /**
     * Returns the binder of Sweetie
     *
     * @return Binder
     */
    protected function _getBinder()
    {
        return $this->_binder;
    }

    /**
     * Pushes an ID into the stack
     *
     * @param string $id
     *
     * @return void
     */
    protected function _pushToIDStack($id)
    {
        $this->_idStack[] = $id;
    }

    /**
     * Pops from the stack
     *
     * @param string $id
     *
     * @return string
     */
    protected function _popFromIDStack($id)
    {
        $item = array_pop($this->_idStack);
        return $item;
    }

    /**
     * Returns if a certain was found inside the stack
     *
     * @param string $id
     *
     * @return bool
     */
    protected function _stackContainsID($id)
    {
        return array_search($id, $this->_idStack) !== false;
    }

    /**
     * Clears the stack
     *
     * @return void
     */
    protected function _clearIDStack()
    {
        $this->_idStack = array();
    }

    /**
     * Takes a ClassBindings object and injects the references
     * into all properties
     *
     * @param ClassBindings $bindings
     *
     * @return object
     */
    public abstract function inject(ClassBindings $bindings);

}