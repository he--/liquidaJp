<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 24/11/15
 * Time: 18:53
 */

namespace AppBundle\Observer;

class Cliente implements \SplObserver
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $telefone;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param \SplSubject $subject
     * @return string
     */
    public function update(\SplSubject $subject)
    {
        return $this->name.' '.$subject->getContent();
    }
}
