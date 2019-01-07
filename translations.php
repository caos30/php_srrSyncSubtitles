<?php 

function _l($key, $replacements=''){
    global $config;
    $l = $_SESSION['lang'];
    if (isset($config['l'][$l]) && isset($config['l'][$l][$key]))
        $ret = $config['l'][$l][$key];
    else if (isset($config['l']['en'][$key]))
        $ret = $config['l']['en'][$key];
    else
        $ret = $key;
    if (is_array($replacements)){
        $ret = str_replace($replacements[0], $replacements[1], $ret);
    }
    return $ret;
}

global $config;

/* ======== ENGLISH ========= */

$t = array();
$t['LANG_TITLE'] = 'English';
$t['ID_FIRST'] = "<b>ID</b> number for the first subtitle";
$t['RENUM'] = "Renumbering of the subtitles:";
$t['INI_SUBT'] = "Subtitle of the beginning of movie:";
$t['END_SUBT'] = "Subtitle of the end of movie:";
$t['CURRENT_TS'] = "<b>current</b> timestamp";
$t['TARGET_TS'] = "<b>desired</b> timestamp";
$t['OPTIONAL'] = "optional";
$t['PASTE_TEXT'] = "Copy paste here the text fo the <u>%1 file</u>:";
$t['SYNC_NOW'] = "Sync now";
$t['MSG_1'] = "You must specify the 2 timestamps for at least one subtitle.";
$t['MSG_2'] = "Successful synchronization.";
$t['TIP_1'] = "Tip for see milliseconds on any media player: using <a>this</a> SRT file.";

$config['l']['en'] = $t;

/* ======== CATALAN ========= */

$t = array();
$t['LANG_TITLE'] = 'Català';
$t['ID_FIRST'] = "<b>ID</b> del primer subtítol";
$t['RENUM'] = "Renumeració dels subtítols:";
$t['INI_SUBT'] = "Subtítol del començament de la peli:";
$t['END_SUBT'] = "Subtítol del final de la peli:";
$t['CURRENT_TS'] = "marca de temps <b>actual</b>";
$t['TARGET_TS'] = "marca de temps <b>desitjada</b>";
$t['OPTIONAL'] = "opcional";
$t['PASTE_TEXT'] = "Enganxeu aquí el text provinent del <u>fitxer %1</u>:";
$t['SYNC_NOW'] = "Sincronitzar ara";
$t['MSG_1'] = "Heu d'indicar les marques de temps per al menys un subtítol.";
$t['MSG_2'] = "Sincronització finalitzada amb èxit.";
$t['TIP_1'] = "Truc per veure milisegons en qualsevol reproductor: amb <a>aquest</a> fitxer SRT.";

$config['l']['ca'] = $t;

/* ======== SPANISH ========= */

$t = array();
$t['LANG_TITLE'] = 'Castellano';
$t['ID_FIRST'] = "<b>ID</b> del primer subtítulo";
$t['RENUM'] = "Renumeración de los subtítulos:";
$t['INI_SUBT'] = "Subtítulo del inicio de la peli:";
$t['END_SUBT'] = "Subtítulo del final de la peli:";
$t['CURRENT_TS'] = "marca de tiempo <b>actual</b>";
$t['TARGET_TS'] = "marca de tiempo <b>deseada</b>";
$t['OPTIONAL'] = "opcional";
$t['PASTE_TEXT'] = "Pegue aquí el texto contenido en el <u>archivo %1</u>:";
$t['SYNC_NOW'] = "Sincronizar ahora";
$t['MSG_1'] = "Ha de indicar las marcas de tiempo para al menos un subtítulo.";
$t['MSG_2'] = "Sincronización realizada con éxito.";
$t['TIP_1'] = "Truco para ver milisegundos en cualquier reproductor: con <a>este</a> archivo SRT.";

$config['l']['es'] = $t;

?>
