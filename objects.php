<?php
class Cart {
    var $items; // Items en nuestro carro de la compra

   // Añadir $num artículos de tipo $artnr al carro
	
   function add_item ($artnr, $num) {
      $this->items[$artnr] += $num;
   }

   // Sacar $num artículos del tipo $artnr del carro

   function remove_item ($artnr, $num) {
      if ($this->items[$artnr] > $num) {
         $this->items[$artnr] -= $num;
         return true;
      } else {
      return false;
      }
   }
} 
class Named_Cart extends Cart {
   var $owner;

   function set_owner ($name) {
      $this->owner = $name;
   }
} 

$ncart = new Named_Cart; // Creamos un carro con nombre
$ncart->set_owner ("kris"); // Nombramos el carro
print $ncart->owner; // Imprimimos el nombre del propietario
$ncart->add_item ("10", 1); // Funcionalidad heredada de Cart


class Auto_Cart extends Cart {
   function Auto_Cart () {
      $this->add_item ("10", 1);
   }
} 

class Constructor_Cart extends Cart {
   function Constructor_Cart ($item = "10", $num = 1) {
      $this->add_item ($item, $num);
   }
}

// Compramos las mismas cosas aburridas de siempre

$default_cart = new Constructor_Cart;

// Compramos las cosas interesantes

//~ $different_cart = new Constructor_Cart ("20", 17); 


?>
