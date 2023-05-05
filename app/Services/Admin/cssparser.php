<?php

namespace App\Services\Admin;

/*

|  # Usage

|  include('cssparser.php');

|  $cssparser = new CSSParser();

|  $css = file_get_contents('./data.css');

|  $index = $cssparser->ParseCSS($css);

|  $output = $cssparser->GetCSS($index);

|  header('Content-Type: text/css');

|  echo $output;

|  

|  public function ParseCSS($css)

|

|     Parse the given text as css.

|

|     This function returns an numeric index that can be used to address this code in the other functions. This also means that it is possible to parse different css data independently.

|  public function ParseCSSAppend($index, $css)

|

|     This function parses and appends the the given css data to the specified index.

|  public function ParseCSSMediaAppend($index, $css, $media)

|

|     Almost the same as ParseCSSAppend but here you can specify which type of media this code should be parsed as.

|  public function AddProperty($index, $media, $section, $property, $value)

|

|     Adds a property and value to a given section and specified media for the index.

|

|     Confusing? :-) Let me show a simple example. `css @media screen { body { background: #ffffff; } } ` Is the same as writing this code `php // Assume that we have an index in the variable $index $cssparser->AddProperty($index, 'screen', 'body', 'background', '#ffffff'); ` And it will be interpreted as the following array with its var_dump `php $css = array('screen'=>array('body'=>array('background'=>'#ffffff'))); var_dump($css); // array(1) { // ["screen"]=> // array(1) { // ["body"]=> // array(1) { // ["background"]=> // string(7) "#ffffff" // } // } // } `

|  public function GetMediaList($index)

|

|     Get all defined media types parsed for the given index. By default there is three media types defined. screen, print and all.

|  public function ExportKeyValues($index, $media, $keys)

|

|     Export all values for the given keys (or key, if only a string is supplied) in the given media for the given index. This function only return an array with the values.

|  public function ExportMedia($index, $media, $block = false)

|

|     Gets the css data for a given index and media. If $block is assigned a string then this is used as an regexp value where all matching values are excluded.

|  public function ExportStyle($index, $block = false)

|

|     Gets the css data for a given index. If $block is assigned a string then this is used as an regexp value where all matching values are excluded.

|  public function GetSections($index, $media = 'screen')

|

|     Get all sections for the given index and media.

|

|     Sections is equal to selector.

|  public function GetSectionsFiltered($index, $matchKey, $matchValue, $media = 'screen')

|

|     Get alls sections which have a property/value pair that matches $matchKey and $matchValue.

|

|     If a property/value pair if found then the entire section (selector) is added to the output.

|

|     The result is given as an array.

|  public function GetEditorCSS($index)

|

|     Get the css code for the given index. This is the same as calling: `php $cssparser->GetCSS($index, 'screen', array('^filter$')); `

|  public function GetCSS($index, $media = 'screen', $forbiddenKeys = array())

|

|     Returns the css code for the given index and media. Any keys that matches the regmatch keys specified in $forbiddenKeys is removed.

|  public function GetCSSFiltered($index, $matchKey, $matchValue, $media = 'screen')

|

|     This is a wrapper for calling GetSectionsFiltered and then create css code from the result.

|  public function GetCSSArray($index, $media = 'screen')

|

|     Get the raw array for the given index and media.

|  public static function ConvertWildcards($text)

|

|     A supporting function that converts filter text to be used in RegExp. - . converts to \. - \converts to .\ - ? converts to .

|  Features

|

|  Since the parser is built upon arrays there is a problem with multiple properties with the same name. This is commonly used when assigning a background in css.

|  `css

|    background: #1e5799;

|    background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);

|    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(51%,#207cca), color-stop(100%,#7db9e8));

|    background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: -o-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: -ms-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|  `

|  becomes

|  `css

|    background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|  `

|  This since the parser interprets the property by itself and two properties with the same name will overwrite eachother.

|

|  To allow this there is a special feature that uses a suffix with a square brackets and a numeric index. This suffix is removed when the css output is created.

|  `css

|    background[0]: #1e5799;

|    background[1]: -moz-linear-gradient(top, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);

|    background[2]: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(51%,#207cca), color-stop(100%,#7db9e8));

|    background[3]: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background[4]: -o-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background[5]: -ms-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background[6]: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|  `

|  becomes

|  `css

|    background: #1e5799;

|    background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);

|    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(50%,#2989d8), color-stop(51%,#207cca), color-stop(100%,#7db9e8));

|    background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: -o-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: -ms-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|    background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%);

|  `

|  A minor note is that the numeric index may be omitted. They are mearly there for readability.

*/



