<?php


namespace Drupal\weatherapp;

/**
 * Class WeatherApi.
 *
 * @package Drupal\weatherapp
 */
class WeatherApi {

  /**
   * @param $city
   * @return \Psr\Http\Message\StreamInterface
   * @throws \GuzzleHttp\Exception\GuzzleException
   * todo DI is to be implemented
   */
  public function weatherapi($city) {
    $config = \Drupal::config('weatherapp.settings');
    $data = $config->get('AppID');
    $client = \Drupal::httpClient();
    $val = $client
      ->request('GET', 'https://samples.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $data);
    return $val->getBody();

  }

  public function roundoff($request){
    foreach ($request['main'] as $key=>$items){

      if(is_float($items)){
        $request['main'][$key] = round($items);
      }

    }
   return $request;

  }

}
