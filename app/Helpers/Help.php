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
 * public path
 * 
 * @param string $str
 * 
 * @return string
 */
function public_path($str = ''){
    return app()->basePath().DIRECTORY_SEPARATOR.'public'.($str ? DIRECTORY_SEPARATOR.$str : $str);
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
 * Storage path.
 * 
 * php artisan storage:link
 * 
 * @param string $path
 * 
 * @return string
 */
function appStoragePath($path = ''){
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
        $p = $path;
        $a = pathinfo($p);

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
        imagewebp($img, $a['dirname'].DIRECTORY_SEPARATOR.$a['filename'].'.webp');
        unlink($path);

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
function storeImage($name, $path, $req){
    $f = pathinfo($req->file($name)->store($path, 'public'));
    $file = $req->file($name)->move(appStoragePath($path), $f['basename']);

    if($f['extension'] !== 'webp')
        imgCompress($file);

    return $path.'/'.$f['filename'].'.webp';
}

/**
 * Convert directory separator
 * 
 * @param string $str
 * @param boolean $bool
 * 
 * @return string
 */
function toPath($str, $bool = true){
    return str_replace('/', DIRECTORY_SEPARATOR, ($bool ? appStoragePath() : '').$str);
}
