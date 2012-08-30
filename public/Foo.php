<?php
/**
 * Foo class file
 *
 * @license New BSD
 */


/**
 * Sample generated class
 *
 * This is a class generated with Zend_CodeGenerator.
 *
 * @version $Rev:$
 * @license New BSD
 */
class Foo
{

    protected $_bar = 'baz';

    public $baz = 'bat';

    const bat = 'foobarbazbat';

    /**
     * Set the bar property
     *
     * @param string $bar
     * @return string
     */
    public function setBar($bar)
    {
        $this->_bar = $bar;
        return $this;
    }

    /**
     * Retrieve the bar property
     *
     * @return string|null
     */
    public function getBar()
    {
        return $this->_bar;
    }


}

