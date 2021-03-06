<?php
class Post {
  const Dir = 'posts/';

  public $title;
  public $content;
  public $description;
  public $raw_date;
  public $format_date;
  public $link;
  public $next_link;
  public $prev_link;
  public $subject;

  private function __construct($file = null) {
    if ($file == null | $file == '') {
      return false;
    }
    if (strpos($file, '.php') === false) {
      $file .= '.php';
    }
    $parts = pathinfo(self::Dir . $file);
    $link = $parts['filename'];
    ob_start();
    include self::Dir . $file;
    $this->title = isset($title)?$title:"";
    $this->raw_date = isset($date)?$date:Date('now');
    $this->description = isset($description)?$description:"";
    $this->subject = isset($subject)?$subject:"";
    ob_end_clean();
    $theFile = file_get_contents(self::Dir . $file);
    $this->content = mb_convert_encoding(
			$theFile,
			'HTML-ENTITIES', 'UTF-8'
    );
    $this->format_date = date('F j, Y', strtotime($this->raw_date));
    $this->link = 'blog/' . $link;
    $this->next_link = $this->get_next_post($file);
    $this->prev_link = $this->get_prev_post($file);
  }

  public static function get_post($file = null) {
    if (!$file || $file == "" || !isset($file)) return false;
    if ($file) {
      return new self($file);
    }
    return false;
  }

  public static function get_recent_posts() {
    $arr = self::get_postnames();
    $send = array(
      1 => self::get_post_meta($arr[0]),
      2 => self::get_post_meta($arr[1]),
      3 => self::get_post_meta($arr[2])
    );
    return (array_filter($send));
  }

  public static function get_posts($x = 1) {
    $arr = self::get_postnames();
    $return = array();
    if ($x) {
      $y = $x * 9;
      $z = $y - 9;
      while ($z < $y) {
        if ($z >= 0 && $arr[$z]) {
          $return[] = new self(basename($arr[$z]));
        }
        $z++;
      }
    }
    return $return;
  }

  public static function get_pagination($current = 1) {
    $arr = self::get_postnames();
    $count = count($arr) / 9;
    $return['count'] = ceil($count);
    if (($current + 1) <= $return['count']) {
      $return['next'] = $current + 1;
    }
    if (($current - 1) >= 1) {
      $return['prev'] = $current - 1;
    }
    $return['current'] = $current;
    return $return;
  }

  private static function get_postnames() {
    return array_map(
      function($post) {
        return basename($post);
      }, array_reverse(glob(self::Dir . '*.php')));
  }

  public static function get_post_meta($file = null) {
    if (!$file || $file == "" || !isset($file)) return false;
    $post = self::get_post($file);
    if ($post) {
      return array(
        'title' => $post->title,
        'date' => $post->format_date,
        'description' => $post->description,
        'link' => $post->link
      );
    }
    return false;
  }

  private function get_next_post($title = null) {
    if (!$title || $title == "" || !isset($title)) return false;
    $arr = self::get_postnames();
    $item_key = array_search($title, $arr);
    if ($item_key !== false && $item_key != 0) {
      $next = $arr[$item_key - 1];
      if ($next) {
        return $next;
      }
    }
    return false;
  }

  private function get_prev_post($title = null) {
    if (!$title || $title == "" || !isset($title)) return false;
    $arr = self::get_postnames();
    $item_key = array_search($title, $arr);
    if ($item_key !== false) {
      $prev = $arr[$item_key + 1];
      if ($prev) {
        return $prev;
      }
    }
    return false;
  }

  public function search($str) {
    $results = array();
    $search = strtolower($str);
    $files = scandir(self::Dir);
    foreach ($files as $k=>$v) {
      $path = realpath(self::Dir . '/' . $v);
      if (!is_dir($path)) {
        $content = strtolower(file_get_contents($path));
        $title = strtolower($path);
        if ((strpos($content, $search) || strpos($title, $search)) && !strpos($path, ".DS_Store")) {
          $results[] = self::get_post(basename($path));
        }
      }
    }
    return $results;
  }
}
