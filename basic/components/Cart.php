<?php

namespace app\components;

use Yii;
use yii\base\Component;

class Cart extends Component
{
    public function getItems()
    {
        return Yii::$app->session->get('cart', []);
    }

    public function addItem($item)
    {
        $items = $this->getItems();
        $items[] = $item;
        Yii::$app->session->set('cart', $items);
    }

    public function clear()
    {
        Yii::$app->session->remove('cart');
    }

    public function getTotal()
    {
        $items = $this->getItems();
        $total = 0;
        foreach ($items as $item) {
            if (isset($item['cena']) && isset($item['quantity'])) {
                $total += $item['cena'] * $item['quantity'];
            } else {
                // Handle the case where 'cena' or 'quantity' is missing
                Yii::error("Item missing 'cena' or 'quantity': " . print_r($item, true));
            }
        }
        return $total;
    }
}
