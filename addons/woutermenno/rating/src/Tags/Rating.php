<?php


namespace Woutermenno\Rating\Tags;

use Statamic\Tags\Tags;

class Rating extends Tags {

  private $ip_address;
  private $ip_data;

  public function __construct()
  {

      $this->ip_address = request()->ip();

      // $this->ip_address = '80.40.0.7';

      $api_url = 'http://ip-api.com/json/' . $this->ip_address;
      // get data
      $data_json = file_get_contents($api_url);
      // decode json
      $data = json_decode($data_json);
      //set data
      $this->ip_data = $data;
  }

  /**
  * The {{ rating }} tag.
  *
  * @return string|array
  */
  public function index() {
    return view('rating::rating-stars', [
      'ip_address' => $this->ip_address,
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

