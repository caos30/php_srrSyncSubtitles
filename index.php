<?php

/* 
 * This is a tinty app for store/get/manage links of interest for me (or for you ;)
 */

// ========= settings ============

        global $config;
        $config = array(
					'version' => '1.1',
                    'l' => array(),
                    'ts' => array('current_1'=>'','target_1'=>'','current_2'=>'', 'target_2'=>''),
                    'first_id' => '1',
                    'msg' => '',
                    'new_text' => '',
                );

        ini_set('display_errors',1);
        include_once('translations.php');
    
// ========= "login" ============
        
        session_start();
        $_SESSION['lang'] = !empty($_GET['lang']) ? $_GET['lang'] : ( !empty($_SESSION['lang']) ? $_SESSION['lang'] : 'en');
        
        //echo '<h3>$_POST</h3>'._var_export($_POST).'<h3>$_SESSION</h3>'._var_export($_SESSION);die();
    
// ========= once "logged" ============
    
        // == request
            if (!empty($_POST['text'])){
                if (empty($_POST['current_1']) || empty($_POST['target_1'])){
                    $config['msg'] .= "<h3 class='error'>"._l('MSG_1')."</h3>";
                }else{
                    $config['new_text'] = _process_sync();
                    $config['msg'] .= "<h3 class='success'>"._l('MSG_2')."</h3>";
                }
            }
            $content = _render_view('sync_form', array('vars'=>array()));
            
            
        // == render and output
            echo _render_view('layout', array('content'=>$content));
            die();


