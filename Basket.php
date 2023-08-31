<?php

class Basket {
    private $catalogue = [];
    private $deliveryRules = [];
    private $basketItems = [];

    public function __construct($catalogue, $deliveryRules) {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
    }

    public function add($productCode) {
        if (array_key_exists($productCode, $this->catalogue)) {
            $this->basketItems[] = $productCode;
        } else {
            throw new Exception("Product not found in catalogue.");
        }
    }

    private function calculateDelivery($totalPrice) {
        foreach ($this->deliveryRules as $rule) {
            if ($totalPrice < $rule['limit']) {
                return $rule['charge'];
            }
        }
        return 0;
    }

    public function total() {
        $totalPrice = 0;
        $productCounts = array_count_values($this->basketItems);

        if (isset($productCounts['R01'])) {
            $fullPriceRedWidgets = ceil($productCounts['R01'] / 2);
            $halfPriceRedWidgets = floor($productCounts['R01'] / 2);
            $totalPrice += $fullPriceRedWidgets * $this->catalogue['R01'];
            $totalPrice += $halfPriceRedWidgets * ($this->catalogue['R01'] * 0.5);
        }

        foreach (['B01', 'G01'] as $product) {
            if (isset($productCounts[$product])) {
                $totalPrice += $productCounts[$product] * $this->catalogue[$product];
            }
        }

        $totalPrice += $this->calculateDelivery($totalPrice);

        return number_format($totalPrice, 2, '.', '');
    }
}