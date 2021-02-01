<?php

/**
 * IDK why i made this function..
 * 
 * @param string $a
 * 
 * @return boolean
 */
function matchWildcard($a){
    $b = ['.show', '.create', '.update', '.delete'];

    for($i = 0; $i < count($b); $i++)
        if($a === 'users'.$b[$i] || $a === 'role'.$b[$i] || $a === 'audits'.$b[$i] || $a === 'meta-tags'.$b[$i])
            return true;
    
    return false;
}

/**
 * date now
 * 
 * @param string $timezone
 * 
 * @return string
 */
function now($timezone = null){
    return \Carbon\Carbon::now($timezone);
}

/**
 * asset URL
 * 
 * @param $path
 * @param bool $secured
 *
 * @return string
 */
function asset($path, $secured = false) {
    $url = new \Laravel\Lumen\Routing\UrlGenerator(app());

    return $url->asset($path, $secured);
}

/**
 * This will be return storage path.
 * 
 * This function should be working
 * if you had run this command:
 * 
 * php artisan storage:link
 * 
 * @param string $path
 * 
 * @return string
 */
function appStoragePath($path){
    return public_path('storage'.DIRECTORY_SEPARATOR.$path);
}

/**
 * This will return any text to kebab case.
 * 
 * @param string $text
 * 
 * @return string
 */
function kebabCase($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text))
        return 'n-a';

    return $text;
}

/**
 * Convert jpeg/jpg/png/gif to webp
 * for better performance.
 * 
 * @param string|array $path
 * 
 * @return boolean
 */
function imgCompress($path){
    if(is_array($path)){
        foreach($path as $p)
            imgCompress($p);
    }else{
        $a = pathinfo($path);
        $p = appStoragePath($path);

        switch ($a['extension']) {
            case 'jpeg':
            case 'jpg':
                $img = imagecreatefromjpeg($p);
                break;
            case 'png':
                $img = imagecreatefrompng($p);
                break;
            case 'gif':
                $img = imagecreatefromgif($p);
                break;

            default:
                return false;
        }

        imagepalettetotruecolor($img);
        imagewebp($img, $p.$a['filename'].'.webp');
        imagedestroy($img);

        return true;
    }
    
    return false;
}

/**
 * Send time based on seconds.
 * 
 * @param string $str
 * 
 * @return integer
 */
function timer($str = ''){
    switch (strtolower($str)) {
        case 'year':
            return 31557600;
        case 'month':
            return 2419200;
        case 'week':
            return 604800;
        case 'day':
            return 86400;

        default:
            return 259200; // 3 days
    }
}

/**
 * Return front end url with path
 * 
 * @param string $str
 * 
 * @return string
 */
function feUrl($str = ''){
    return config('front_end_url').'/'.$str;
}

/**
 * Simplify store image with compression.
 * 
 * @param string $name
 * @param string $path
 * @param Request $req
 * 
 * @return string
 */
function storeImage($name, $path, Request $req){
    $file = $req->file($name)->store($path, 'public');
    $f = pathinfo($file);

    if($f['extension'] !== 'webp')
        imgCompress($file);

    return $path.'/'.$f['filename'].'.webp';
}