// ========= internal functions ============
    
    function _process_sync(){
        global $config;
        
        // == settings
            $temporal_file = "temp.srt";  
            $first_id = !empty($_POST['first_id']) && intval($_POST['first_id'])>0 ? intval($_POST['first_id']) : 1; 
            $text = trim(stripslashes($_POST['text']));
            $current_1 = trim($_POST['current_1']); 
            $target_1 = trim($_POST['target_1']); 
            $current_2 = trim($_POST['current_2']); 
            $target_2 = trim($_POST['target_2']);
            
        // == process

        if ($text!='' && $current_1!='' && $target_1!=''){
                // == calculate type and amount of offset
                // == == if it's not set the timestamps for the second subtitle we only will increase/decrease the same amount of time all the subtitles
                // == == but if it's set the timestamps for the second subtitle we will rescale all the subtitles times using a LINEAL FORMULA ensuring that the 2 subtitles set by user exactly match with the target timestamps delivered by him
                    $s_current_1 = _hms2s($current_1); 
                    $s_target_1 = _hms2s($target_1); 
                    $s_current_2 = !empty($current_2) ? _hms2s($current_2) : ''; 
                    $s_target_2 = !empty($target_2) ? _hms2s($target_2) : '';

                // == save the incoming text (with subtitles) in a temporal file
                _save_text($text,$temporal_file);

                // == load the subtitles from that temporal file
                $subtitles = _load_subtitles_file($temporal_file); 

                // == empty that temporal file (by security reasons, to avoid to be called from out there)
                _empty_file($temporal_file);

                // == run transformation over the subtitles' timestamps
                if ($current_2=='' or $target_2==''){
                        // = only a fix increment/decrement on the times of all subtitles, same for all (a "traslation" in math terms)
                        $s_increment = $s_target_1 - $s_current_1;
                        $subtitles2 = _sum_seconds($s_increment,$subtitles);
                }else{
                        // == linear transformation (= traslation + rescale) to all subtitles
                        $linear_m = ($s_target_2 - $s_target_1) / ($s_current_2 - $s_current_1);
                        $linear_n = $s_target_1 - ($linear_m * $s_current_1);
                        // == mathematical formula:  s_target = m * s_current + n 	
                        $subtitles2 = _linear_transformation($linear_m , $linear_n , $subtitles); 
                }
                // = build text to be returned
                $new_text = _subt2txt($subtitles2,$first_id);

        }else{
                $new_text = $text; 
        }
        
        return $new_text;
    }

    function _sum_seconds($seg,$subtitles){
            if (count($subtitles)>0){ 
                foreach ($subtitles as $id=>$ele){
                    $trozos1=explode(":",$ele['inicio']);	
                    $trozos2=explode(":",$ele['final']);
                    if (count($trozos1)==3) $subtitles[$id]['inicio']= _s2hms($seg + _hms2s($ele['inicio'])); 
                    if (count($trozos2)==3) $subtitles[$id]['final']= _s2hms($seg + _hms2s($ele['final'])); 
            }}
            return $subtitles;
    }

    function _linear_transformation($m,$n,$subtitles){ 
            if (count($subtitles)>0){ foreach ($subtitles as $id=>$ele){
                    $trozos1=explode(":",$ele['inicio']);	
                    $trozos2=explode(":",$ele['final']);
                    if (count($trozos1)==3) $subtitles[$id]['inicio']= _s2hms($m * _hms2s($ele['inicio']) + $n); 
                    if (count($trozos2)==3) $subtitles[$id]['final']= _s2hms($m * _hms2s($ele['final']) + $n);  
            }}
            return $subtitles;
    }

    function _hms2s($time){
            $trozos = explode(":",$time);
            if (count($trozos)!=3) return '';
            $ret = floatval($trozos[0])*3600 + floatval($trozos[1])*60 + floatval(str_replace(",",".",$trozos[2])); 
            return $ret;
    }
    function _s2hms($s){
            $s = floatval($s);
            $h = intval($s/3600);
            $ret_h = substr("00".strval($h),-2);
            $m = intval(($s-$h*3600)/60);
            $ret_m = substr("00".strval($m),-2);
            $sg = ($s-$h*3600-$m*60);
            $ret_s = substr("00".strval(number_format($sg,3,",",".")),-6);
            $ret = $ret_h.":".$ret_m.":".$ret_s;
            return $ret;
    }

    function _save_text($texto,$url_archivo){
                    //chmod($url_archivo,755);
                    $fp = fopen($url_archivo,"w");
                    fwrite($fp, $texto);
                    fclose($fp); 
    }

    function _empty_file($url_archivo){ 
                    //chmod($url_archivo,755);
                    $fp = fopen($url_archivo,"w");
                    fwrite($fp, '');
                    fclose($fp); 
    }

    function _subt2txt($subtitles,$id_primer_subtitulo){
                    $ret = "";
                    $id = $id_primer_subtitulo;
                    if ($id==0) $id=1;
                    if (count($subtitles)>0){foreach ($subtitles as $ele){ 
                            $ret .= "\n".$id;
                            $ret .= "\n".$ele['inicio']." --> ".$ele['final'];
                            $ret .= "\n".$ele['subt']."\n";
                            $id++;
                    }}
                    return $ret;
    }
    function _save_subtitles($subtitles,$url_archivo,$id_ini=1){
                    //chmod($url_archivo,755);
                    $fp = fopen($url_archivo,"w");
                    $id = $id_ini;
                    if (count($subtitles)>0){foreach ($subtitles as $ele){ 
                            fwrite($fp, "\n".$id);
                            fwrite($fp, "\n".$ele['inicio']." --> ".$ele['final']);
                            fwrite($fp, "\n".$ele['subt']);
                            fwrite($fp, "\n");
                            $id++;
                    }}
                    fclose($fp); 
    }

    function _load_subtitles_file($url_archivo){
                    $html = "";
                    if (file_exists($url_archivo)==false) return "";
                    $fp = fopen($url_archivo,"r"); 
                    $continuar = true;
                    // cargar lineas del texto, que no sean blancas 
                    $n_lineas_en_blanco=0;
                    $lineas = array();
                    while($continuar){
                            $linea = trim(fgets($fp, 10000));
                            if (trim($linea)!=""){ 
                                    $lineas[]=trim($linea);
                                    $n_lineas_en_blanco=0;
                            }else{
                                    $n_lineas_en_blanco++; 
                             } 
                            if ($n_lineas_en_blanco>100) $continuar = false;
                    } // while 

                    // construir el array de subtitulos con esas lineas
                    $ele = array();
                    $ret = array();
                    $num_lineas = count($lineas); 
                    $ele_id = 0;
                    if ($num_lineas>0){
                            for ($il=0;$il < $num_lineas;$il++){
                                    $linea = $lineas[$il];
                                    $next_linea = $lineas[$il+1];
                                    if (!isset($ele['id'])){	
                                            if ($ele_id==0 && intval($linea)>0) 
                                                    $ele_id = intval($linea);
                                            else 
                                                    $ele_id++;
                                            $ele['id'] = $ele_id; 
									}else if (preg_match('/:(.*)-->(.*):/',$next_linea)){
											// = save the current subtitle, if the text is not in blank
												if (!empty($ele['subt'])){
													$ret[$ele['id']] = $ele;
													$ele_id++;
												}
												unset($ele);
											// volver a empezar con un nuevo subtitulo 
												$ele = array();
												$ele['id'] = $ele_id;
                                    }else if (!isset($ele['inicio']) && preg_match('/:(.*)-->(.*):/',$linea)){
                                            $trozos = explode("-->",trim($linea));  
                                            $ele['inicio'] = trim($trozos[0]);
                                            $ele['final'] = trim($trozos[1]);
                                    }else if (!isset($ele['subt'])){
                                            $ele['subt'] = trim($linea);
                                    }else if ($il == $num_lineas -1){ 
                                            // = last line, so add the last subt
                                            $ele['subt'] .= "\n".trim($linea);
                                            $ret[$ele['id']] = $ele;
                                            break;
                                    }else{ 
											$ele['subt'] .= "\n".trim($linea);
                                    }
                            }
                            // añadir el ultimo subtitulo
                            if (trim($ele['subt'])!='') $ret[$ele['id']] = $ele;
                    }

                    fclose($fp); 
                    return $ret;
    }
    
    function _render_view($viewname,Array $vars){
        global $config;
            if (count($vars)>0){ 
                foreach($vars as $__k__=>$__v__){
                    if ($__k__!='config') ${$__k__} = $__v__;
                }
            }
        // == we save a copy of the content already existing at the output buffer (for no interrump it)
            $existing_render = ob_get_clean( );
        // == we begin a new output
            ob_start( );
            include('views.php');
        // == we get the current output
            $render = ob_get_clean( ); 
        // == we re-send to output buffer the existing content before to arrive to this function ;)
            ob_start( );
            echo $existing_render;

            return $render;
    }
    
    /*
     * for debugging tasks only 
     */
    function _var_export($arr, $title=''){
            $html = !empty($title) ? '<h3>'.$title.'</h3>' : '';
            $html .= "\n<div style='margin-left:100px;font-size:10px;font-family:sans-serif;'>";
            if (is_array($arr)){
                if (count($arr)==0){
                    $html .= "&nbsp;";	
                }else{
                    $ii=0;
                    foreach ($arr as $k=>$ele){
                        $html .= "\n<div style='float:left;'><b>$k <span style='color:#822;'>&rarr;</span> </b></div>"
                                          ."\n<div style='border:1px #ddd solid;font-size:10px;font-family:sans-serif;'>"._var_export($ele)."</div>";
                        $html .= "\n    <div style='float:none;clear:both;'></div>";
                        $ii++; 
                    }
                }
            }else{ 
                $html .= is_string($arr)? htmlspecialchars($arr) : "&nbsp;";
            } 
            $html .= "</div>";
            return $html;
    }
    
    
