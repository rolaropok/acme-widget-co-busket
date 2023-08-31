# Acme Widget Co Sales System

This PHP-based sales system has been designed for Acme Widget Co to calculate the total costs for a shopping basket. The system takes into account product prices, delivery charges, and special offers.

## Table of Contents

- [Setup](#setup)
- [Usage](#usage)
- [Code Example](#code-example)
- [Special Offers](#special-offers)
- [Assumptions](#assumptions)
- [Contribution](#contribution)
- [License](#license)

## Setup

### 1. Include the Class

Before using the sales system, make sure to include the `Basket.php` class in your project.

### 2. Initialize the Basket

Create an instance of the `Basket` class. You'll need to provide it with a product catalogue and delivery charge rules.

## Usage

### Adding Products

Use the product codes to add items to your basket:

    $basket->add('R01');

### Getting the Total

To retrieve the total cost of the basket, which includes the product prices, delivery costs, and any applicable offers:

    echo $basket->total();

## Code Example

Here's a practical example of using the sales system:

    include 'Basket.php';

    $catalogue = [
        'R01' => 32.95,
        'G01' => 24.95,
        'B01' => 7.95
    ];

    $deliveryRules = [
        ['limit' => 50, 'charge' => 4.95],
        ['limit' => 90, 'charge' => 2.95],
        ['limit' => PHP_INT_MAX, 'charge' => 0]
    ];

    $basket = new Basket($catalogue, $deliveryRules);
    $basket->add('R01');
    $basket->add('R01');
    
    echo $basket->total();  // Expected output: $54.37

## Special Offers

Currently, the system supports the following special offer:

- **Red Widget Offer**: When you buy one red widget (R01), you'll get the second at half price.

## Assumptions

- The system is pre-configured with the red widget special offer.
- Delivery rules should be provided in ascending order of the order amount. The system will apply the first matching rule.
- Only products listed in the catalogue can be added to the basket.
- The code has been modularly designed, making it simple to add future extensions, including new offers or rules.

## Contribution

Contributions are welcome! Please fork the repository and open a pull request with your changes or send us any suggestions or feedback.

## License

This project is licensed under the MIT License.
