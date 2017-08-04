<?php
 
// loune 25/3/2006, updated 22/08/2009
// For more information see:
// http://siphon9.net/loune/2007/10/simple-lightweight-ntlm-in-php/
// 
// This script is obsolete, you should see
// http://siphon9.net/loune/2009/09/ntlm-authentication-in-php-now-with-ntlmv2-hash-checking/
//
 
// NTLM specs http://davenport.sourceforge.net/ntlm.html
 
$headers = apache_request_headers();
 
if (!isset($headers['Authorization'])){
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: NTLM');
    exit;
}
 
$auth = $headers['Authorization'];
 
if (substr($auth,0,5) == 'NTLM ') {
    $msg = base64_decode(substr($auth, 5));
    if (substr($msg, 0, 8) != "NTLMSSP\x00")
        die('error header not recognised');
 
    if ($msg[8] == "\x01") {
        $msg2 = "NTLMSSP\x00\x02\x00\x00\x00".
            "\x00\x00\x00\x00". // target name len/alloc
            "\x00\x00\x00\x00". // target name offset
            "\x01\x02\x81\x00". // flags
            "\x00\x00\x00\x00\x00\x00\x00\x00". // challenge
            "\x00\x00\x00\x00\x00\x00\x00\x00". // context
            "\x00\x00\x00\x00\x00\x00\x00\x00"; // target info len/alloc/offset
 
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: NTLM '.trim(base64_encode($msg2)));
        exit;
    }
    else if ($msg[8] == "\x03") {
        function get_msg_str($msg, $start, $unicode = true) {
            $len = (ord($msg[$start+1]) * 256) + ord($msg[$start]);
            $off = (ord($msg[$start+5]) * 256) + ord($msg[$start+4]);
            if ($unicode)
                return str_replace("\0", '', substr($msg, $off, $len));
            else
                return substr($msg, $off, $len);
        }
        $user = get_msg_str($msg, 36);
        $domain = get_msg_str($msg, 28);
        $workstation = get_msg_str($msg, 44);
 
#        print "You are $user from $domain/$workstation";
    }
}

    $agentName = array (
        'abarrett'   => 'Amy Barrett',
        'almullins'  => 'Alquici Mullins',
        'ataylor'    => 'Ambria Taylor',
        'avanegas'   => 'Alma Vanegas',
        'bzertuche'  => 'Brayden Zertuche',
        'caguinaga'  => 'Christian Aguinaga',
        'chmoran'    => 'Titan',
        'chpatterson'=> 'Cherise Patterson',
        'dbates'     => 'Darian Bates',
        'dbustamente'=> 'Dakota Bustamente',
        'dgarcia'    => 'Dago Garcia',
        'ddewitt'    => 'Don Dewitt',
        'ddecoux'    => 'Deborah Decoux',
        'gcarroll'   => 'Grady Carroll',
        'hportillo'  => 'Hugo Portillo',
        'jbrooks'    => 'Jennifer Brooks',
        'jemcavin'   => 'Jessica McAvin',
        'jmann'      => 'Jasmine Mann',
        'jweiss'     => 'Jennifer Weiss',
        'jsaldana'   => 'Jose Saldana',
        'jvalle'     => 'Jonathan Valle',
        'kedavid'    => 'Kerry David',
        'kdieppue'   => 'Djoko Dieppue',
        'klafitte'   => 'Devon Shanice Lafitte',
        'knesbitt'   => 'Kassandra Nesbitt',
        'mawilliams' => 'Maelan Williams',
        'mdiaz'      => 'Mario Diaz',
        'mfernandez' => 'Melissa Fernandez',
        'mtorres'    => 'Miguel Torres',
        'oislam'     => 'Ozair Islam',
        'pharper'    => 'Patricia Harper',
        'rhagemann'  => 'Richard Hagemann',
        'rpianesi'   => 'Ryan Pianesi',
        'rrodriguez' => 'Rene Rodriguez',
        'sdavidson'  => 'Sherry Davidson',
        'smintz'     => 'Sharron Mintz',
        'ssaucedo'   => 'Shally Saucedo',
        'thess'      => 'Tommy Hess',
        'tcedillo'   => 'Thaddeus Cedillo',
        'tkalinec'   => 'Treigh Kalinec',
        'toneal'     => 'Theodore ONeal',
        'twashington'=> 'Tiffany Washington',
        'veme'       => 'Victoria Eme'
    );

?>