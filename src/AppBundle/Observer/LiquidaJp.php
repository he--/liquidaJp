<?php
/**
 * Created by PhpStorm.
 * User: helio
 * Date: 24/11/15
 * Time: 19:03
 */

namespace AppBundle\Observer;

class LiquidaJp
{
    /**
     * @var \SplQueue
     *
     */
    private $filaDeclientes;

    /**
     * @var \SplFixedArray
     */
    private $listaDeItens;

    /**
     *
     */
    public function __construct()
    {
        $this->filaDeclientes  = new \SplQueue();
        $this->listaDeItens    = new \SplFixedArray(3);
    }

    /**
     * @return \SplQueue
     */
    public function getFilaDeclientes()
    {
        return $this->filaDeclientes;
    }

    /**
     * @param \SplQueue $filaDeclientes
     */
    public function setFilaDeclientes($filaDeclientes)
    {
        $this->filaDeclientes = $filaDeclientes;
    }

    /**
     * @return \SplFixedArray
     */
    public function getListaDeItens()
    {
        return $this->listaDeItens;
    }

    /**
     * @param \SplFixedArray $listaDeItens
     */
    public function setListaDeItens($listaDeItens)
    {
        $this->listaDeItens = $listaDeItens;
    }

    /**
     * @param \SplObserver $cliente
     */
    public function setCliente(\SplObserver $cliente)
    {
        $this->filaDeclientes->add($cliente);

    }

    /**
     * @param \SplSubject $item
     */
    public function setItem(\SplSubject $item)
    {
        $this->listaDeItens[] = $item;
    }

    /**
     *
     */
    public function teste()
    {
        $helio = new Cliente("Helio Cardoso");
        $item1 = new Item("Televisão de 42 polegadas");

        $joao = new Cliente("Joao e Maria");
        $item2 = new Item("Tenis Rainha");

        $pedro = new Cliente("Pedro da Boleai");
        $item3 = new Item("Capsulana de bike");

        $item1->attach($helio);
        $item1->attach($joao);
        $item1->attach($pedro);
        $item1->promocao("Olha a black friday");

        $item2->attach($helio);
        $item2->attach($joao);
        $item3->promocao("Olha a black friday");

        $item3->attach($helio);
        $item3->attach($joao);
        $item3->promocao("Olha a black friday");

        $this->listaDeItens[0] = $item1;
        $this->listaDeItens[1] = $item2;
        $this->listaDeItens[2] = $item3;
    }

    /**
     * @return \SplStack
     */
    public function getNotificacoes()
    {
        $notificacoes = new \SplStack();
        for ($i = 0 ; $i < $this->listaDeItens->count() ; $i++) {
            $notificacoes->push($this->listaDeItens[$i]->notify());
        }
        return $notificacoes;
    }
}
