<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 24/11/15
 * Time: 18:48
 */

namespace AppBundle\Observer;

/**
 * Class Item
 * @package AppBundle\Observer
 */
class Item implements \SplSubject
{

    private $name;

    private $preco;

    private $observers = array();

    private $content;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param \SplObserver $observer
     */
    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer) {

        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    /**
     * @param $content
     */
    public function promocao($content) {
        $this->content = $content;
        $this->notify();
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content." ({$this->name})";
    }

    /**
     * @return \SplStack
     */
    public function notify() {
        $pilhaNotificacoes = new \SplStack();

        foreach ($this->observers as $value) {
            $pilhaNotificacoes->push($value->update($this));
        }
        return $pilhaNotificacoes;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @return array
     */
    public function getObservers()
    {
        return $this->observers;
    }

    /**
     * @param array $observers
     */
    public function setObservers($observers)
    {
        $this->observers = $observers;
    }

}