class Cssparser {

  protected static $cssCounter = 0;

  protected static $propCounter = 0;

  protected $cssData;



  function __construct() {

    $this->cssData = array();

  }

 

  public function ParseCSS($css) {

    $index = ++self::$cssCounter;

    $this->cssData[$index] = array('all'=>array(),'screen'=>array(),'print'=>array());

    return $this->ParseCode($index, $css);

  }

 

  public function ParseCSSAppend($index, $css) {

    if(isset($this->cssData[$index])) {

      return $this->ParseCode($index, $css);

    } else {

      return $this->ParseCSS($css);

    }

  }

 

  public function ParseCSSMediaAppend($index, $css, $media) {

    $css = '@'.$media.' {'.PHP_EOL.$css.PHP_EOL.'}'.PHP_EOL;

    if(isset($this->cssData[$index])) {

      return $this->ParseCode($index, $css);

    }

    $index = ++self::$cssCounter;

    $this->cssData[$index] = array('all'=>array(),'screen'=>array(),'print'=>array());

    return $this->ParseCode($index, $css);

  }

 

  protected function ParseCode($index, $css) {

    $currentMedia = 'all';

    $mediaList = array();

    $section = false;

    $css = trim($css);

    if(strlen($css) == 0) {

      return $index;

    }

    $css = preg_replace('/\/\*.*\*\//Us', '', $css);

    while(preg_match('/^\s*(\@(media|import|local)([^\{\}]+)(\{)|([^\{\}]+)(\{)|([^\{\}]*)(\}))/Usi', $css, $match)) {

      if(isset($match[8]) && ($match[8] == '}')) {

        if($section !== false) {

          $code = trim($match[7]);

          $idx = 0;

          $inQuote = false;

          $property = false;

          $codeLen = strlen($code);

          $parenthesis = array();

          while($idx < $codeLen) {

            $c = isset($code{$idx}) ? $code{$idx} : '';

            $idx++;

            if($inQuote !== false) {

              if($inQuote === $c) {

                $inQuote = false;

              }

            } elseif(($inQuote === false) && ($c == '(')) {

              array_push($parenthesis, '(');

            } elseif(($inQuote === false) && ($c == ')')) {

              array_pop($parenthesis);

            } elseif(($c == '\'') || ($c == '"')) {

              $inQuote = $c;

            } elseif(($property === false) && ($c == ':')) {

              $property = trim(substr($code, 0, $idx - 1));

              if(preg_match('/^(.*)\[([0-9]*)\]$/Us', $property, $propMatch)) {

                $property = $propMatch[1].'['.static::$propCounter.']';

                static::$propCounter += 1;

              }

              $code = substr($code, $idx);

              $idx = 0;

            } elseif((count($parenthesis) == 0) && ($c == ';')) {

              $value = trim(substr($code, 0, $idx - 1));

              $code = substr($code, $idx);

              $idx = 0;

              $this->AddProperty($index, $currentMedia, $section, $property, $value);

              $property = false;

            }

          }

          if(($idx > 0) && ($property !== false)) {

            $value = trim($code);

            $this->AddProperty($index, $currentMedia, $section, $property, $value);

          }

          $section = false;

        } elseif(count($mediaList) > 0) {

          array_pop($mediaList);

          if(count($mediaList) > 0) {

            $currentMedia = end($mediaList);

          } else {

            $currentMedia = 'all';

          }

        } else {

          // Superfluous }

        }

      } elseif(isset($match[6]) && ($match[6] == '{')) {

        // Section

        $section = trim($match[5]);

        if(!isset($this->cssData[$index][$currentMedia][$section])) {

          $this->cssData[$index][$currentMedia][$section] = array();

        }

      } elseif(isset($match[4]) && ($match[4] == '{')) {

        if($match[2] == 'media') {

          // New media

          $media = trim($match[3]);

          $mediaList[] = $media;

          $currentMedia = $media;

          if(!isset($this->cssData[$index][$currentMedia])) {

            $this->cssData[$index][$currentMedia] = array();

          }

        } elseif($match[2] == 'import') {

          // Can't support import (yet!)

        } elseif($match[2] == 'local') {

          // Can't support local import (yet!)

        }

      } else {

        // Shouldn't get here

      }

      $stripCount = strlen($match[0]);

      $css = trim(substr($css, $stripCount));

    }

    $css = trim($css);

    if(strlen($css) > 0) {

      echo "Potential error in stylesheet\n".$css;

    }

    return $index;

  }

 

