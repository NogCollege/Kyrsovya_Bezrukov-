<?php

// models/Cart.php

namespace app\models;

use Yii;
use yii\base\Model;

class Cart extends Model
{
    public $items = [];

    public function addItem($texno)
    {
        $id = $texno['id'];
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity']++;
        } else {
            // Check if 'img_url' key exists before accessing it

            $this->items[$id] = [
                'id' => $texno['id'],
                'nazvan' => $texno['nazvan'],
                'cena' => $texno['cena'],
                'quantity' => 1,
            ];
        }
    }


    public function removeItem($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    public function updateItem($id, $quantity)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['cena'] * $item['quantity'];
        }
        return $total;
    }
}
