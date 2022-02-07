<?php
class Utils
{
  public static function generateSlug($value)
  {
    $string = preg_replace("/['’]/", ' ', $value);
    $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
    $string = preg_replace('/[-\s]+/', '-', $string);
    return trim($string, '-');
  }

  public static function message($return, $returnSuccess, $returnFail)
  {
    if ($return > 0) {
      $_SESSION['message']['success'][] = $returnSuccess;
    } else
      $_SESSION['message']['fail'][] = $returnFail;
  }

  public static function upload($index, $destination, $maxsize = FALSE, $arrayExtensionAvailable = FALSE)
  {
    if (!isset($_FILES[$index]) or $_FILES[$index]['error'] > 0) return FALSE;
    if ($maxsize !== FALSE and $_FILES[$index]['size'] > $maxsize) return FALSE;
    $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
    if ($arrayExtensionAvailable !== FALSE and !in_array($ext, $arrayExtensionAvailable))
      return FALSE;
    return move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
  }

  public static function minName($name)
  {
    $temp = strtoupper($name);
    $name_small = substr($temp, 0, 2);
    return $name_small;
  }

  public static function dateToFrench($date, $format)
  {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
  }

  public static function showStars($rating)
  {
    $nb_stars = 5;
    $rating = $rating / 2;
    $return = '';
    for ($i = 0; $i < $nb_stars; $i++) {
      if ($rating > $i + 0.25 && $rating < $i + 0.76) {
        $return .= '<i class="fas fa-star-half-alt"></i>';
      } elseif ($rating > $i) {
        $return .= '<i class="fas fa-star"></i>';
      } else {
        $return .= '<i class="far fa-star"></i>';
      }
    };
    return $return;
  }

  public static function convertMinToHours($Time)
  {
    if ($Time < 60) {
      $heures = 0;
    } else {
      $heures = round($Time / 60);
    }
    $minutes = floor($Time % 60);
    $TimeFinal = $heures . 'h' . $minutes . 'min';
    return $TimeFinal;
  }

  public static function searchTMDB($url)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    $return = json_decode($response);
    return $return;
    curl_close($curl);
  }
}