  public function AddProperty($index, $media, $section, $property, $value) {

    if(!isset($this->cssData[$index])) {

      $this->cssData[$index] = array('all'=>array(),'screen'=>array(),'print'=>array());

    }

    $media = trim($media);

    if($media == '') {

      $media = 'all';

    }

    $section = trim($section);

    $property = trim($property);

    if(strlen($property) > 0) {

      $value = trim($value);

      if($media == 'all') {

        $this->cssData[$index][$media][$section][$property] = $value;

        $keys = array_keys($this->cssData[$index]);

        foreach($keys as $key) {

          if(!isset($this->cssData[$index][$key][$section])) {

            $this->cssData[$index][$key][$section] = array();

          }

          $this->cssData[$index][$key][$section][$property] = $value;

        }

      } else {

        if(!isset($this->cssData[$index][$media])) {

          $this->cssData[$index][$media] = $this->cssData[$index]['all'];

        }

        if(!isset($this->cssData[$index][$media][$section])) {

          $this->cssData[$index][$media][$section] = array();

        }

        $this->cssData[$index][$media][$section][$property] = $value;

      }

    }

  }

 

  public function GetMediaList($index) {

    if(isset($this->cssData[$index])) {

      return array_keys($this->cssData[$index]);

    }

    return array();

  }

 

  public function ExportKeyValues($index, $media, $keys) {

    $result = array();

    if(is_string($keys)) {

      $keys = array($keys);

    }

    if(!is_array($keys)) {

      return $result;

    }

    if(isset($this->cssData[$index]) && isset($this->cssData[$index][$media])) {

      foreach($this->cssData[$index][$media] as $section => $sectionValues) {

        foreach($sectionValues as $property => $value) {

          if(in_array($property, $keys)) {

            $result[] = $value;

          }

        }

      }

    }

    return $result;

  }

  

  public function ExportMedia($index, $media, $block = false) {

    $result = '';

    if(isset($this->cssData[$index]) && isset($this->cssData[$index][$media])) {

      foreach($this->cssData[$index][$media] as $section => $sectionValues) {

        $result .= "$section {\n";

        foreach($sectionValues as $property => $value) {

          $property = preg_replace('/(\[[0-9]*\])$/Usi', '', $property);

          if(is_array($block) && isset($block[$property])) {

            if(preg_match('/^'.static::ConvertWildcards($block[$property]).'$/Usi', $value) == 0) {

              $result .= $indent."  $property: $value;\n";

            }

          } else {

            $result .= "  $property: $value;\n";

          }

        }

        $result .= "}\n\n";

      }

    }

    return $result;

  }

  

  public function ExportStyle($index, $block = false) {

    $result = '';

    if(isset($this->cssData[$index])) {

      foreach($this->cssData[$index] as $media => $mediaValues) {

        if($media != 'all') {

          $result .= "@media $media {\n";

          $indent = '  ';

        } else {

          $indent = '';

        }

        foreach($mediaValues as $section => $sectionValues) {

          $result .= $indent."$section {\n";

          foreach($sectionValues as $property => $value) {

            $property = preg_replace('/(\[[0-9]*\])$/Usi', '', $property);

            if(is_array($block) && isset($block[$property])) {

              if(preg_match('/^'.static::ConvertWildcards($block[$property]).'$/Usi', $value) == 0) {

                $result .= $indent."  $property: $value;\n";

              }

            } else {

              $result .= $indent."  $property: $value;\n";

            }

          }

          $result .= $indent."}\n\n";

        }

        if($media != 'all') {

          $result .= "}\n\n";

        }

      }

    }

    return $result;

  }





