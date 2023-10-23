<?php


namespace Woutermenno\Rating\Tags;

use Statamic\Tags\Tags;

class Rating extends Tags {
  /**
  * The {{ rating }} tag.
  *
  * @return string|array
  */
  public function index() {
    return view('rating::rating-stars', [
      'foo' => 'bar',
    ]);
  }

  /**
   * The {{ rating:example }} tag.
   * 
   * @return string|array
   */
   public function example() {
     return "example";
   }

   /**
    * The {{ rating:scripts }} tag.
     */ 
    public function scripts () {
     return view('rating::scripts');
   }


}





// class Rating extends Tags
// {
//   /**
//    * The {{ rating }} tag.
//    *
//    * @return string
//    */
//   public function index()
//   {
//     $rating = $this->params->get('value', 0);
//     $stars = '';

//     for ($i = 1; $i <= 5; $i++) {
//       if ($i <= $rating) {
//         $stars .= '<i class="fas fa-star"></i>';
//       } else {
//         $stars .= '<i class="far fa-star"></i>';
//       }
//     }

//     return $stars;
//   }
// }
