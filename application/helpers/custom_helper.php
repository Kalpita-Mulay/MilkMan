<?php

function phptext($text, $textColor, $backgroundColor = '', $fontSize, $imgWidth, $imgHeight, $dir, $fileName) {
    /* settings */
    $font = getcwd() . '/assets/calibri.ttf'; /* define font */
    $textColor = hexToRGB($textColor);

    $im = imagecreatetruecolor($imgWidth, $imgHeight);
    $textColor = imagecolorallocate($im, $textColor['r'], $textColor['g'], $textColor['b']);

    if ($backgroundColor == '') {/* select random color */
        $colorCode = array('#56aad8', '#61c4a8', '#d3ab92');
        $backgroundColor = hexToRGB($colorCode[rand(0, count($colorCode) - 1)]);
        $backgroundColor = imagecolorallocate($im, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
    } else {/* select background color as provided */
        $backgroundColor = hexToRGB($backgroundColor);
        $backgroundColor = imagecolorallocate($im, $backgroundColor['r'], $backgroundColor['g'], $backgroundColor['b']);
    }

    imagefill($im, 0, 0, $backgroundColor);
    list($x, $y) = ImageTTFCenter($im, $text, $font, $fontSize);
    imagettftext($im, $fontSize, 0, $x, $y, $textColor, $font, $text);
    if (imagejpeg($im, $dir . $fileName, 90)) {/* save image as JPG */
        return BASE_PATH . '/assets/tempImage/' . $fileName;
        imagedestroy($im);
    }
}

/* function to convert hex value to rgb array */

function hexToRGB($colour) {
    if ($colour[0] == '#') {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6) {
        list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
    } elseif (strlen($colour) == 3) {
        list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return array('r' => $r, 'g' => $g, 'b' => $b);
}

/* function to get center position on image */

function ImageTTFCenter($image, $text, $font, $size, $angle = 8) {
    $xi = imagesx($image);
    $yi = imagesy($image);
    $box = imagettfbbox($size, $angle, $font, $text);
    $xr = abs(max($box[2], $box[4])) + 5;
    $yr = abs(max($box[5], $box[7]));
    $x = intval(($xi - $xr) / 2);
    $y = intval(($yi + $yr) / 2);
    return array($x, $y);
}

//require getcwd () . '/vendor/autoload.php';
/*
 * curl 'https://api.twilio.com/2010-04-01/Accounts/AC4d0c54775e88b5073239aecf00c838c9/Messages.json' -X POST \
 * --data-urlencode 'To=9673990312' \
 * --data-urlencode 'From=TwyGet' \
 * --data-urlencode 'Body=testing' \
 * -u AC4d0c54775e88b5073239aecf00c838c9:0b2fe5db3303159ec656ed378ceff4ec
 */
//use Twilio\Rest\Client;
function send_sms($data) {
    // Your Account SID and Auth Token from twilio.com/console
    $sid = ACCOUNT_SID;
    $token = AUTH_TOKEN;
    $client = new Client($sid, $token);
    $phone = "+34" . $data ['phone'];
    try {
        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
                // the number you'd like to send the message to
                $phone, array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '+34931070708',
            // the body of the text message you'd like to send
            'body' => $data ['message']
        ));
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function check_browser() {
    // $browser = get_browser ();
    if (strpos($_SERVER ['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
        return 'Internet explorer';
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Trident') !== FALSE) // For Supporting IE 11
        return 'Internet explorer';
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
        return 'Mozilla Firefox';
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
        return 'Google Chrome';
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
        return "Opera Mini";
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Opera') !== FALSE)
        return "Opera";
    elseif (strpos($_SERVER ['HTTP_USER_AGENT'], 'Safari') !== FALSE)
        return "Safari";
    else
        return 'Something else';
}

function code_generate($digits) {
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}

/*
 * 
 * function to generate a regex pattern
 */

function generate_regex_code($length) {
    $str = "";
    $specialCharactersArray = array('!', '@', '#', '$', '%', '&', '*');
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'), $specialCharactersArray);
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

function get_next_date($days = 30) {
    return date('Y-m-d', strtotime("+" . $days . " days"));
}

// link if its text
function link_it($text) {
    $text = preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a target=\"_blank\" href=\"$3\" >$3</a>", $text);
    $text = preg_replace("/(^|[\n ])([\w]*?)((www)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a target=\"_blank\" href=\"http://$3\" >$3</a>", $text);
    $text = preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a target=\"_blank\"href=\"ftp://$3\" >$3</a>", $text);
    $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a target=\"_blank\" href=\"mailto:$2@$3\">$2@$3</a>", $text);
    return ($text);
}

// convert to time
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime ();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'año',
        'm' => 'mes',
        'w' => 'sem.',
        'd' => 'día',
        'h' => 'hr',
        'i' => 'min',
        's' => 'seg.'
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string [$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ' : '';
}

// check for valid jsn
function isJson($string) {
    return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
}

// image data to image file
function data_to_image($image_data, $id, $path, $file_name, $height = '400', $width = '700', $pri = "width") {

    $destination_base = $path;
    if (!file_exists($destination_base)) {
        mkdir($destination_base, 0777, true);
    }
    $file_name = $file_name;
    list ( $type, $image_data ) = explode(';', $image_data);
    list (, $image_data ) = explode(',', $image_data);
    $image_data = base64_decode($image_data);
    $file = $destination_base . $file_name;
    // to_rotate ( $file );
    file_put_contents($file, $image_data);

    //list ( $image_width, $image_height ) = getimagesize($destination_base . '' . $file_name);
    //chmod($destination_base . $id . '/' . $file_name, 0777);
    //image_resize($image_width, $image_height, $file, $image_width, $image_height, $pri);
    //chmod($destination_base . $id . '/' . $file_name, 0777);

    return $file_name;
}

function crop($file_name) {
    $img_path = $file_name;
    $img_thumb = $file_name;

    $config ['image_library'] = 'gd2';
    $config ['source_image'] = $img_path;
    $config ['create_thumb'] = FALSE;
    $config ['maintain_ratio'] = FALSE;

    list ( $_width, $_height ) = getimagesize($img_path);
    $img_type = '';
    $thumb_size = 660;

    if ($_width > $_height) {
        // wide image
        $config ['width'] = intval(($_width / $_height) * $thumb_size);
        if ($config ['width'] % 2 != 0) {
            $config ['width'] ++;
        }
        $config ['height'] = $thumb_size;
        $img_type = 'wide';
    } else if ($_width < $_height) {
        // landscape image
        $config ['width'] = $thumb_size;
        $config ['height'] = intval(($_height / $_width) * $thumb_size);
        if ($config ['height'] % 2 != 0) {
            $config ['height'] ++;
        }
        $img_type = 'landscape';
    } else {
        // square image
        $config ['width'] = $thumb_size;
        $config ['height'] = $thumb_size;
        $img_type = 'square';
    }

    get_instance()->load->library('image_lib');
    get_instance()->image_lib->initialize($config);
    get_instance()->image_lib->resize();

    // reconfigure the image lib for cropping
    $conf_new = array(
        'image_library' => 'gd2',
        'source_image' => $img_thumb,
        'create_thumb' => FALSE,
        'maintain_ratio' => FALSE,
        'width' => $thumb_size,
        'height' => 400
    );

    if ($img_type == 'wide') {
        $conf_new ['y_axis'] = ($config ['width'] - $thumb_size) / 2;
        $conf_new ['x_axis'] = 0;
    } else if ($img_type == 'landscape') {
        $conf_new ['x_axis'] = 0;
        $conf_new ['y_axis'] = ($config ['height'] - $thumb_size) / 2;
    } else {
        $conf_new ['x_axis'] = 0;
        $conf_new ['y_axis'] = 0;
    }
    // pre($conf_new);
    get_instance()->image_lib->initialize($conf_new);

    get_instance()->image_lib->crop();
}

// upload message data
function upload_message_file($file, $type) {
    if (!isset($file['name'])) {
        echo get_json('profile_image_require_error', RES_ERROR);
        exit();
    }
    if (isset($file['name'])) {

        $destination_base = MESSAGEUPLOADS . '' . $type;
        $file_name = time() . 'url' . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        $destination = $destination_base . '/' . $file_name;

        if (!file_exists($destination_base)) {
            mkdir($destination_base, 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'uploads/message/' . $type . '/' . $file_name;
        }
    } else {
        return false;
    }
}

// notification
function notify_client($data, $type) {
    get_instance()->load->library('fcm');
    $fc = new Fcm ();
    $result = $fc->send_android_notification($data, $type);
    if ($result == 200)
        return '1';
    else
        return '0';
}

function image_resize($height, $width, $path, $image_width, $image_height, $pri = 'width') {
    // Resize image settings
    get_instance()->load->library('image_lib');
    get_instance()->image_lib->initialize(array(
        'image_library' => 'GD2',
        'source_image' => $path,
        'new_image' => $path,
        'maintain_ratio' => TRUE,
        'width' => $width,
        'height' => $height,
        'master_dim' => $pri
    ));
    get_instance()->image_lib->resize();
}

// image from urrl to base64 conversion
function url_to_base64($img_url) {
    $b64_url = 'php://filter/read=convert.base64-encode/resource=' . $img_url;
    $b64_img = file_get_contents($b64_url);
    return "data:image/png;base64, " . $b64_img;
}

function send_mail($email, $subject, $mail_data) {

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: Attention' . "\r\n" . 'Reply-To: ' . REPORT_SEND_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $mail_data, $headers);
}

function get_db_date($date = '', $format = DATE_YMD_HIS) {
    if ($date == '')
        $date = date($format);
    return date($format, strtotime($date));
}

/**
 * Used in pagination
 * Just use this function where need to use pagination
 *
 * @param
 *        	pagination count $pagination_count
 */
function get_limit($pagination_count = PAGINATION_COUNT) {
    $page = '';
    if (isset($_GET ['page']) && $_GET ['page'] != '')
        $page = $_GET ['page'];
    elseif (isset($_POST ['page']) && $_POST ['page'] != '')
        $page = $_POST ['page'];

    if ($page !== '') {
        $page = $page - 1;
        get_instance()->db->limit($pagination_count, $page * $pagination_count);
    } else
        get_instance()->db->limit($pagination_count, 0);
}

/* Store post params with IP address */

function save_log() {
    // $fileName = BASE_DIR . 'log/' ."log.txt"; /* date ( 'Ymd' ) . */
    $fileName = BASE_DIR . 'log/' . date('Ymd') . ".txt";
    $dataStore = date('Y-m-d H:i:s') . ' ->' . $_SERVER ['REMOTE_ADDR'] . '->' . basename($_SERVER ['REQUEST_URI'], '/') . PHP_EOL . json_encode($_POST) . json_encode($_FILES) . PHP_EOL . PHP_EOL;
    file_put_contents($fileName, $dataStore, FILE_APPEND); // Store log
}

/**
 * print well formatted arary
 */
function pr($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/**
 * print well formatted arary and stop execution
 */
function pre($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}

/**
 * Check is valid and not empty $index value from $data
 * @ Array of value (OR it can be normal variable)
 * @ Index of array
 * If $mandatory is true and not valid value Then exit execution with compulsory field prompt
 *
 * @Returns value of index from array if exist else returns FALSE
 */
function is_valid_val($data, $index, $mandatory = false) {
    // print_r($data);exit();
    if (is_array($data) && isset($data [$index]) && $data [$index] !== '')
        return $data [$index];
    else {
        if (!is_array($data) && $data !== '') // If normal valid variable, return its value
            return $data;

        if ($mandatory) { // If mandatory, print mandatory message and stop execution
            echo get_json(sprintf(lang('field_is_mandatory'), $index), 'Error', false);
            exit();
        } else
            return;
    }
}

/**
 * @$data can contain array of data or text
 * @Default index of output is 'Success',
 * @By default $data value(If $data is not array and $lang==true) will take from lang variable
 *
 * @Returns data in json format
 */
function get_json($data, $type = RES_SUCCESS, $lang = true) {
    $res = array();
    if (!empty($data)) {
        if (!is_array($data) && $lang) {
            if (strpos($data, 'error') !== FALSE) // if $data contain any variable like ...._error, Then make $type = "Error"
                $type = RES_ERROR;
            $data = get_instance()->lang->line($data); // If $data is not array and $lang==true then take $data value from language variable
        }
        $res [$type] = $data;
    } else {
        $res [RES_ERROR] = lang('no_result_found');
    }

    /* Temp, for getting well formated array in website output */
    if (isset($_POST ['website_output']) && $_POST ['website_output'] == 1) {
        echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL . PHP_EOL;
        pr($res);
        echo PHP_EOL . PHP_EOL . 'Web Service output for app--' . PHP_EOL . PHP_EOL;
        $res = json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return str_replace("null", '""', $res);
    } else /* */ {
        if (isset($_POST ['webservice']) && $_POST ['webservice'] == 1) { // Declared in webservice controller
            unset($_POST ['webservice']);
            if (!empty($_POST))
                header('Content-type: application/json'); /* This if condition is temp */
        }
        /* Remove above if condition on live sever */
        $res = json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return str_replace("null", '""', $res);
    }
}

/* Get date in human readable format upto a day */

function get_human_time($time) {
    
}

function get_random_key($md5 = FALSE) {
    $key = rand('1111', '9999');
    if ($md5)
        $key = md5($key);
    return $key;
}

function is_valid_val_image_type($data) {
    if (isset($data ['profileImage'])) {
        $type = pathinfo($data ['profileImage'] ['name'], PATHINFO_EXTENSION);
    }
    if ($type == 'gif' || $type == 'jpg' || $type == 'jpeg' || $type == 'pjpeg' || $type == 'png' || $type == 'x-png') {
        return TRUE;
    } else {
        return FALSE;
    }
}

/* check user type */

function check_user_type() {
    return get_instance()->session->userdata('user_type');
}

/**
 * @Create folder with path provide if folder not exist
 *
 * @Folder permission code
 */
function createFolder($path, $permission = '0777') {
    if (!is_dir($path))
        mkdir($path, $permission, true);
}

//get JSON data from Body
function get_json_data() {
    $json = json_decode(file_get_contents('php://input'), true); //get json payload data
    //$header = get_instance()->input->get_request_header('Authorization', TRUE);//get Authorization from header

    $result = $json;
    //$result['Authorization'] = $header;
    return $result;
}

//get HEADER data
function get_header_data() {
    $result = get_instance()->input->get_request_header('Authorization', TRUE); //get Authorization from header
    return $result;
}

//encryption of a string with the key
function encrypt_token($strting) {
    get_instance()->encryption->initialize(
            array(
                'cipher' => 'aes-128',
                'key' => ENCKEY
            )
    );
    return get_instance()->encryption->encrypt($strting);
}

//dencryption of a string with the key
function decrypt_token($strting) {
    get_instance()->encryption->initialize(
            array(
                'cipher' => 'aes-128',
                'key' => ENCKEY
            )
    );
    return get_instance()->encryption->decrypt($strting);
}

/*
 * @author iAriana Dev Team
 * @function for - making dynamic link
 * @paramas - $data
 * @
 */

function make_dynamic_link($deep_link) {
    //pre($deeplink);
    $deep_link_JSON = json_encode($deep_link);
    //pre($deepLinkJSON);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=" . WEB_API_KEY,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"longDynamicLink\":$deep_link_JSON}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return '';
    } else {
        return $response;
    }
}

/*
 * @author iAriana Dev Team
 * @function for - making dynamic errors
 * @paramas - $data
 * @
 */

if (!function_exists('http_response_code')) {

    function http_response_codes($code = NULL) {

        if ($code !== NULL) {

            switch ($code) {
                case 100: $text = 'Continue';
                    break;
                case 101: $text = 'Switching Protocols';
                    break;
                case 200: $text = 'OK';
                    break;
                case 201: $text = 'Created';
                    break;
                case 202: $text = 'Accepted';
                    break;
                case 203: $text = 'Non-Authoritative Information';
                    break;
                case 204: $text = 'No Content';
                    break;
                case 205: $text = 'Reset Content';
                    break;
                case 206: $text = 'Partial Content';
                    break;
                case 300: $text = 'Multiple Choices';
                    break;
                case 301: $text = 'Moved Permanently';
                    break;
                case 302: $text = 'Moved Temporarily';
                    break;
                case 303: $text = 'See Other';
                    break;
                case 304: $text = 'Not Modified';
                    break;
                case 305: $text = 'Use Proxy';
                    break;
                case 400: $text = 'Bad Request';
                    break;
                case 401: $text = 'Unauthorized';
                    break;
                case 402: $text = 'Payment Required';
                    break;
                case 403: $text = 'Forbidden';
                    break;
                case 404: $text = 'Not Found';
                    break;
                case 405: $text = 'Method Not Allowed';
                    break;
                case 406: $text = 'Not Acceptable';
                    break;
                case 407: $text = 'Proxy Authentication Required';
                    break;
                case 408: $text = 'Request Time-out';
                    break;
                case 409: $text = 'Conflict';
                    break;
                case 410: $text = 'Gone';
                    break;
                case 411: $text = 'Length Required';
                    break;
                case 412: $text = 'Precondition Failed';
                    break;
                case 413: $text = 'Request Entity Too Large';
                    break;
                case 414: $text = 'Request-URI Too Large';
                    break;
                case 415: $text = 'Unsupported Media Type';
                    break;
                case 500: $text = 'Internal Server Error';
                    break;
                case 501: $text = 'Not Implemented';
                    break;
                case 502: $text = 'Bad Gateway';
                    break;
                case 503: $text = 'Service Unavailable';
                    break;
                case 504: $text = 'Gateway Time-out';
                    break;
                case 505: $text = 'HTTP Version not supported';
                    break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;
        } else {

            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }

        return $code;
    }

}
?>