  public function GetSections($index, $media = 'screen') {

    if(isset($this->cssData[$index])) {

      if(isset($this->cssData[$index][$media])) {

        return array_keys($this->cssData[$index][$media]);

      }

      if(isset($this->cssData[$index]['all'])) {

        return array_keys($this->cssData[$index]['all']);

      }

    }

    return false;

  }



  public function GetSectionsFiltered($index, $matchKey, $matchValue, $media = 'screen') {

    if(isset($this->cssData[$index])) {

      if(!isset($this->cssData[$index][$media])) {

        $media = 'all';

        if(!isset($this->cssData[$index][$media])) {

          return false;

        }

      }

      if(is_array($this->cssData[$index][$media])) {

        $result = array();

        foreach($this->cssData[$index][$media] as $section => $values) {

          if(isset($values[$matchKey])) {

            if($values[$matchKey] == $matchValue) {

              $result[] = $section;

            }

          }

        }

        return $result;

      }

    }

    return false;

  }



  public function GetEditorCSS($index) {

    $forbiddenKeys = array();

    $forbiddenKeys[] = '^filter$';

    return $this->GetCSS($index, 'screen', $forbiddenKeys);

  }

  

  public function GetCSS($index, $media = 'screen', $forbiddenKeys = array()) {

    if(isset($this->cssData[$index])) {

      if(!isset($this->cssData[$index][$media])) {

        $media = 'all';

        if(!isset($this->cssData[$index][$media])) {

          return false;

        }

      }

      if(is_array($this->cssData[$index][$media])) {

        $result = '';

        foreach($this->cssData[$index][$media] as $section => $values) {

          $result .= $section.' {';

          $result .= "\n";

          if(is_array($values)) {

            foreach($values as $key => $value) {

              $skipThis = false;

              foreach($forbiddenKeys as $fKey) {

                if(preg_match('/'.$fKey.'/Usi', $key)) {

                  $skipThis = true;

                  break;

                }

              }

              if($skipThis) {

                continue;

              }

              $result .= '  ';

              $key = preg_replace('/(\[[0-9]*\])$/Usi', '', $key);

              $result .= $key.': '.$value.';';

              $result .= "\n";

            }

          }

          $result .= '}';

          $result .= "\n";

        }

        return $result;

      }

    }

    return false;

  }



  public function GetCSSFiltered($index, $matchKey, $matchValue, $media = 'screen') {

    if(!isset($this->cssData[$index])) {

      if(!isset($this->cssData[$index][$media])) {

        $media = 'all';

        if(!isset($this->cssData[$index][$media])) {

          return false;

        }

      }

    }

    $sections = $this->GetSectionsFiltered($index, $matchKey, $matchValue, $media);

    if($sections !== false) {

      if(is_array($sections)) {

        $result = '';

        foreach($sections as $section) {

          $result .= $section.' {';

          $temp = $this->cssData[$index][$media];

          if(is_array($temp)) {

            foreach($temp as $key => $value) {

              $key = preg_replace('/(\[[0-9]*\])$/Usi', '', $key);

              $result .= $key.': '.$value.';';

            }

          }

          $result .= $section.' }';

        }

        return $result;

      }

    }

    return false;

  }



  public function GetCSSArray($index, $media = 'screen') {

    if(isset($this->cssData[$index])) {

      if(isset($this->cssData[$index][$media])) {

        return $this->cssData[$index][$media];

      } elseif(isset($this->cssData[$index]['all'])) {

        return $this->cssData[$index][$media];

      }

    }

    return false;

  }

  

  public static function ConvertWildcards($text) {

    $text = str_replace('.', '\.', $text);

    $text = str_replace('*', '.*', $text);

    $text = str_replace('?', '.', $text);

    return $text;

  }

}