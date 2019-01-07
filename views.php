
<?php /* ============== */ if ($viewname=='layout'){ /* ============== */ ?>

    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
    <html lang='es' class="dark">
        <head>
            <meta charset='utf-8'>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>SyncSubtitles</title>
            <meta name='author' content='Sergi Rodrigues, IMASDEWEB.COM' />
            <meta name='viewport' content='width=device-width, initial-scale=1' />
            
			<link rel="apple-touch-icon" sizes="120x120" href="lib/favicons/favicons/apple-touch-icon.png">
			<link rel="icon" type="image/png" href="lib/favicons/favicon-32x32.png" sizes="32x32">
			<link rel="icon" type="image/png" href="lib/favicons/favicon-16x16.png" sizes="16x16">
			<link rel="manifest" href="lib/favicons/manifest.json">
			<link rel="mask-icon" href="lib/favicons/safari-pinned-tab.svg" color="#5bbad5">
			<link rel="shortcut icon" href="lib/favicons/favicon.ico">
			<meta name="apple-mobile-web-app-title" content="Sync Subtitles">
			<meta name="application-name" content="Sync Subtitles">
			<meta name="msapplication-config" content="lib/favicons/browserconfig.xml">
			<meta name="theme-color" content="#ffffff">
            
            <style>
                body{color: #555; font-size:110%;font-family:arial,sans-serif;padding:0.5rem 2rem;padding-top:0;text-align:center;
                     /* gradient pattern  FROM http://uigradients.com */
                    background: #abbaab; /* fallback for old browsers */
                    background: -webkit-linear-gradient(to left, #abbaab , #ffffff); /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to left, #abbaab , #ffffff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                }                
                input, select, textarea {font-size: 0.9rem;padding: 0.2rem 0.5rem;margin:2px 4px;
                    background-color:#eee;background: linear-gradient(to top, rgba(255,255,255,0.2) , rgba(255,255,255,0.6));}
                td{ text-align:left; vertical-align:top;padding:0.5rem 1rem;}
                a{ color:#488;text-decoration:underline;}
                a b{color: #555;}
                .bt {color: #eee ;background-color: #888; background: linear-gradient(to top, rgba(0,0,0,0.6) , rgba(0,0,0,0.2));border-radius:3px; display:inline-block;padding:0.3rem 0.6rem; margin:3px;}
                .bt:hover {background-color: #eee; box-shadow: 0px 0px 2px 1px #aaa;}
                .a_l{text-align:left;} .a_c{text-align:center;} .a_r{text-align:right;}
                .n_w{white-space:nowrap;}
                .block{display:inline-block;background-color:#eee;background-color:rgba(0,0,0,0.05);border:1px rgba(0,0,0,0.05) solid;border-radius:3px;padding:0rem 2rem;margin:1rem auto;}
                input, textarea, .bt, select {border:1px rgba(0,0,0,0.1) solid;border-radius:5px;}
                .w50{width:100%;max-width:50px;}
                .w75{width:100%;max-width:75px;}
                .w110{width:100%;max-width:110px;}
                .w200{width:100%;max-width:200px;}
                .w300{width:100%;max-width:300px;}
                table{width:auto;min-width:50%;margin:1rem auto;}
                table tr td{vertical-align:middle;}
                table tr[rel=fields] td{color:#488;}
                h1{letter-spacing:3px;margin:0;}
                h1 span:nth-child(1){color:#c08860;} /* E */
                h1 span:nth-child(2){color:#b07058;} /* d */
                h1 span:nth-child(3){color:#a07850;} /* i */
                h1 span:nth-child(4){color:#908048;} /* t */
                h1 span:nth-child(5){color:#808840;} /* S */
                h1 span:nth-child(6){color:#709038;} /* u */
                h1 span:nth-child(7){color:#609830;} /* b */
                h1 span:nth-child(8){color:#50a028;} /* t */
                h1 span:nth-child(9){color:#40a820;} /* i */
                h1 span:nth-child(10){color:#30b018;} /* t */
                h1 span:nth-child(11){color:#20b810;} /* l */
                h1 span:nth-child(12){color:#10c008;} /* e */
                h1 span:nth-child(13){color:#00c800;} /* s */
                h2 {margin:0.5rem;}
                hr {border:none;border-top:1px #ccc solid;color:transparent;background-color:transparent;margin:3px;display:none;}
                em {font-size:0.8rem;}
                .msg {margin-bottom:0;padding:0 1rem;}
                .msg  * {margin:0.5rem;}
                .msg .success{color:#0c0;}
                .msg .error{color:#c00;}
                .menu {margin:0rem;}
                .menu a{margin:0.5rem 0.2rem; margin-bottom:0;}
                @media (max-width: 550px) {
                    body{padding:0.2rem 0.4rem; font-size:100%;}
                    td{ padding:0.2rem 0.4rem;}
                }
                #signature {border-top:1px rgba(0,0,0,0.1) solid;padding-top:1rem;margin-top:2rem;font-size:0.8rem;font-weight:bold;}
                
			/* === DARK THEME === */

				html.dark, html.dark body{
					color:#baa;
					background: #333; /* fallback for old browsers */
					background: -webkit-linear-gradient(to left, #000 , #333); /* Chrome 10-25, Safari 5.1-6 */
					background: linear-gradient(to left, #000 , #333); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
				}
				html.dark table.alt-row{background-color:transparent;}
				html.dark .bt{color:#b99; background: rgba(100,0,0,0.4);border: 1px rgba(255,255,255,0.1) solid;}
				html.dark table.alt-row tbody > tr td{ border-bottom: 1px #555 solid;}
				html.dark .yes{background-color:#485;}
				html.dark table.alt-row thead > tr td{ color: #ebb;}
				html.dark input, html.dark textarea, html.dark select{ color:#a98;background:black;border: 1px rgba(255,255,255,0.2) solid; }
				html.dark table.alt-row table{border-color:#b99!important;}
				html.dark .fa-info-circle{color:#9be;cursor:pointer;display:none;}

				html.dark .modal_content{background-color:rgba(0,0,0,0.5);color:#ccc;box-shadow:0px 0px 25px rgba(255,255,255,0.6);}
			html.dark .modal_close{background-color:#411;border-bottom: 1px #777 solid;}

			html.dark .backup_report .not-pair{background-color:rgba(255,255,255,0.1);}
			html.dark .backup_report .pair{background-color:rgba(255,155,155,0.3);color:#ddd;}

            </style>
        </head>
        <body>
            <!-- logotip -->
            <a href='index.php'><img src='lib/logo.png' style='height:60px;' /></a>
            <h1><span>S</span><span>y</span><span>n</span><span>c</span><span>S</span><span>u</span><span>b</span><span>t</span><span>i</span><span>t</span><span>l</span><span>e</span><span>s</span></h1>
            
            <!-- menu -->
            <div class='menu'>
                <a href='index.php?lang=en' class='bt' title="<?= htmlspecialchars($config['l']['en']['LANG_TITLE']) ?>"><img src='lib/flag-en.svg' style='height:16px;' /></a>
                <a href='index.php?lang=ca' class='bt' title="<?= htmlspecialchars($config['l']['ca']['LANG_TITLE']) ?>"><img src='lib/flag-ca.svg' style='height:16px;' /></a>
                <a href='index.php?lang=es' class='bt' title="<?= htmlspecialchars($config['l']['es']['LANG_TITLE']) ?>"><img src='lib/flag-es.svg' style='height:16px;' /></a>
            </div>
            
            <!-- message to user -->
            <?php if (!empty($config['msg'])) { ?>
            <div class="block msg"><?= $config['msg'] ?></div><br />
            <?php } ?>
            
            <!-- main content -->
            <?= $content ?>
            
            <!-- help & info -->
			<p><?= str_replace("<a>","<a href='lib/milliseconds.srt.zip'>",_l('TIP_1')) ?></p>
            
            <!-- signature -->
            <p id="signature">
				<a href="https://github.com/caos30/php_srrSyncSubtitles" target="_blank">php_srrSyncSubtitles - v<?= $config['version'] ?> on Github</a> 2016-2019 GPL v3 license
				<!-- this is hidden because we're not loading jQuery and bufff... i've no time now to program this change without jQuery ;-)
				&nbsp; | &nbsp; <a href="#" onclick="$('html').toggleClass('dark');return false;">Dark theme</a>
				-->
			</p>
            
        </body>
    </html>
                
<?php /* ============== */ }else if ($viewname=='sync_form'){ /* ======= synchronization form (transform SRT timestamps) ======= */ ?>

    <div class='block' style='width:auto;max-width:90%;min-width:40%;'>
        <form id='form1' method='post'>
            <table style='width:auto;max-width:100%;min-width:80%;'>
                <tr>
                    <!-- LEFT COLUMN: PARAMETERS -->
                    <td style="vertical-align:top;">
                        <table style="width:100%;margin:0;padding:0;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan='2'><b><?= _l('RENUM') ?></b></td> 
                            </tr>
                            <tr rel='fields'>
                                <td class='a_r'><?= _l('ID_FIRST') ?></td> 
                                <td class='a_c'><input type='text' class='w50 a_c' id='first_id' name='first_id' value="<?= isset($_POST['first_id']) ? htmlspecialchars($_POST['first_id']) : '' ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan='2'><b><?= _l('INI_SUBT') ?></b></td> 
                            </tr>
                            <tr rel='fields'>
                                <td class='a_r'><?= _l('CURRENT_TS') ?></td>
                                <td class='a_l'><input placeholder="hh:mm:ss,ddd" type='text' class='w110' id='current_1' 
                                                       name='current_1' value="<?= isset($_POST['current_1']) ? htmlspecialchars($_POST['current_1']) : '' ?>" /></td>
                            </tr>
                            <tr rel='fields'>
                                <td class='a_r'><?= _l('TARGET_TS') ?></td>
                                <td class='a_l'><input placeholder="hh:mm:ss,ddd" type='text' class='w110' id='target_1' 
                                                       name='target_1' value="<?= isset($_POST['target_1']) ? htmlspecialchars($_POST['target_1']) : '' ?>" /></td>
                            </tr>
                            <tr>
                                <td colspan='2'><b><?= _l('END_SUBT') ?></b> <em>(<?= _l('OPTIONAL') ?>)</em></td> 
                            </tr>
                            <tr rel='fields'>
                                <td class='a_r'><?= _l('CURRENT_TS') ?></td>
                                <td class='a_l'><input type='text' class='w110' id='current_2' 
                                                       name='current_2' value="<?= isset($_POST['current_2']) ? htmlspecialchars($_POST['current_2']) : '' ?>" /></td>
                            </tr>
                            <tr rel='fields'>
                                <td class='a_r'><?= _l('TARGET_TS') ?></td>
                                <td class='a_l'><input type='text' class='w110' id='target_2' 
                                                       name='target_2' value="<?= isset($_POST['target_2']) ? htmlspecialchars($_POST['target_2']) : '' ?>" /></td>
                            </tr>
                        </table>
                        <p class='a_c'><a href='#' class='bt' onclick="document.getElementById('form1').submit();return false;" style='width:100%;max-width:365px;'><?= _l('SYNC_NOW') ?></a></p>
                    </td>
                    
                    <!-- LEFT COLUMN: SUBTITLES TEXTAREA -->
                    <td style="vertical-align:top;">
                        <p><b><?= _l('PASTE_TEXT',array('%1','SRT')) ?></b></p> 
                        <textarea id='text' name='text' style='width:100%;height:350px;'><?= !empty($config['new_text']) ? $config['new_text'] : (isset($_POST['text']) ? $_POST['text'] : '') ?></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<?php /* ============== */ } /* ============== */ ?>

